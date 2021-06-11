<?php


namespace App\Controller;


use App\Services\RedirectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RedirectController extends AbstractController
{

    /**
     * @Route("/{slug}/", methods={"GET","POST"}, name="redirect_main",priority="1")
     * @param   string           $slug
     *
     * @param   RedirectManager  $redirectManager
     *
     * @return Response
     */
    public function doRedirect(string $slug, RedirectManager $redirectManager): Response
    {
        $targetUrl = $redirectManager->getRedirectUrl($slug);
        if ($targetUrl) {
            return new RedirectResponse($targetUrl, 301);
        }

        return $this->render('frontend/404.html.twig', [], new Response('', 404));
    }

}
