<?php

namespace App\DataPersister;

use App\Entity\User;
use App\Entity\Profil;
use DateTimeImmutable;
use App\Entity\CursusFollowed;
use App\Repository\CursusRepository;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

class UserDataPersister implements DataPersisterInterface
{

    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager )
    {
        $this->entityManager = $entityManager;

    }

    public function supports($data): bool
    {
        return $data instanceof User;
    }

    /**
     * @param User $data
     */
    public function persist($data)
    {

  
  
        //$this->entityManager;
        /*
        $data->setProfil( new Profil());
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    */}

    public function remove($data)
    {
        // not possible
       // $this->entityManager->remove($data);
       // $this->entityManager->flush();
    }


}
