<?php

namespace App\Services;

use App\Entity\Recruitment;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class RecruitmentMailSend
{

    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * MailSend constructor.
     *
     * @param   MailerInterface  $mailer
     * @param   LoggerInterface  $logger
     */
    public function __construct(MailerInterface $mailer, LoggerInterface $logger)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
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

}
