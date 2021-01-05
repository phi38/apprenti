<?php

namespace App\DataFixtures;

use App\Entity\Cursus;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CursusFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 20; $count++) {
            $newItem = new Cursus();
            $newItem->setTitle("Titre " . $count);
            $newItem->setSubtitle("Titre " . $count);
            $newItem->setDescription("Titre " . $count);
            $newItem->setLevel(2);
            $newItem->setRights(666);
            $newItem->setPoints(100);
            $newItem->setLastupdate( new DateTimeImmutable());
            $newItem->setTheme("Découverte");
            
            $manager->persist($newItem);
        }
        $manager->flush();
    }
}
