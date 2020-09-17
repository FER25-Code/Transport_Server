<?php

namespace App\Repository;

use App\Entity\Line;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Line|null find($id, $lockMode = null, $lockVersion = null)
 * @method Line|null findOneBy(array $criteria, array $orderBy = null)
 * @method Line[]    findAll()
 * @method Line[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LineRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Line::class);
    }

    // /**
    //  * @return LINE[] Returns an array of LINE objects
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
    public function findOneBySomeField($value): ?LINE
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
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
     * @throws DBALException
     */
    public function findBylineFavorites ( $x): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql =
            'SELECT l.line_number from line l, favorites f WHERE l.id=f.line_id 
         AND f.Customer_id=1';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['x' => $x ]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }


    /**
     * @param $x
     * @param $y

     * @return mixed[]
     * @throws DBALException
     */
    public function addLine($x,$y) :array {
        $conn = $this->getEntityManager()->getConnection();
        $sql =
            'INSERT INTO line (color_type ,line_number,linetype_id) VALUES (:x,:y,null)';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['x' => $x ,'y' => $y]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }


    /**
     * @return mixed[]
     * @throws DBALException
     */
    public function findallline():array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql ='SELECT l.line_number, t.name,l.color_type FROM line l , line_type t
                 WHERE t.id=l.LineType_id';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();




    }

    /**
     * @param $x
     * @return mixed[]
     * @throws DBALException
     */
    public function deleteLine($x) :array {
        $conn = $this->getEntityManager()->getConnection();
        $sql =
            'DELETE FROM Line WHERE id=:x';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['x' => $x ]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }

}
