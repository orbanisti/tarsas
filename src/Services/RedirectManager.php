<?php


namespace App\Services;


use Symfony\Component\Routing\RouterInterface;

class RedirectManager
{

    public static $map =
        [
            //old slud =>'route name'
            'karrier' => 'career',
        ];
    /** @var RouterInterface */
    private $router;

    /**
     * RedirectManager constructor.
     *
     * @param   RouterInterface  $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }


    /**
     * @param $slug
     *
     * @return string
     */
    public function getRedirectUrl($slug): ?string
    {
        if (isset(self::$map[$slug])) {
            return $this->router->generate(self::$map[$slug]);
        }

        return null;
    }

}
