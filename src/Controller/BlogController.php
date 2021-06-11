<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlogController
 * @Route("/",priority="10")
 *
 * @package App\Controller
 */
class BlogController extends AbstractController
{

    /**
     * @Route("/blog", defaults={"page": "1", "_format"="html"}, methods="GET", name="blog_index")
     * @Route("/blog/rss.xml", defaults={"page": "1", "_format"="xml"}, methods="GET", name="blog_rss")
     * @Route("/blog/{page<[1-9]\d*>}", defaults={"_format"="html"}, methods="GET", name="blog_index_paginated")
     * @Cache(smaxage="10")
     *
     * NOTE: For standard formats, Symfony will also automatically choose the best
     * Content-Type header for the response.
     * See https://symfony.com/doc/current/routing.html#special-parameters
     */
    public function index(Request $request, int $page, string $_format, PostRepository $posts): Response
    {
        $latestPosts = $posts->findLatest($page);

        // Every template name also has two extensions that specify the format and
        // engine for that template.
        // See https://symfony.com/doc/current/templates.html#template-naming
        return $this->render(
            'blog/index.'.$_format.'.twig',
            [
                'paginator' => $latestPosts,
            ]
        );
    }


    /**
     * @Route("/{url}", methods="GET", name="blog_post")
     *
     * NOTE: The $post controller argument is automatically injected by Symfony
     * after performing a database query looking for a Post with the 'url'
     * value given in the route.
     * See https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html
     *
     * @param   Post  $post
     *
     * @return Response
     */
    public function postShow(Post $post): Response
    {
        // Symfony's 'dump()' function is an improved version of PHP's 'var_dump()' but
        // it's not available in the 'prod' environment to prevent leaking sensitive information.
        // It can be used both in PHP files and Twig templates, but it requires to
        // have enabled the DebugBundle. Uncomment the following line to see it in action:
        //
        // dump($post, $this->getUser(), new \DateTime());

        return $this->render('blog/post_show.html.twig', ['post' => $post]);
    }

    /**
     * @Route("/search", methods="GET", name="blog_search")
     */
    public function search(Request $request, PostRepository $posts): Response
    {
        $query = $request->query->get('q', '');
        $limit = $request->query->get('l', 10);

        if ( ! $request->isXmlHttpRequest()) {
            return $this->render('blog/search.html.twig', ['query' => $query]);
        }

        $foundPosts = $posts->findBySearchQuery($query, $limit);

        $results = [];
        foreach ($foundPosts as $post) {
            $results[] = [
                'title'   => htmlspecialchars($post->getTitle(), ENT_COMPAT | ENT_HTML5),
                'date'    => $post->getCreatedAt()->format('M d, Y'),
                'author'  => htmlspecialchars($post->getAuthor()->getFullName(), ENT_COMPAT | ENT_HTML5),
                'summary' => htmlspecialchars($post->getLead(), ENT_COMPAT | ENT_HTML5),
                'url'     => $this->generateUrl('blog_post', ['url' => $post->getUrl()]),
            ];
        }

        return $this->json($results);
    }

}
