<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFactory extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $user = new User();
         $user->setEmail('ahmed@gmail.com');
         $user->setName('Ahmed');
         $user->setPassword('ahmed');
         $manager->persist($user);

        $manager->flush();
    }
}
