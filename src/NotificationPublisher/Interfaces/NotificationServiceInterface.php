<?php

namespace App\NotificationPublisher\Interfaces;

use App\NotificationPublisher\Domain\Recipient;
use Symfony\Component\Notifier\Notification\Notification;

interface NotificationServiceInterface
{
    public function sendNotification(Notification $notification, ?Recipient $recipient = null);
}
