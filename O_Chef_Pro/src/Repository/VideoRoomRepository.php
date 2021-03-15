<?php

namespace App\Repository;

use App\Entity\VideoRoom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VideoRoom|null find($id, $lockMode = null, $lockVersion = null)
 * @method VideoRoom|null findOneBy(array $criteria, array $orderBy = null)
 * @method VideoRoom[]    findAll()
 * @method VideoRoom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoRoomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VideoRoom::class);
    }

    // /**
    //  * @return VideoRoom[] Returns an array of VideoRoom objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VideoRoom
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
