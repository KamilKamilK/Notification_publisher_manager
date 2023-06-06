<?php

declare(strict_types=1);

namespace App\NotificationPublisher\Domain;

use App\NotificationPublisher\Infrastructure\EmailNotificationService;
use App\NotificationPublisher\Infrastructure\SlackNotificationService;
use App\NotificationPublisher\Infrastructure\SMSNotificationService;
use Psr\Log\LoggerInterface;
use Symfony\Component\Notifier\Notification\Notification;

class NotificationService
{
    private EmailNotificationService $emailNotificationService;
    private SlackNotificationService $slackNotificationService;
    private SMSNotificationService $SMSNotificationService;
    private LoggerInterface $logger;

    public function __construct(
        EmailNotificationService $emailNotificationService,
        SlackNotificationService $slackNotificationService,
        SMSNotificationService   $SMSNotificationService,
        LoggerInterface          $mainLogger
    )
    {

        $this->emailNotificationService = $emailNotificationService;
        $this->slackNotificationService = $slackNotificationService;
        $this->SMSNotificationService = $SMSNotificationService;
        $this->logger = $mainLogger;
    }

    public function getNotificationProviders(): false|array|string
    {
        $channels = getenv('NOTIFICATION_PROVIDERS');
        return $channels !== '' ? explode(';', $channels) : [];
    }

    public function getNotificationProvidersArr(): false|array|string
    {
        $channels =  getenv('NOTIFICATION_PROVIDERS_ARRAY');
        return $channels !== '' ? explode(';', $channels) : [];
    }

    public function sendMessage(): void
    {
        $notification = $this->createNotification(
            'Email From Kamil',
            'You have registered properly');

        $recipient = $this->createRecipient('Kamil', 'example@gmail.com', '48505062951');

        $channels = $this->getNotificationProviders();
        $channelsArr =$this->getNotificationProvidersArr();

        if (!empty($channelsArr)) {
            foreach ($channelsArr as $provider) {
                try {
                    $this->chooseNotificationService($provider, $notification, $recipient);
                } catch (\Exception $exception) {
                    $this->logger->error($exception->getMessage());
                }
            }
        } else {
            $retryAttempts = 3;

            for ($attempt = 1; $attempt <= $retryAttempts; $attempt++) {
                foreach ($channels as $channel) {
                    try {
                        $this->chooseNotificationService($channel, $notification, $recipient);
                        return;
                    } catch (\Exception $exception) {
                        $this->logger->error($exception->getMessage());
                    }
                }

                if ($attempt < $retryAttempts) {
                    $this->logger->info('No notification where send. Process is initiated again ');
                    sleep(5);
                }
            }

            $this->handleFailure();
        }
    }

    public function createNotification(string $subject, string $context): Notification
    {
        return (new Notification())
            ->subject($subject)
            ->content($context);
    }

    public function createRecipient($name, $email, $phone): Recipient
    {
        return (new Recipient())
            ->setName($name)
            ->setEmail($email)
            ->setPhone($phone);
    }

    public function chooseNotificationService($service, $notification, $recipient): void
    {
        switch ($service) {
            case 'email' :
                $this->emailNotificationService->sendNotification($notification, $recipient);
                break;
            case 'chat':
                $this->slackNotificationService->sendNotification($notification);
                break;
            case 'SMS':
                $this->SMSNotificationService->sendNotification($notification, $recipient);
                break;
        }
    }

    public function handleFailure(): void
    {
        $this->logger->error('All channels failed to send notification');
    }
}
