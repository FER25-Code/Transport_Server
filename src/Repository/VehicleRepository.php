<?php

namespace App\Repository;

use App\Entity\Vehicle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Vehicle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicle[]    findAll()
 * @method Vehicle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Vehicle::class);
    }





    /**
     * @return mixed[]
     * @throws DBALException
     */
    public function findAllBus():array
    {
        $conn = $this->getEntityManager()->getConnection();
//        $sql='SELECT  v.nbr_bus  ,l.name,ls.line_id,
//               r.departure_date,r.finish_date FROM
//                ride r, vehicle v ,
//	            line_type l,
//	            line_station ls
//                   WHERE ls.line_id=l.id
//                   AND  l.id=r.line_id
//               AND l.id=v.id';
        $sql ='SELECT  v.nbr_bus,ly.NAME ,l.id,r.departure_date,r.finish_date  FROM 
                ride r, vehicle v ,line l ,line_type ly
                WHERE l.LineType_id= ly.id GROUP BY(v.nbr_bus) ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();




    }


    // /**
    //  * @return Vehicle[] Returns an array of Vehicle objects
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
    public function findOneBySomeField($value): ?Vehicle
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @param $x
     * @param $y
     * @param $z
     * @param $a
     * @param $b
     * @param $c
     * @return mixed[]
     * @throws DBALException
     */
    public function addBus($x,$y,$z,$a,$b,$c) :array {
        $conn = $this->getEntityManager()->getConnection();
        $sql =
            'INSERT INTO vehicle (nbr_bus,mark,vehicleowner_id,vehicleType_id,latitude,longitude,on_station,register_nbr) VALUES (:x,:y,null,null,:z,:a,:b,:c)';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['x' => $x ,'y' => $y,'z' => $z ,'a' => $a ,'b' => $b,'c'=>$c]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }
    /**
     * @return mixed[]
     * @throws DBALException
     */
    public function findBus():array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql ='SELECT v.username,vt.name FROM vehicle_owner v,vehicle_type vt';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
