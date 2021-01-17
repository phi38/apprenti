<?php

namespace App\DataFixtures;

use App\Entity\InfosNews;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
class InfosNewsFixtures extends Fixture 
{


    public function load(ObjectManager $manager)
    {
         $infosNews = new InfosNews();
         $infosNews->setMessage("Splash Text");
         $infosNews->setType(0); // Bienvenue
         $manager->persist($infosNews);

        $manager->flush();
    }
}
