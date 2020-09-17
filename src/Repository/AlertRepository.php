<?php

namespace App\Repository;

use App\Entity\Alert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Symfony\Bridge\Doctrine\RegistryInterface;
///**
// * @method Alert|null find($id, $lockMode = null, $lockVersion = null)
// * @method Alert|null findOneBy(array $criteria, array $orderBy = null)
// * @method Alert[]    findAll()
// * @method Alert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
// */

/**
 * @method getDoctrine()
 */
class AlertRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Alert::class);
    }

    // /**
    //  * @return Alert[] Returns an array of Alert objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Alert
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    /**
     * @param float $x
     * @param float $y
     * @return mixed[]
     * @throws DBALException
     */
    public function findByalertPosition ( $x,$y): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql =
            'SELECT COMMENT FROM alert a , Position p
        WHERE a.Position_id=p.id
     and p.latitude=:x
      AND p.longitude=:y';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['x' => $x ,'y' => $y]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }



    public function findByalertType( ): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql =
            'SELECT a.id , a.NAME ,a.descripton,a.`level` FROM alert_type a ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }

    public function getByalertType( ): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql =
            'SELECT alty.descripton ,alty.`level` ,ly.name  FROM alert alt ,alert_type alty ,line li,line_type ly  
WHERE li.id = ly.id AND alt.id = alty.id ;';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }

}