<?php

namespace App\Repository;

use App\Entity\Station;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Types\StringType;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Station|null find($id, $lockMode = null, $lockVersion = null)
 * @method Station|null findOneBy(array $criteria, array $orderBy = null)
 * @method Station[]    findAll()
 * @method Station[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Station::class);
    }

    // /**
    //  * @return Station[] Returns an array of Station objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Station
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
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
    public function findBybusStation ($x): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql ='SELECT  v.nbr_bus , v.mark ,l.line_number,lt.name ,r.departure_date ,r.finish_date
               FROM  ride r, vehicle v , line l, line_station ls, station s,line_type lt
               WHERE r.line_id=l.id AND  ls.line_id=l.id AND ls.station_id=s.id AND lt.id=ls.line_id
               AND v.id=r.Vehicle_id AND s.NAME=:x ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['x' => $x ]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }



    /**
     * @param string $Vilex
     * @param int $directionx
     * @return mixed[]
     * @throws DBALException
     */
    public function findByPos(string $Vilex ,int $directionx) :array {
        $conn = $this->getEntityManager()->getConnection();
        $sql =
            ' SELECT v.nbr_bus , v.mark , v.register_nbr 
        FROM vehicle v ,ride r , station s , line_station l
        WHERE r.line_id=l.line_id 
        AND r.Vehicle_id=v.id 
        AND r.Vehicle_id=v.id
        AND l.station_id= s.id
        and s.name=:vile
        and r.direction= :y';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['vile' => $Vilex ,'y' => $directionx]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }


    /**
     * @param int $id
     * @return mixed[]
     * @throws DBALException
     */
    public function findBFavorites(int $id) :array {
        $conn = $this->getEntityManager()->getConnection();
        $sql =
            'SELECT s.name from station s, favorites f WHERE f.Station_id =s.id AND f.Customer_id=:id';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }


    /**
     * @return mixed[]
     * @throws DBALException
     */
    public function findAllstation() :array {
        $conn = $this->getEntityManager()->getConnection();
        $sql =
            'SELECT s.name FROM station s';
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);
        return $stmt->fetchAll();

    }

    /**
     * @return mixed[]
     * @throws DBALException
     */
    public function findBusperStation() :array {
        $conn = $this->getEntityManager()->getConnection();
        $sql =
            'SELECT  s.NAME ,p.latitude ,p.longitude ,v.nbr_bus , r.departure_date , r.finish_date FROM position p, station s , ride r, vehicle v  , line l, line_station ls
WHERE p.id=s.Position_id and ls.line_id=l.id AND s.id=ls.station_id AND l.id=r.line_id AND l.id=v.id GROUP BY s.name';
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);
        return $stmt->fetchAll();

    }


    /**
     * @param StringType $x
     * @return mixed[]
     * @throws DBALException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findbusbyStationPosition ($x): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql='SELECT  v.nbr_bus , v.mark ,l.line_number , v.latitude , v.longitude ,
 i.TIME FROM ride r, vehicle v , line l, line_station ls, station s , interstation i
WHERE r.line_id=l.id AND  ls.line_id=l.id AND ls.station_id=s.id AND v.id=r.Vehicle_id 
AND i.one_Station= v.on_station 
AND s.id=i.other_Station AND  s.NAME=:x';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['x' => $x ]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }
    /**
     * @param $x
     * @return mixed[]
     * @throws DBALException
     */
    public function addStation($x) :array {
        $conn = $this->getEntityManager()->getConnection();
        $sql =
            'INSERT INTO station ( name ,position_id) VALUES (:x,null )';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['x' => $x ]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }



    /**
     * @param $x
     * @return mixed[]
     * @throws DBALException
     */
    public function deleteStation($x) :array {
        $conn = $this->getEntityManager()->getConnection();
        $sql =
            'DELETE FROM station WHERE id=:x';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['x' => $x ]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }


}
