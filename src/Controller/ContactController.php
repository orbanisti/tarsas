<?php


namespace App\Controller;


use App\Entity\Recruitment;
use App\Enum\EmailEnum;
use App\Enum\RecruitmentTypeEnum;
use App\Form\RecruitmentType;
use App\Services\RecruitmentArrayConverter;
use App\Services\RecruitmentFactory;
use App\Services\RecruitmentMailSend;
use App\Services\RecruitmentMailDestinationProvider;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContactController
 * @Route("/",priority="10")
 *
 * @package App\Controller
 */
class ContactController extends AbstractController
{

    /**
     * @Route("/contactRecruitmentSubmit", methods="POST", name="contact_recruitment_submit")
     * @param   Request                 $request
     * @param   RecruitmentFactory      $recruitmentFactory
     * @param   EntityManagerInterface  $entityManager
     *
     * @param   RecruitmentMailSend     $mailSend
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function submitRecruitmentForm(
        Request $request,
        RecruitmentFactory $recruitmentFactory,
        EntityManagerInterface $entityManager,
        RecruitmentMailSend $mailSend
    ): RedirectResponse {
        $recruitment = new Recruitment();
        $recruitment->setCreatedAt(new \DateTime('now'));
        $recruitment->setUpdatedAt(new \DateTime('now'));
        $form = $this->createForm(RecruitmentType::class, $recruitment);
        $form->handleRequest($request);
        $recruitment->setSelectPosition($request->get('position'));
        $recruitment->setSubject($request->get('subject') ?? null);
        $recruitment->setType($request->get('type') ?? RecruitmentTypeEnum::TYPE_CONTACT);
        $entityManager->persist($recruitment);
        $entityManager->flush();
        $this->addFlash('success', 'Köszönjük megkeresését, kollégáink hamarosan felveszik önnel a kapcsolatot');
        if ($form->get('cv')->getData()) {
            $recruitmentFactory->uploadCv($recruitment, $form->get('cv')->getData());
        }

        try {
            //Contact and Career feedback email
            $mailSend->sendAll($recruitment);
        } catch (\Exception $exception) {
            throw $exception;
        }


        return $this->redirect($request->headers->get('referer'));
    }

}
