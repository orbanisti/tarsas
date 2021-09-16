<?php


namespace App\Services;


use App\Repository\PostRepository;
use Symfony\Component\Routing\RouterInterface;

class RedirectManager
{

    public static $map =
        [
            //old slud =>'route name'
            'karrier'                                        => 'career',
            'legyel-everest-csapattag-projekt-koordinator'   => 'job_project_coordinator',
            'legyel-everest-csapattag-konyvelo'              => 'job_accountant',
            'legyel-everest-csapattag-sales-account-manager' => 'job_sales',
            'legyel-everest-ertekesito-tamogato-koordinator' => 'job_sales_support_coordinator',
            'blog'                                           => 'blog_index',
        ];
    /** @var RouterInterface */
    private $router;
    /** @var PostRepository */
    private $postRepo;

    /**
     * RedirectManager constructor.
     *
     * @param   RouterInterface  $router
     * @param   PostRepository   $postRepo
     */
    public function __construct(RouterInterface $router, PostRepository $postRepo)
    {
        $this->router   = $router;
        $this->postRepo = $postRepo;
    }

    /**
     * @param   string|null  $slug
     *
     * @return string
     */
    public function getRedirectUrl(?string $slug): ?string
    {
        if (isset(self::$map[$slug])) {
            return $this->router->generate(self::$map[$slug]);
        }
        $slugParts = explode('/', $slug);
        /** Solves blog redirects from old page */
        if (count($slugParts) == 2 && str_contains($slugParts[0], 'blog')) {
            $post = $this->postRepo->createQueryBuilder('o')
                                   ->andWhere('o.url LIKE :slug2')
                                   ->setParameter('slug2', '%'.$slugParts[1].'%')
                                   ->getQuery()
                                   ->setMaxResults(1)
                                   ->getSingleResult();
            if ($post) {
                return $this->router->generate('blog_post', ['url' => $post->getUrl()]);
            }
        }


        return null;
    }

    public function isSiteMap(string $slug)
    {
        $slugParts = explode('/', $slug);
        if (str_contains($slugParts[0], 'sitemap')) {
            return true;
        }

        return false;
    }

}
