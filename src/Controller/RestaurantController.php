<?php

namespace App\Controller;

use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController
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

}