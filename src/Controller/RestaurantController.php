<?php

namespace App\Controller;

use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {

        $this->entityManager  = $entityManager;

    }

    /**
     * @Route("/restaurants", methods={"POST"})
     */
    public function newRestaurant(Request $request): Response
    {

        $bodyRequest = $request->getContent();
        $jsonData = json_decode($bodyRequest);

        $restaurant = new Restaurant();
        $restaurant->nome = $jsonData->nome;
        $restaurant->cnpj = $jsonData->cnpj;
        $restaurant->bairro = $jsonData->bairro;
        $restaurant->rua = $jsonData->rua;
        $restaurant->numero = $jsonData->numero;
        $restaurant->tipo = $jsonData->tipo;

        $this->entityManager->persist($restaurant);
        $this->entityManager->flush();

        return new JsonResponse($restaurant);

    }

    /**
     * @Route("/restaurants", methods={"GET"})
     */
    public function fetchAll(): Response
    {

        $restaurantRepository = $this
            ->entityManager
            ->getRepository(Restaurant::class);
        $restaurantList = $restaurantRepository->findAll();

        return new JsonResponse($restaurantList);
    }

    /**
     * @Route("/restaurants/{id}", methods={"GET"})
     */
    public function fetchOnlyOne(Request $request): Response
    {

        $id = $request->get('id');
        $restaurantRepository = $this
            ->entityManager
            ->getRepository(Restaurant::class);
        $restaurant = $restaurantRepository->find($id);
        $httpResponseCode = is_null($restaurant) ?
            Response::HTTP_NO_CONTENT :
            Response::HTTP_OK;

        return new JsonResponse($restaurant, $httpResponseCode);

    }

}