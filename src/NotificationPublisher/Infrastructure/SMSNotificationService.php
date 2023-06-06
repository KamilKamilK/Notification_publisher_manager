<?php

declare(strict_types=1);

namespace App\NotificationPublisher\Infrastructure;

use App\NotificationPublisher\Domain\Recipient;
use App\NotificationPublisher\Interfaces\NotificationServiceInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Twilio\Rest\Client;

class SMSNotificationService implements NotificationServiceInterface
{
    public function sendNotification(Notification $notification, ?Recipient $recipient = null): void
    {
        $account_sid = getenv('TWILIO_ACCOUNT_SID');
        $auth_token = getenv('TWILIO_AUTH_TOKEN');

        $twilio_number = getenv('TWILIO_PHONE_NUMBER');

        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            $recipient->getPhone(),
            array(
                'from' => $twilio_number,
                'body' => $notification->getContent()
            )
        );
    }
}
