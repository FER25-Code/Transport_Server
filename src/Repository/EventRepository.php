<?php

namespace App\Repository;

use App\Entity\Event;
use App\Entity\Position;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Event::class);
    }

    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    */


    public function findEventsByPosition(Position $position=null)
    {
        $qb = $this->createQueryBuilder('e');
        $qb->where('e.startDate <= :today')
            ->andWhere('e.endDate >= :today')
            ->setParameter('today', new \DateTime());

//           >leftJoin('e.rPosition', 'p')
//           ->where('p.latitude < :lat')
//           ->where('p.longitude = :long')
//           ->setParameter('user', $users)
//           ->orderBy('a.created_at', 'DESC');
//          ->andWhere('e.exampleField = :val')
//          ->setParameter('val', $value);

        return $qb->getQuery()->getResult();
    }
    public function FindEvintByPosition(Position $position=null){
        $qp=$this->createQueryBuilder('e');
        $qp->where('e.longitude= :65.73149')
            ->andWhere('e.latitude= :36.24587')
            ->setParameter("65.73149,36.24587",new Position());

        return $qp->getQuery()->getResult();

    }

    /**
     * @param float $x
     * @param $y
     * @return mixed[]
     * @throws DBALException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findByeventPosition ( $x,$y): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql =

        'SELECT e.name , e.description, e.start_date , e.end_date 
FROM event e , position p WHERE e.Position_id=p.id and p.latitude=:x AND p.longitude=:y';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['x' => $x ,'y' => $y]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }






}
