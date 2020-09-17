<?php
/**
 * Created by PhpStorm.
 * User: Ahmed-PC
 * Date: 24/03/2019
 * Time: 16:23
 */

namespace App\Controller\Web;

use App\Entity\User;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/idex.html.twig", name="app_homepage")
     * @Method({"GET"})
     */
    public function index(EventRepository $repository): Response
    {
        return $this->render('Admin/index.html.twig');
    }
    /**
     * @Route("/addBus.html.twig", name="2homepage")
     * @Method({"GET"})
     */
    public function Addbus(): Response
    {
        return $this->render('Admin/addBus.html.twig');
    }
    /**
     * @Route("/addDriver.html.twig", name="4page")
     * @Method({"GET"})
     */
    public function Adddriver(): Response
    {
        return $this->render('Admin/addDriver.html.twig');
    }
    /**
     * @Route("/addOwner.html.twig", name="23page")
     * @Method({"GET"})
     */
    public function Addowner(): Response
    {
        return $this->render('Admin/addOwner.html.twig');
    }
    /**
     * @Route("/index.html.twig", name="3page")
     * @Method({"GET"})
     */
    public function indexpage(): Response
    {
        return $this->render('Admin/index.html.twig');
    }

    #........................................Station
    /**
     * @Route("/addStation.html.twig", name="3page")
     * @Method({"GET"})
     */
    public function addstation(): Response
    {
        return $this->render('Admin/addStation.html.twig');
    }
    /**
     * @Route("/modifyStation.html", name="7page")
     * @Method({"GET"})
     */
    public function Modstation(): Response
    {
        return $this->render('Admin/ModifyStation.html.twig');
    }
    /**
     * @Route("/deleteStation.html.twig", name="6page")
     * @Method({"GET"})
     */
    public function Deletestation(): Response
    {
        return $this->render('Admin/deleteStation.html.twig');
    }
    #........................................Line

    /**
     * @Route("/addLine.html.twig", name="5page")
     * @Method({"GET"})
     */
    public function addLine(): Response
    {
        return $this->render('Admin/addLine.html.twig');
    }
    /**
     * @Route("/modifyLine.html", name="13page")
     * @Method({"GET"})
     */
    public function ModLine(): Response
    {
        return $this->render('Admin/ModifyLine.html.twig');
    }
    /**
     * @Route("/deleteLine.html,twig", name="1page")
     * @Method({"GET"})
     */
    public function DeleteLine(): Response
    {
        return $this->render('Admin/deleteLine.html.twig');
    }



    /**
     * @Route("/users/{id}", name="article_show")
     * @Method({"GET"})
     */
    public function test(UserRepository $repository, $id): Response
    {
//        $repository = $this->getDoctrine()->getRepository(User::class);

        $user = $repository->find($id);

        $data = $this->get('serializer')->serialize($user, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}