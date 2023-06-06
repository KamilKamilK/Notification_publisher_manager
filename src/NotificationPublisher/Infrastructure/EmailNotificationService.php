<?php

declare(strict_types=1);

namespace App\NotificationPublisher\Infrastructure;

use App\NotificationPublisher\Domain\Recipient;
use App\NotificationPublisher\Interfaces\NotificationServiceInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Notifier\Notification\Notification;

class EmailNotificationService implements NotificationServiceInterface
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer,)
    {

        $this->mailer = $mailer;
    }

    public function sendNotification(Notification $notification, ?Recipient $recipient = null): void
    {
        $to = $recipient->getEmail();
        $subject = $notification->getSubject();
        $message = $notification->getContent() ?? null;

        $email = (new Email())
            ->from(new Address(getenv('SENDER_EMAIL_ADRRESS'), 'Notification publisher manager by Kamil'))
            ->to($to)
            ->subject($subject)
            ->text($message);

        $this->mailer->send($email);
    }
}
