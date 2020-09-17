<?php


namespace App\Controller\Rest;
use App\Entity\AlertType;
use App\Repository\AlertTypeRepository;
use Doctrine\DBAL\DBALException;
use FOS\RestBundle\Controller\FOSRestController;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\DBAL\Driver\Connection;

/**
  * @method getEntityManager()
 * @property AlertTypeRepository repository
 */
class AlertTypeController  extends FOSRestController
{

    public function __construct(AlertTypeRepository $repository)
    {
        $this->repository = $repository;

    }

    /**
     * @@Route("/alertType", name="alerts_show")
     * @throws DBALException
     */
    public function getAllAlertType()
    {

        $data = $this->repository->findallAlert();

        return View::create($data, Response::HTTP_OK);
    }


}