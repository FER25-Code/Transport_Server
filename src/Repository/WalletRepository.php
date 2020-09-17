<?php

namespace App\Repository;

use App\Entity\Wallet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Types\StringType;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Wallet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wallet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wallet[]    findAll()
 * @method Wallet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WalletRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Wallet::class);
    }

    // /**
    //  * @return Wallet[] Returns an array of Wallet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Wallet
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
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
    public function findWalletbyUser($x): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql='SELECT w.amounttotal FROM wallet w , user u WHERE w.User_id=u.id AND u.id=:x';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['x' => $x ]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }
}
