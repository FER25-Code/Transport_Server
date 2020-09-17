<?php


namespace App\Controller\Rest;


use App\Repository\LineStationRepository;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Mapping as ORM;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * @property LineStationRepository repository
 */
class LineStationController  extends FOSRestController
{



    public function __construct(LineStationRepository $repository)
    {
        $this->repository = $repository;

    }

    /**
     * @Route("/stationbyline/{y}")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @param $y
     * @return View
     * @throws \Doctrine\DBAL\DBALException
     */
    public function StationbyLine($y) :View
    {
        $data = $this->repository->findStationbyLine($y);

        return View::create($data, Response::HTTP_OK);

    }
    /**
     * @Route("/stationbylinebybus/{y}")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @param $y
     * @return View
     * @throws \Doctrine\DBAL\DBALException
     */
    public function StationbyLinebyBus($y) :View
    {
        $data = $this->repository->findStationbyLineBus($y);

        return View::create($data, Response::HTTP_OK);

    }

    /**
     * @Route("/stationbybus/{y}")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @param $y
     * @return View
     * @throws \Doctrine\DBAL\DBALException
     */
    public function StationbyBus($y) :View
    {
        $data = $this->repository->findStationbyBus($y);

        return View::create($data, Response::HTTP_OK);

    }


}