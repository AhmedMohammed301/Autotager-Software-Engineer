<?php

namespace App\DataFixtures;

use App\Entity\Carts\OrderCart;
use App\Entity\Carts\WishListCart;
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
        $user->setPassword('$2y$13$3N9QNPRq095RNrPskVvpXOxMFDtPtyC09rEWyxynIPQI0wrYZeM8i'); // ahmed
        $manager->persist($user);

        $wish =new WishListCart();
        $wish->setUser($user);
        $wish->setName('wish-list');
        $wish->setTotalAmount(0);
        $wish->setTotalPrice(0);
        $manager->persist($wish);

        $order =new OrderCart();
        $order->setUser($user);
        $order->setName('order');
        $order->setTotalAmount(0);
        $order->setTotalPrice(0);
        $manager->persist($order);

        $manager->flush();
    }
}
