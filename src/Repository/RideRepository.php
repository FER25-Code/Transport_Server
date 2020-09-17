<?php

namespace App\Repository;

use App\Entity\Ride;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ride|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ride|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ride[]    findAll()
 * @method Ride[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RideRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ride::class);
    }

    // /**
    //  * @return Ride[] Returns an array of Ride objects
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
    public function findOneBySomeField($value): ?Ride
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @param float $x
     * @return mixed[]
     * @throws DBALException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findByevalRide ( $x): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql ='SELECT e.comment FROM Evaluation e , ride r WHERE e.ride_id=r.id AND e.customer_id= :x';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['x' => $x ]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }




}
