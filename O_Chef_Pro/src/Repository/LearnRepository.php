<?php

namespace App\Repository;

use App\Entity\Learn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Learn|null find($id, $lockMode = null, $lockVersion = null)
 * @method Learn|null findOneBy(array $criteria, array $orderBy = null)
 * @method Learn[]    findAll()
 * @method Learn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LearnRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Learn::class);
    }

    // /**
    //  * @return Learn[] Returns an array of Learn objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Learn
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
