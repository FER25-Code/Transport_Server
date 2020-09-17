<?php


namespace App\Controller\Rest;


use App\Entity\Line;
use App\Entity\Tickets;
use App\Repository\TicketsRepository;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\DBAL\Driver\Connection;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TicketsController extends FOSRestController
{


    /**
     * TicketsController constructor.
     * @param TicketsRepository $repository
     */
    public function __construct(TicketsRepository $repository)
    {
        $this->repository = $repository;

    }

//    /**
//     * @Route("/addTicket")
//     *  @return Response?
//     */
//    public function addTicket () :Response
//    {
//        $entityManager = $this->getDoctrine()->getManager();
//        $Tickets = new Tickets();
//        $line = new Line();
//        $line->getId(1);
//        $Tickets->setAMOUNT(200);
//        $Tickets->setLine(  $line);
//        $entityManager->persist($Tickets);
//        $entityManager->persist($line);
//        // actually executes the queries (i.e. the INSERT query)
//        $entityManager->flush();
//        return new Response('Add new Ticket ');
//
//    }

    /**
     * @Route("/Ticktbyline/{x}")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @param $x
     * @return View
     * @throws \Doctrine\DBAL\DBALException

     */
    public function getWallet($x) : View
    {
        $data = $this->repository->findTicktbyLine($x);

        return View::create($data, Response::HTTP_OK);
    }
}