<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontendController extends AbstractController
{

    /**
     * @Route("/", methods="GET", name="homepage")
     */
    public function homepage(): Response
    {
        return $this->render('frontend/homePage.html.twig');
    }

    /**
     * @Route("/accounting", methods="GET", name="accounting")
     */
    public function accounting(): Response
    {
        return $this->render('frontend/accounting.html.twig');
    }

    /**
     * @Route("/renewables", methods="GET", name="renewables")
     */
    public function renewables(): Response
    {
        return $this->render('frontend/renewables.html.twig');
    }

}
