<?php

namespace App\Repository;

use App\Entity\AlertType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\DBAL\DBALException;


/**
 * @method getDoctrine()
 */
class AlertTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AlertType::class);
    }
    /**
     * @return array
     * @throws DBALException
     */
    public function findallAlert(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql =
            'SELECT * FROM AlertType';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();

    }


}
