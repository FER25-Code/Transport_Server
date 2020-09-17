<?php
/**
 * Created by PhpStorm.
 * User: moumen
 * Date: 13/04/2019
 * Time: 13:35
 */

namespace App\Controller\Rest;

use App\Entity\Ride;
use App\Entity\Station;
use App\Repository\RideRepository;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\DBAL\Driver\Connection;

/**
 * @property RideRepository repository
 */
class RideController  extends FOSRestController
{



    public function __construct(RideRepository $repository)
    {
        $this->repository = $repository;

    }



    /**
     * @Route("/ride", name="ride_set")
     * @return Response
     * @throws \Exception
     */
    public function setrides(): Response
    {

        $ride = new Ride();
        $ride
            ->setDirection(-1)
            ->setDepartureDate(new \DateTime())
            ->setFinishDate(new \DateTime())
            ->setCreatedAt(new \DateTime())
        ;
        $this->get('validator')->validate($ride);
        $em = $this->getDoctrine()->getManager();
        $em->persist($ride);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }


    /**
     * @@Route("/rides" , name="rides_show")
     * @return Response
     */
    public function getAll()
    {
        $rides = $this->getDoctrine()->getRepository('App\Entity\Ride')->findAll();
        $data = $this->get('jms_serializer')->serialize($rides, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/ride/{id}", name="ride_show")
     * @param Ride $ride
     * @return Response
     */
    public function getOne(Ride $ride)
    {

        $data = $this->get('jms_serializer')->serialize($ride, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


    /**
     * @Route("/evalRide")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )

     */
    public function index( ): View
    {


        $data = $this->repository->findByevalRide(1);

        return View::create($data, Response::HTTP_OK);

    }


}