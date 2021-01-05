<?php

namespace App\Repository;

use App\Entity\CursusFollowed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CursusFollowed|null find($id, $lockMode = null, $lockVersion = null)
 * @method CursusFollowed|null findOneBy(array $criteria, array $orderBy = null)
 * @method CursusFollowed[]    findAll()
 * @method CursusFollowed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CursusFollowedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CursusFollowed::class);
    }

    // /**
    //  * @return CursusFollowed[] Returns an array of CursusFollowed objects
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
    public function findOneBySomeField($value): ?CursusFollowed
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
