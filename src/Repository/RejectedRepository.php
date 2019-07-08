<?php

namespace App\Repository;

use App\Entity\Rejected;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Rejected|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rejected|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rejected[]    findAll()
 * @method Rejected[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RejectedRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Rejected::class);
    }

    // /**
    //  * @return Rejected[] Returns an array of Rejected objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rejected
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
