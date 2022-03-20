<?php

namespace App\DataFixtures;

use App\Factory\CartFactory;
use App\Factory\NormalProductFactory;
use App\Factory\OrderCartFactory;
use App\Factory\SaleProductFactory;
use App\Factory\WishListCartFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        SaleProductFactory::new()->many(10)->create();
        NormalProductFactory::new()->many(10)->create();

        $manager->flush();
    }
}
