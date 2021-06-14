<?php


namespace App\Controller;


use App\Services\RedirectManager;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RedirectController
 * @Route("/{slug}")
 *
 * @package App\Controller
 */
class RedirectController extends AbstractController
{

    /**
     *
     * @param   string           $slug
     * @param   RedirectManager  $redirectManager
     *
     * @return Response
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @Route("/", methods={"GET","POST"}, name="redirect_main",priority="1")
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
