<?php


namespace App\Controller\Rest;


use App\Entity\Wallet;
use App\Repository\WalletRepository;
use Doctrine\DBAL\DBALException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\DBAL\Driver\Connection;
use FOS\RestBundle\View\View;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @property WalletRepository repository
 */
class WalletController extends FOSRestController
{


    /**
     * WalletController constructor.
     * @param WalletRepository $repository
     */
    public function __construct(WalletRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/Wallet/{x}")
     * @Rest\View(
     *     statusCode = Response::HTTP_OK
     * )
     * @param $x
     * @return View
     * @throws \Doctrine\DBAL\DBALException

     */
    public function getWallet($x) : View
    {
            $data = $this->repository->findWalletbyUser($x);

        return View::create($data, Response::HTTP_OK);
    }

    /**
     * @Route("/Wallet/edit/{id}/{p}")
     * @param $id
     * @param $p
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function update($id,$p)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $wallet = $entityManager->getRepository(Wallet::class)->find($id);

        if (!$wallet) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $wallet-> setAMOUNTTOTAL($p);
        $entityManager->flush();

        return View::create($wallet, Response::HTTP_OK);

    }
}