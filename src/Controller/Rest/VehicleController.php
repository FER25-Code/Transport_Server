<?php
/**
 * Created by PhpStorm.
 * User: moumen
 * Date: 13/04/2019
 * Time: 18:14
 */

namespace App\Controller\Rest;
use App\Entity\Vehicle;
use App\Repository\VehicleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * @property VehicleRepository repository
 */
class VehicleController extends FOSRestController
{
    /**
     * VehicleController constructor.
     * @param VehicleRepository $repository
     */
    public function __construct(VehicleRepository $repository)
    {
        $this->repository = $repository;

    }

    /**
     * @Route("/vehicle", name="vehicle_set")
     * @return Response
     */
    public function setrides(): Response
    {

        $vehicle = new Vehicle();
        $vehicle
            ->setMark('newbus')
            ->setMaxSiege(55)
            ->setNbrBus(15)
            ->setRegisterNbr(0246464654)

        ;
        $this->get('validator')->validate($vehicle);
        $em = $this->getDoctrine()->getManager();
        $em->persist($vehicle);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }


    /**
     * @@Route("/vehiclesall" , name="vehicles_show")
     * @return Response
     */

    public function getAll()
    {
        $vehicles = $this->getDoctrine()->getRepository('App\Entity\Vehicle')->findAll();
        $data = $this->get('jms_serializer')->serialize($vehicles, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/vehicle/{id}", name="vehicle_show")
     * @param Vehicle $vehicle
     * @return Response
     */
    public function getOne(Vehicle $vehicle)
    {
        $data = $this->get('jms_serializer')->serialize($vehicle, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    /**
     * @Route("/allbus")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     */
    public function Allbus() :View
    {
        $data = $this->repository->findAllBus();

        return View::create($data, Response::HTTP_OK);

    }
    /**
     * @Route("/businfo")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     */
    public function busow() :View
    {
        $data = $this->repository->findBus();

        return View::create($data, Response::HTTP_OK);

    }


    /**
     * @Route("/addbus/{x}/{y}/{z}/{a}/{b}/{c}")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @param string $x
     * @param string $y
     * @param string $z
     * @param string $a
     * @param string $b
     * @param string $c
     * @return View
     * @throws \Doctrine\DBAL\DBALException
     */
    public function insert(string $x, string $y ,string $z,string $a,string $b,string $c): View
    {


        $data = $this->repository->addBus($x,$y,$z,$a,$b,$c);

        return View::create($data, Response::HTTP_OK);

    }


}