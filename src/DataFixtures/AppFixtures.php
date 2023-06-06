<?php

namespace App\DataFixtures;

use AllowDynamicProperties;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AllowDynamicProperties] class AppFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('example@account.com');

        $hashedPassword = $this->userPasswordHasher->hashPassword($user, 'enter');
        $user->setPassword($hashedPassword);

        $manager->persist($user);
        $manager->flush();
    }
}
