<?php
/**
 * Created by PhpStorm.
 * User: Ahmed-PC
 * Date: 24/03/2019
 * Time: 16:23
 */

namespace App\Controller\Rest;

use App\Repository\RideRepository;
use App\Repository\StationRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Driver\Connection;


class CustomerController extends FOSRestController
{

    // TODO authentification avec des tokens
    // TODO documentation de l'API
    /**
     *
     * @Rest\Get("/customers")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @param CustomerRepository $repository
     */




    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;

    }




    public function getAll(CustomerRepository $repository): View
    {
//        $repository = $this->getDoctrine()->getRepository(User::class);

        $customers = $repository->findAll();

        return View::create($customers, Response::HTTP_OK);
    }

    /**
     *
     * @Rest\Get(
     *     path="/customers/{id}",
     *     name="api_customers_show"
     * )
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     *     )
     */
    public function getOne(CustomerRepository $repository, $id): View
    {
//    public function getOne(CustomerRepository $repository, $id) : Customer
//        $repository = $this->getDoctrine()->getRepository(User::class);
//        $customer = $repository->find($id);
//        return View::create($customer, Response::HTTP_OK);

        $customer = $repository->find($id);
        return View::create($customer, Response::HTTP_OK);
    }


    /**
     *
     * @Rest\Post("/customers")
     * @Rest\View(
     *     statusCode = Response::HTTP_CREATED
     *     )
     * @ParamConverter("customer", class=Customer::class, converter="fos_rest.request_body")
     * @param Request $request
     * @param Customer $customer
     * @param ObjectManager $em
     * @return Response
     */
    public function add(Request $request, Customer $customer, ObjectManager $em): Response
    {
        $em->persist($customer);
        $em->flush();

//        return $customer;
        return View::create(
            $customer,
            Response::HTTP_CREATED,
            [
                'Location' => $this->generateUrl(
                    'api_customers_show',
                    ['id' => $customer->getId()],
                    UrlGeneratorInterface::ABSOLUTE_URL
                ),
            ]
        );
    }

    /**
     *
     * @Rest\Put("/customers/{id}")
     * @return View
     *
     */
    public function update(Request $request, $id): Response
    {
        return new Response('', Response::HTTP_CREATED);
    }

    /**
     *
     * @Rest\Delete("/customers/{id}")
     * @return View
     *
     */
    public function delete(Request $request, $id): Response
    {
        return new Response('', Response::HTTP_CREATED);
    }

    /**
     *
     * @Rest\Get("/rides")
     * @Rest\View(serializerGroups={"ride"})
     * @param RideRepository $repository
     * @return View
     */
    public function getAllRides(RideRepository $repository): View
    {
//        $repository = $this->getDoctrine()->getRepository(User::class);

        $ride = $repository->findAll();

        return View::create($ride, Response::HTTP_OK);
    }


    /**
     *
     * @Rest\Get("/station")
     * @Rest\View(serializerGroups={"station"})
     * @param StationRepository $repository
     * @return View
     */
    public function getAllStation(StationRepository $repository): View
    {
//        $repository = $this->getDoctrine()->getRepository(User::class);

        $station = $repository->findAll();

        return View::create($station, Response::HTTP_OK);
    }


    /**
     * @Route("/betweenstations/{station1}/{station2}")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @param string $station1
     * @param string $station2
     * @return View
     * @throws \Doctrine\DBAL\DBALException
     */
    public function indexStations(string $station1 ,string $station2): View
    {


        $data = $this->repository->findBetweenStations("$station1","$station2");

        return View::create($data, Response::HTTP_OK);

    }
    /**
     * @Route("/evaluate/{customer}/{nbrBus}/{note}")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @param string $customer
     * @param string $nbrBus
     * @param string $note
     * @return View
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findEvaluation(string $customer,string $nbrBus ,string $note): View
    {

        $data = $this->repository->findEvaluation($customer,$nbrBus,$note);

        return View::create($data, Response::HTTP_OK);

    }


}