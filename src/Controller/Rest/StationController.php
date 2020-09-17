<?php
/**
 * Created by PhpStorm.
 * User: moumen
 * Date: 13/04/2019
 * Time: 15:55
 */

namespace App\Controller\Rest;

use App\Entity\Station;
use App\Repository\StationRepository;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\DBAL\Driver\Connection;



/**
 * @property StationRepository repository
 */
class StationController extends FOSRestController
{

    public function __construct(StationRepository $repository)
    {
        $this->repository = $repository;

    }



    /**
     * @Route("/station", name="station_set")
     * @return Response
     */
    public function setrides(): Response
    {

        $station = new Station();
        $station
            ->setName('Zouaghi')
        ;
        $this->get('validator')->validate($station);
        $em = $this->getDoctrine()->getManager();
        $em->persist($station);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }


    /**
     * @Route("/allstations")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
    */

    public function getAll() : View
    {
        $data = $this->repository->findAllstation();

        return View::create($data, Response::HTTP_OK);
    }


    /**
     * @Route("/station/{id}", name="station_show")
     * @param Station $station
     * @return Response
     */
    public function getOne(Station $station)
    {
        $data = $this->get('jms_serializer')->serialize($station, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


    /**
     * @Route("/busStation/{nameStatine}")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @param $nameStatine
     * @return View
     * @throws \Doctrine\DBAL\DBALException
     */
    public function index(String $nameStatine): View
    {


        $data = $this->repository->findBybusStation($nameStatine);

        return View::create($data, Response::HTTP_OK);

    }

    /**
     * @Route("/busDirection")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )

     */
    public function indexdirection( ): View
    {


        $data = $this->repository->findByPos("Nouvelle-Ville",1);

        return View::create($data, Response::HTTP_OK);

    }



    /**
     * @Route("/stationFavorites")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )

     */
    public function indexfavorites( ): View
    {


        $data = $this->repository->findBFavorites(1);

        return View::create($data, Response::HTTP_OK);

    }


    /**
     * @Route("/busperstation")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )

     */
    public function busperStation( ): View
    {


        $data = $this->repository->findBusperStation();

        return View::create($data, Response::HTTP_OK);

    }

    /**
     * @Route("/busbyStation/{nameStatine}")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @param $nameStatine
     * @return View
     * @throws \Doctrine\DBAL\DBALException
     */
    public function BusbyStationPositin(String $nameStatine): View
    {


        $data = $this->repository->findbusbyStationPosition($nameStatine);

        return View::create($data, Response::HTTP_OK);

    }

    /**
     * @Route("/addstation/{x}")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @param string $x
     * @return View
     * @throws \Doctrine\DBAL\DBALException
     */
    public function insert(string $x): View
    {


        $data = $this->repository->addStation($x);

        return View::create($data, Response::HTTP_OK);

    }

    /**
     * @Route("/deletestation/{x}")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @param string $x
     * @return View
     * @throws \Doctrine\DBAL\DBALException
     */
    public function delete(string $x): View
    {


        $data = $this->repository->deleteStation($x);

        return View::create($data, Response::HTTP_OK);

    }



}