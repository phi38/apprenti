<?php

namespace App\Repository;

use App\Entity\InfosNews;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InfosNews|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfosNews|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfosNews[]    findAll()
 * @method InfosNews[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfosNewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfosNews::class);
    }

    // /**
    //  * @return InfosNews[] Returns an array of InfosNews objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InfosNews
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
