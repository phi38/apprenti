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
        for ($usernum = 0; $usernum < 3; $usernum++) {
            $content = array(
                'type' => "XX".$usernum,
                'partition'=> "YY".$usernum,
            );

            $newuser = new User("".$usernum."superAdmin@yahoo.fr");
            $newuser->setemail("".$usernum."superAdmin@yahoo.fr");
            $newuser->setPassword("superAdmin ");
            $newuser->setIsVerified(true);      
            $manager->persist($newuser);

            $newprofile = new Profil();
            $newprofile->setPseudo("superAdmin".$usernum);
            $newprofile->setLevel(2);
            $newprofile->setDescription("ma description".$usernum);
            $newprofile->setLastupdate(new DateTimeImmutable());
            $newprofile->setOwner($newuser);
            $manager->persist($newprofile);

    


            $newCursus = new Cursus();
            $newCursus->setTitle("Titre ".mt_rand(10,60) );
            $newCursus->setSubtitle("Titre ".$usernum );
            $newCursus->setDescription("Titre ".$usernum);
            $newCursus->setLevel(2);
            $newCursus->setRights(666);
            $newCursus->setPoints(100);
            $newCursus->setLastupdate( new DateTimeImmutable());
            $newCursus->setTheme("Découverte".$usernum);
            $manager->persist($newCursus);
            
            for ($count = 0; $count < 20; $count++) {
                $newItem = new Cours();
                $newItem->setType( $count);
                $newItem->setTitle("Titre " .$usernum. $count);
                $newItem->setSubtitle("Titre ".$usernum . $count);
                $newItem->setDescription("Titre ".$usernum . $count);
                $newItem->setLevel(2);
                $newItem->setLastupdate( new DateTimeImmutable());
                $newItem->setTheme("Découverte".$usernum);
                $newItem->setContent($content);   
                $newItem->setDescription("description".$usernum) ;
                $manager->persist($newItem);

                $newCursusContent = new CursusContent();
                $newCursusContent->setCursus($newCursus);
                $newCursusContent->setCours($newItem);
                $newCursusContent->setPosition($count);
                $manager->persist($newCursusContent);
            }

            $newCursusFollowed = new CursusFollowed();
            $newCursusFollowed->setCursus($newCursus);
            $newCursusFollowed->setProfil($newprofile);
            $newCursusFollowed->setStartDate( new DateTimeImmutable());
            $manager->persist($newCursusFollowed);
            $manager->flush();
        }
    }
}
