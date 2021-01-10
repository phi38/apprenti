<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $newItem = new User("pcottaz@yahoo.fr");
        $newItem->setemail("pcottaz@yahoo.fr");
        $newItem->setPassword("Titre ");

        $newItem->setIsVerified(true);
        
        $manager->persist($newItem);

        $newItem2 = new Profil();
        $newItem2->setPseudo("Phil");
        $newItem2->setLevel(2);
        $newItem2->setDescription("ma description");
        $newItem2->setLastupdate(new DateTimeImmutable());
        $newItem2->setOwner($newItem);
        $manager->persist($newItem2);

        $manager->flush();
    }
}
