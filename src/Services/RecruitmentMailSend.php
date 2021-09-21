<?php

namespace App\Services;

use App\Entity\Recruitment;
use App\Enum\EmailEnum;
use App\Enum\RecruitmentTypeEnum;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class RecruitmentMailSend
{

    /**  @var MailerInterface */
    private $mailer;
    /** @var LoggerInterface */
    private $logger;
    /** @var RecruitmentArrayConverter */
    private $arrayConverter;
    /** @var FilePathProvider */
    private $filePathProvider;

    /**
     * RecruitmentMailSend constructor.
     *
     * @param   MailerInterface            $mailer
     * @param   LoggerInterface            $logger
     * @param   RecruitmentArrayConverter  $arrayConverter
     * @param   FilePathProvider           $filePathProvider
     */
    public function __construct(
        MailerInterface $mailer,
        LoggerInterface $logger,
        RecruitmentArrayConverter $arrayConverter,
        FilePathProvider $filePathProvider
    ) {
        $this->mailer           = $mailer;
        $this->logger           = $logger;
        $this->arrayConverter   = $arrayConverter;
        $this->filePathProvider = $filePathProvider;
    }


    /**
     * @param   string       $from
     * @param   string       $to
     * @param   string       $subject
     * @param   array        $parameters
     * @param   string       $template
     * @param   string|null  $cc
     * @param   string|null  $bcc
     * @param   array|null   $attachments
     *
     * @throws TransportExceptionInterface
     */
    public function send(
        string $from,
        string $to,
        string $subject,
        array $parameters,
        string $template = 'contact',
        string $cc = null,
        string $bcc = null,
        array $attachments = []
    ): void {
        $email = (new TemplatedEmail())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->htmlTemplate('email/'.$template.'.html.twig')
            ->context($parameters);
        if ($cc) {
            $email->cc($cc);
        }
        if ($bcc) {
            $email->bcc($bcc);
        }
        foreach ($attachments as $a) {
            $email->attachFromPath($a);
        }
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            $this->logger->error(sprintf('Error: %s while sending mail from: %s to: %s', $e->getMessage(), $from, $to));
            throw $e;
        }
    }

    public function sendAll(Recruitment $recruitment)
    {
        $recruitmentType = $recruitment->getType();
        switch ($recruitmentType) {
            case RecruitmentTypeEnum::TYPE_CONTACT:
                $this->send(
                    EmailEnum::EMAIL_INFO,
                    EmailEnum::EMAIL_INFO,
                    $recruitment->getSubject(),
                    $this->arrayConverter->convert($recruitment),
                    $recruitmentType,
                    EmailEnum::EMAIL_TOTH_ANDRAS
                );
                break;
            case RecruitmentTypeEnum::TYPE_CARREER:
                $this->send(
                    EmailEnum::EMAIL_INFO,
                    $recruitment->getEmail(),
                    $recruitment->getSubject(),
                    $this->arrayConverter->convert($recruitment),
                    $recruitment->getType(),
                    null
                );
                $this->send(
                    EmailEnum::EMAIL_INFO,
                    EmailEnum::EMAIL_JOBS,
                    $recruitment->getSubject(),
                    $this->arrayConverter->convert($recruitment),
                    RecruitmentTypeEnum::TYPE_CAREER_INTERNAL,
                    null,
                    null,
                    $this->filePathProvider->provideFilePathsByDirectory(RecruitmentFactory::UPLOADS_BASE_DIR.$recruitment->getId().DIRECTORY_SEPARATOR)
                );
                break;

            default:
                throw new \Exception('This type of recuitement doesnt exist');
                break;
        }
    }


}
