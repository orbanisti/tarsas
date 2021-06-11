<?php


namespace App\Controller;


use App\Entity\Recruitment;
use App\Form\RecruitmentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class JobsController
 * @Route("/",priority="10")
 *
 * @package App\Controller
 */
class JobsController extends AbstractController
{

    /**
     * @Route("/jobs/salesManager", methods="GET", name="job_sales",options={"sitemap" =true})
     */
    public function salesAccountManager(): Response
    {
        $recruitment = new Recruitment();
        $form        = $this->createForm(RecruitmentType::class, $recruitment);

        return $this->render('frontend/jobs/salesAccountManagerHu.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/jobs/fullStackDeveloper", methods="GET", name="job_full_stack_developer",options={"sitemap" =true})
     */
    public function fullStackDeveloper(): Response
    {
        $recruitment = new Recruitment();
        $form        = $this->createForm(RecruitmentType::class, $recruitment);

        return $this->render('frontend/jobs/fullStackDeveloperHu.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/jobs/backendDeveloper", methods="GET", name="job_backend_developer",options={"sitemap" =true})
     */
    public function backendDeveloper(): Response
    {
        $recruitment = new Recruitment();
        $form        = $this->createForm(RecruitmentType::class, $recruitment);

        return $this->render('frontend/jobs/backendDeveloperHu.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/jobs/accountant", methods="GET", name="job_accountant",options={"sitemap" =true})
     */
    public function accountant(): Response
    {
        $recruitment = new Recruitment();
        $form        = $this->createForm(RecruitmentType::class, $recruitment);

        return $this->render('frontend/jobs/accountant.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/jobs/projectCoordinator", methods="GET", name="job_project_coordinator",options={"sitemap" =true})
     */
    public function projectCoordinator(): Response
    {
        $recruitment = new Recruitment();
        $form        = $this->createForm(RecruitmentType::class, $recruitment);

        return $this->render('frontend/jobs/projectCoordinator.html.twig', ['form' => $form->createView()]);
    }

}
