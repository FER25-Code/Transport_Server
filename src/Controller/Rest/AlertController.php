<?php
/**
 * Created by PhpStorm.
 * User: moumen
 * Date: 14/04/2019
 * Time: 14:24
 */

namespace App\Controller\Rest;

use App\Entity\Alert;
use App\Entity\AlertType;
use App\Repository\AlertRepository;
use App\Repository\PositionRepository;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method getEntityManager()
 * @property AlertRepository repository
 */
class AlertController extends FOSRestController
{

    public function __construct(AlertRepository $repository)
    {
        $this->repository = $repository;

    }


    /**
     * @Route("/alert/{comment}", name="alert_set")
     * @param $comment
     * @return Response
     */
    public function sealers($comment): Response
    {
        $alert = new Alert();
        $alert->setComment($comment);

        $this->get('validator')->validate($alert);
        $em = $this->getDoctrine()->getManager();
        $em->persist($alert);
        $em->flush();
        return new Response('', Response::HTTP_CREATED);
    }


    /**
     * @@Route("/alerts", name="alerts_show")
     * @return Response
     */
    public function getAll()
    {
        $lines = $this->getDoctrine()->getRepository('App\Entity\Alert')->findAll();
        $data = $this->get('jms_serializer')->serialize($lines, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    /**
     * @@Route("/alerts", name="alerts_show")
     * @return Response
     */
    public function getAlert()
    {
        $lines = $this->getDoctrine()->getRepository('App\Entity\Alert')->findAll();
        $data = $this->get('jms_serializer')->serialize($lines, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/getalert", name="alert_show")
     * @return Response
     */
    public function getOne()
    {
        $data = $this->repository->getByalertType();

        return View::create($data, Response::HTTP_OK);

    }

    /**
     * @Route("/alertPos/{x}/{y}")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @param $x
     * @param $y
     * @return View
     * @throws \Doctrine\DBAL\DBALException
     */
    public function index($x,$y ): View
    {
        $data = $this->repository->findByalertPosition($x,$y);

        return View::create($data, Response::HTTP_OK);

    }
    /**
     * @Route("/alertPostype")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @return View
     */
    public function Indexalertype():View
    {
        $data = $this->repository->findByalertType();
        return View::create($data, Response::HTTP_OK);

    }


    /**
     * @Route ("/insertAlert/{comment}")
     * @param $comment
     * @return Response
     */
    public  function AddAlert($comment):Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $alert = new Alert();
        $alert->setComment($comment);
//        $alert->getRLine($idline);
//        $alert->setRUser($idUser);
//        $alert->setRAlertType($alType);
//        $entityManager->persist($alert);
        $entityManager->flush();
        return new Response('Saved new Alert with id'.$alert->getId());

    }

    }