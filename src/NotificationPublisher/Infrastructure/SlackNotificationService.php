<?php
declare(strict_types=1);

namespace App\NotificationPublisher\Infrastructure;

use App\NotificationPublisher\Domain\Recipient;
use App\NotificationPublisher\Interfaces\NotificationServiceInterface;
use Nexy\Slack\Client;
use Symfony\Component\Notifier\Notification\Notification;


class SlackNotificationService implements NotificationServiceInterface
{

    private Client $slack;

    public function __construct(Client $slack)
{
    $this->slack = $slack;
}

    public function sendNotification(Notification $notification, ?Recipient $recipient = null): void
    {
        $message = $this->slack->createMessage()
            ->from(getenv('SLACK_SENDER'))
            ->withIcon(':ghost:')
            ->setText($notification->getContent());

        $this->slack->sendMessage($message);
    }
}
