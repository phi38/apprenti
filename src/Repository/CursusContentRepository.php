<?php

namespace App\Repository;

use App\Entity\CursusContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CursusContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method CursusContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method CursusContent[]    findAll()
 * @method CursusContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CursusContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CursusContent::class);
    }

    // /**
    //  * @return CursusContent[] Returns an array of CursusContent objects
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
    public function findOneBySomeField($value): ?CursusContent
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
