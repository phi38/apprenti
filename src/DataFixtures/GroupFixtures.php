<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Group;
use App\Entity\Profil;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 20; $count++) {
            $newItem = new Group();
            $newItem->setName("recherche partition");
            $newItem->setTheme("Aide");
            $manager->persist($newItem);
        }

        $manager->flush();
    }
}
