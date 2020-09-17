<?php
/**
 * Created by PhpStorm.
 * User: moumen
 * Date: 14/04/2019
 * Time: 23:07
 */

namespace App\Controller\Rest;
use App\Entity\Event;
use App\Entity\Position;
use App\Repository\EventRepository;
use App\Repository\PositionRepository;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\DBAL\Driver\Connection;

class EventController extends FOSRestController

{

    private $repository;

    public function __construct(EventRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @Route("/eventContex/{x}/{y}")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @param $x
     * @param $y
     * @return View
     * @throws \Doctrine\DBAL\DBALException
     */
    public function evntPosition($x,$y ): View
    {
        $data = $this->repository->findByeventPosition($x,$y);
        return View::create($data, Response::HTTP_OK);
    }
    /**
     * @Rest\Get("/events")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     */
    public function index(): View
    {

        //  $data = $this->repository->findAll();
        //    $data = $this->repository->findEventsByPosition();
        $data = $this->repository->FindEvintByPosition( );

        //        dump($data);

//        $response = new Response($data);
//        $response->headers->set('Content-Type', 'application/json');
//        return $response;


        //   $repository = $em->getRepository(Event::class);
        // $event = $repository->findAllPublishedOrderedByNewest();
        return View::create($data, Response::HTTP_OK);

    }

    /**
     * @Route("/event/{id}", name="event_show")
     * @param Event $event
     * @param Position $position
     * @return Response
     */

    public function getevent(Event $event ,Position $position)
    {


        $data = $this->get('jms_serializer')->serialize($position, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;


    }

    /**
     * @Route("/eventp", name="myevent")
     * @param EventRepository $repository
     * @return Response
     */
    public function myevent(EventRepository $repository): Response
    {
//        var_dump('hello');
//        $repository = $this->getDoctrine()->getRepository(User::class);
//
//        $users = $repository->findAll();
//        $user2 = $repository->findOneBy(['firstname' => 'Ahmed']);
//        $user = $repository->find(1);


        $events = $repository->findEventsByPosition();
        var_dump($events);

//        return $this->render('front/index.html.twig.twig', ['name' => $user->getFirstname()]);
        return $this->render('front/index.html.twig.twig', ['name' => "hello"]);
    }}