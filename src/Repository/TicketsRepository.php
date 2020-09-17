<?php

namespace App\Repository;

use App\Entity\Tickets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Types\StringType;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tickets|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tickets|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tickets[]    findAll()
 * @method Tickets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tickets::class);
    }

    // /**
    //  * @return Tickets[] Returns an array of Tickets objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tickets
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @param StringType $x
     * @return mixed[]
     * @throws DBALException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findTicktbyLine($x): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql='SELECT t.amount,lt.name ,l.line_number   FROM tickets t, line l ,line_type lt WHERE l.id=t.Line_id and lt.id =l.id AND l.line_number=:x';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['x' => $x ]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }
}
