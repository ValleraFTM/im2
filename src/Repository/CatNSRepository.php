<?php

namespace App\Repository;

use App\Entity\CatNS;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CatNS|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatNS|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatNS[]    findAll()
 * @method CatNS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatNSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatNS::class);
    }

    // /**
    //  * @return CatNS[] Returns an array of CatNS objects
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
    public function findOneBySomeField($value): ?CatNS
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
