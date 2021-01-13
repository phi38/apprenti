<?php

namespace App\Repository;

use App\Entity\ForbidenMachine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ForbidenMachine|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForbidenMachine|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForbidenMachine[]    findAll()
 * @method ForbidenMachine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForbidenMachineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForbidenMachine::class);
    }

    // /**
    //  * @return ForbidenMachine[] Returns an array of ForbidenMachine objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ForbidenMachine
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
