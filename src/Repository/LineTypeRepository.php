<?php

namespace App\Repository;

use App\Entity\LineType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LineType|null find($id, $lockMode = null, $lockVersion = null)
 * @method LineType|null findOneBy(array $criteria, array $orderBy = null)
 * @method LineType[]    findAll()
 * @method LineType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LineTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LineType::class);
    }

    // /**
    //  * @return LineType[] Returns an array of LineType objects
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
    public function findOneBySomeField($value): ?LineType
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
