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

    /**
     * @Route("/career", methods="GET", name="career")
     */
    public function career(): Response
    {
        return $this->render('frontend/career.html.twig');
    }

    /**
     * @Route("/jobs/salesManager", methods="GET", name="job_sales")
     */
    public function salesManagerJob(): Response
    {
        return $this->render('frontend/job.html.twig');
    }

    /**
     * @Route("/contact", methods="GET", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('frontend/contact.html.twig');
    }

    /**
     * @Route("/acout", methods="GET", name="about")
     */
    public function about(): Response
    {
        return $this->render('frontend/about.html.twig');
    }

}
