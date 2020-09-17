<?php

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Customer::class);
    }


    /**
     * @param string $station1
     * @param string $station2
     * @return mixed[]
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findBetweenStations(string $station1 ,string $station2) :array {
        $conn = $this->getEntityManager()->getConnection();
        $sql =
            'SELECT l.line_number, l.color_type ,p1.latitude AS latitude1 ,p1.longitude AS longitude1  ,p2.latitude AS latitude2 ,p2.longitude AS longitude2 from line_station ls , station s1, station s2,line l, position p1,position p2 WHERE ls.line_id =l.id
             AND ls.station_id=s1.id
             AND p1.id=s1.Position_id 
             AND p2.id=s2.Position_id 
             and s1.name =:station1 
             AND s2.name=:station2
             GROUP by(l.id)';
//        $sql =
//            'SELECT l.line_number, l.color_type from line_station ls , station s1, station s2,line l WHERE ls.line_id =l.id
//              AND ls.station_id=s1.id AND s1.name =:station1 AND s2.name=:station2 GROUP by(l.id)';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['station1' => $station1 ,'station2' => $station2]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }







    // /**
    //  * @return Customer[] Returns an array of Customer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Customer
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    /**
     * @param $customer
     * @param $nbrBus
     * @param $note
     * @return mixed[]
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findEvaluation($customer,$nbrBus ,$note) :array {
        $conn = $this->getEntityManager()->getConnection();
        $sql =
            'INSERT INTO evaluation (customer_id,ride_id,nbr_bus,note) VALUES (:customer,NULL,:nbrBus,:note)';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['customer' => $customer ,'nbrBus' => $nbrBus,'note' => $note]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }

}
