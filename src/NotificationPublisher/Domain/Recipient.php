<?php

declare(strict_types=1);

namespace App\NotificationPublisher\Domain;

class Recipient
{
    private string $id;
    private string $name;
    private string $email;
    private string $phone;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Recipient
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Recipient
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): Recipient
    {
        $this->phone = $phone;
        return $this;
    }
}
