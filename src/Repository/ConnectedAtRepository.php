<?php

namespace App\Repository;

use App\Entity\ConnectedAt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ConnectedAt|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConnectedAt|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConnectedAt[]    findAll()
 * @method ConnectedAt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConnectedAtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConnectedAt::class);
    }

    // /**
    //  * @return ConnectedAt[] Returns an array of ConnectedAt objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ConnectedAt
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
