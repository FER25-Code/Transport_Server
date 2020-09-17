<?php
/**
 * Created by PhpStorm.
 * User: Ahmed-PC
 * Date: 24/03/2019
 * Time: 16:23
 */

namespace App\Controller\Web;


use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{

    /**
     * @Route("/customers/read/{id}", name="web_customers_read")
     * @Method({"GET"})
     * @param CustomerRepository $repository
     * @param int $id
     * @return Response
     */
    public function read(CustomerRepository $repository, $id = -1): Response
    {
//        $repository = $this->getDoctrine()->getRepository(User::class);

        if ($id < 0) {
            $customers = $repository->findAll();
            $data = $this->get('serializer')->serialize($customers, 'json');

        } else {
            $customer = $repository->find($id);
            $data = $this->get('serializer')->serialize($customer, 'json');
        }
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');


        return $response;
    }

    /**
     * @Route("/customers/create", name="web_customers_create")
     * @Method({"POST"})
     */
    public function create(Request $request, ObjectManager $em): Response
    {
//        $repository = $this->getDoctrine()->getRepository(User::class);

        $data = $request->getContent();
        $customer = $this->get('serializer')->deserialize($data, Customer::class, 'json');


//        $this->get('validator')->validate($customer);

//        $em = $this->getDoctrine()->getManager();
        $em->persist($customer);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }




}