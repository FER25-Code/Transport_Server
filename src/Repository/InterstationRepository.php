<?php

namespace App\Repository;

use App\Entity\Interstation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Interstation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Interstation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Interstation[]    findAll()
 * @method Interstation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InterstationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Interstation::class);
    }

    // /**
    //  * @return Interstation[] Returns an array of Interstation objects
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
    public function findOneBySomeField($value): ?Interstation
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
