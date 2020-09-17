<?php


namespace App\Controller\Rest;


use App\Entity\User;
use App\Repository\InterstationRepository;
use Doctrine\DBAL\DBALException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\DBAL\Driver\Connection;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InterstationController extends FOSRestController
{

    /**
     * InterstationController constructor.
     * @param InterstationRepository $repository
     */
    public function __construct(InterstationRepository $repository)
    {
        $this->repository = $repository;
    }



    /**
     * @Route("/alertType", name="alerts_show")
     * @throws DBALException
     */
    public function getAllinfoBus()
    {

        $data = $this->repository->findallAlert();

        return View::create($data, Response::HTTP_OK);
    }

    /**
     * @route("addinterstation/$Ti/$pr/$di")
     * @param $Ti
     * @param $pr
     * @param $di
     * @return Response
     */
    public  function AddAction($Ti, $pr, $di){
        $entityManager = $this->getDoctrine()->getManager();
        $interstation =new Interstation();
        $interstation -> setTime($Ti);
        $interstation ->setPeriode($pr);
        $interstation -> setDistance($di);
        $entityManager->persist($entityManager);
        return new Response('Saved new product with id ');
    }


}