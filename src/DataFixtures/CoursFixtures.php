<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Cours;
use App\Entity\Cursus;
use App\Entity\Profil;
use DateTimeImmutable;
use App\Entity\CursusContent;
use App\Entity\CursusFollowed;
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

        $newuser = new User();
        $newuser->setemail("superAdmin@yahoo.fr");
        $newuser->setPassword("superAdmin ");

        $newuser->setIsVerified(true);
        
        $manager->persist($newuser);

        $newprofile = new Profil();
        $newprofile->setPseudo("superAdmin");
        $newprofile->setLevel(2);
        $newprofile->setDescription("ma description");
        $newprofile->setLastupdate(new DateTimeImmutable());
        $newprofile->setUser($newuser);
        $manager->persist($newprofile);

  


        $newCursus = new Cursus();
        $newCursus->setTitle("Titre ".mt_rand(10,60) );
        $newCursus->setSubtitle("Titre " );
        $newCursus->setDescription("Titre ");
        $newCursus->setLevel(2);
        $newCursus->setRights(666);
        $newCursus->setPoints(100);
        $newCursus->setLastupdate( new DateTimeImmutable());
        $newCursus->setTheme("Découverte");
        $manager->persist($newCursus);
        
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

            $newCursusContent = new CursusContent();
            $newCursusContent->setCursus($newCursus);
            $newCursusContent->setCours($newItem);
            $newCursusContent->setPosition($count);
            $manager->persist($newCursusContent);
        }

        $newCursusFollowed = new CursusFollowed();
        $newCursusFollowed->setCursus($newCursus);
        $newCursusFollowed->setUser($newuser);
        $newCursusFollowed->setStartDate( new DateTimeImmutable());
        $manager->persist($newCursusFollowed);
        $manager->flush();
    }
}
