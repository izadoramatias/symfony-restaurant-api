<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController
{

    /**
     * @Route("/ola")
     */
    public function olaMundo(Request $request): Response
    {

        $pathInfo = $request->getPathInfo();
//        $parametro = $request->query->get('parametro');
        $query = $request->query->all();
        $atributo = $request->attributes->all();
        return new JsonResponse([
            'mensagem' => 'hello world',
            'pathInfo' => $pathInfo,
            'parametro' => $query,
            'atributo' => $atributo
        ]);

    }

}