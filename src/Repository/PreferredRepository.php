<?php

namespace App\Repository;

use App\Entity\Preferred;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Preferred|null find($id, $lockMode = null, $lockVersion = null)
 * @method Preferred|null findOneBy(array $criteria, array $orderBy = null)
 * @method Preferred[]    findAll()
 * @method Preferred[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreferredRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Preferred::class);
    }

    // /**
    //  * @return Preferred[] Returns an array of Preferred objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Preferred
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
