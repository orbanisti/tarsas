<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobsController extends AbstractController
{

    /**
     * @Route("/jobs/salesManager", methods="GET", name="job_sales",options={"sitemap" =true})
     */
    public function salesAccountManager(): Response
    {
        return $this->render('frontend/jobs/salesAccountManagerHu.html.twig');
    }

    /**
     * @Route("/jobs/fullStackDeveloper", methods="GET", name="job_full_stack_developer",options={"sitemap" =true})
     */
    public function fullStackDeveloper(): Response
    {
        return $this->render('frontend/jobs/fullStackDeveloperHu.html.twig');
    }

    /**
     * @Route("/jobs/backendDeveloper", methods="GET", name="job_backend_developer",options={"sitemap" =true})
     */
    public function backendDeveloper(): Response
    {
        return $this->render('frontend/jobs/backendDeveloperHu.html.twig');
    }

    /**
     * @Route("/jobs/accountant", methods="GET", name="job_accountant",options={"sitemap" =true})
     */
    public function accountant(): Response
    {
        return $this->render('frontend/jobs/accountant.html.twig');
    }

}
