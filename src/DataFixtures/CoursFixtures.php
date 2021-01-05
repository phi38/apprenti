<?php

namespace App\DataFixtures;

use App\Entity\Cours;
use App\Entity\Cursus;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CoursFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $content = array(
            'type' => "XX",
            'partition'=> "YY",
        );
        for ($count = 0; $count < 20; $count++) {
            $newItem = new Cours();
            $newItem->setType( $count);
            $newItem->setTitle("Titre " . $count);
            $newItem->setSubtitle("Titre " . $count);
            $newItem->setDescription("Titre " . $count);
            $newItem->setLevel(2);
            $newItem->setLastupdate( new DateTimeImmutable());
            $newItem->setTheme("Découverte");
            $newItem->setContent($content);   
            $newItem->setDescription("description") ;
            $manager->persist($newItem);
        }
        $manager->flush();
    }
}
