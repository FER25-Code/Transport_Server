<?php

namespace App\Repository;

use App\Entity\LineStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LineStation|null find($id, $lockMode = null, $lockVersion = null)
 * @method LineStation|null findOneBy(array $criteria, array $orderBy = null)
 * @method LineStation[]    findAll()
 * @method LineStation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LineStationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LineStation::class);
    }

    /**
     * @param $x
     * @return mixed[]
     * @throws DBALException
     */
    public function findStationbyLine($x):array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql ='SELECT s.name FROM line_station ls
             ,station s,line l 
             WHERE s.id=ls.station_id 
             AND ls.line_id=l.id
             AND l.line_number=:nbrline';
        $stmt = $conn->prepare($sql);
      $stmt->execute(['nbrline' => $x ]);
//        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * @param $x
     * @return mixed[]
     * @throws DBALException
     */
    public function findStationbyLineBus($x):array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql ='SELECT s.NAME,ps.latitude ,ps.longitude    from line_station ls
             ,station s,line l ,position ps 
             WHERE s.id=ls.station_id 
             AND ls.line_id=l.id
             AND l.line_number=:nbrline 
				 AND s.Position_id = ps.id';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['nbrline' => $x ]);
        return $stmt->fetchAll();
    }

    /**
     * @param $x
     * @return mixed[]
     * @throws DBALException
     */
    public function findStationbyBus($x):array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql ='SELECT s.name FROM line_station ls
             ,station s,line l 
             WHERE s.id=ls.station_id 
             AND ls.line_id=l.id
             AND l.id=:idline';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['idline' => $x ]);
//        $stmt->execute();
        return $stmt->fetchAll();
    }





    // /**
    //  * @return LineStaton[] Returns an array of LineStaton objects
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
    public function findOneBySomeField($value): ?LineStaton
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
