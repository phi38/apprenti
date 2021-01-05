<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $newItem = new User();
        $newItem->setemail("pcottaz@yahoo.fr");
        $newItem->setPassword("Titre ");
        $newItem->setPseudo("Phil");
        $newItem->setIsVerified(true);
        
        $manager->persist($newItem);

        $manager->flush();
    }
}
