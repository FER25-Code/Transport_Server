<?php
/**
 * Created by PhpStorm.
 * User: moumen
 * Date: 13/04/2019
 * Time: 18:24
 */

namespace App\Controller\Rest;

use App\Entity\Line;
use App\Repository\LineRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\DBAL\DBALException;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\DBAL\Driver\Connection;


/**
 * @property LineRepository repository
 */
class LineController extends FOSRestController
{


    public function __construct(LineRepository $repository)
    {
        $this->repository = $repository;

    }


    /**
     * @Route("/line", name="line_set")
     * @return Response
     */
    public function setrides(): Response
    {

        $line = new Line();
        $line
            ->setLineNumber(25)
            ->setColorType("v")
        ;
        $this->get('validator')->validate($line);
        $em = $this->getDoctrine()->getManager();
        $em->persist($line);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }


    /**
     * @@Route("/lines", name="lines_show")
     * @return Response
     */
    public function getAll()
    {
        $lines = $this->getDoctrine()->getRepository('App\Entity\Line')->findAll();
        $data = $this->get('jms_serializer')->serialize($lines, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/line/{id}", name="line_show")
     * @param Line $line
     * @return Response
     */
    public function getOne(Line $line)
    {
        $data = $this->get('jms_serializer')->serialize($line, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


    /**
     * @Route("/lineFavorite")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )

     */
    public function index( ): View
    {


        $data = $this->repository->findBylineFavorites(1);

        return View::create($data, Response::HTTP_OK);

    }

    /**
     * @Route("/allline")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     */
 public function AllLine ():View
 {

     $data = $this->repository->findallline();

     return View::create($data, Response::HTTP_OK);


 }

    /**
     * @Route("/addline/{x}/{y}")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @param string $x
     * @param string $y
     * @return View
     * @throws DBALException
     */
    public function insertL(string $x, string $y ): View
    {


        $data = $this->repository->addLine($x,$y);

        return View::create($data, Response::HTTP_OK);

    }

    /**
     * @Route("/deleteline/{x}")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @param string $x
     * @return View
     * @throws \Doctrine\DBAL\DBALException
     */
    public function delete(string $x): View
    {


        $data = $this->repository->deleteLine($x);

        return View::create($data, Response::HTTP_OK);

    }




}