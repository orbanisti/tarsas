<?php


namespace App\Controller;


use App\Entity\Recruitment;
use App\Form\RecruitmentType;
use App\Services\RecruitmentFactory;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    /**
     * @Route("/contactRecruitmentSubmit", methods="POST", name="contact_recruitment_submit")
     * @param   Request                 $request
     * @param   RecruitmentFactory      $recruitmentFactory
     * @param   EntityManagerInterface  $entityManager
     *
     * @return RedirectResponse
     */
    public function submitRecruitmentForm(
        Request $request,
        RecruitmentFactory $recruitmentFactory,
        EntityManagerInterface $entityManager
    ): RedirectResponse {
        $recruitment = new Recruitment();
        $form        = $this->createForm(RecruitmentType::class, $recruitment);
        $form->handleRequest($request);
        $recruitment->setSelectPosition($request->get('position'));
        $entityManager->persist($recruitment);
        $entityManager->flush();
        $this->addFlash('success', 'Köszönjük megkeresését, kollégáink hamarosan felveszik önnel a kapcsolatot');
        $recruitmentFactory->uploadCv($recruitment, $form->get('cv')->getData());

        return $this->redirect($request->headers->get('referer'));
    }

}
