<?php
/**
 * Created by PhpStorm.
 * User: moumen
 * Date: 11/04/2019
 * Time: 19:55
 */

namespace App\Controller\Rest;
use App\Entity\User;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class UserController extends  FOSRestController
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    /**
     * @Route("/user/{id}", name="user_show")
     */
    public function showAction()
    {
        $user = new User();
        $user
            ->setFirstname('Abdelmoumen')
            ->setLastname('Achache')

        ;
        $data = $this->get('jms_serializer')->serialize($user, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/insertuser/{usn}/{fn}/{ln}/{em}/{pas}")
     * @param $usn
     * @param $fn
     * @param $ln
     * @param $em
     * @param $pas
     * @return Response
     */
 public  function AddAction($usn,$fn,$ln,$em,$pas){
     $entityManager = $this->getDoctrine()->getManager();
     $user = new User();
      $user     ->setUsername($usn);
      $user     ->setFirstname($fn);
      $user     ->setLastname($ln);
      $user    ->setEmail($em);
      $user->setPassword( $pas);
     $entityManager->persist($user);
     // actually executes the queries (i.e. the INSERT query)
     $entityManager->flush();
     return new Response('Saved new product with id '.$user->getId());
 }
    /**
     * @Route("/addowner/{usn}/{fn}/{ln}/{em}/{pas}")
     * @param $usn
     * @param $fn
     * @param $ln
     * @param $em
     * @param $pas
     * @return Response
     */
    public  function AddOwner($usn,$fn,$ln,$em,$pas){
        $entityManager = $this->getDoctrine()->getManager();
        $user = newVehicleOwner();
        $user     ->setUsername($usn);
        $user     ->setFirstname($fn);
        $user     ->setLastname($ln);
        $user    ->setEmail($em);
        $user->setPassword( $pas);
        $entityManager->persist($user);
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        return new Response('Saved new product with id '.$user->getId());
    }


}