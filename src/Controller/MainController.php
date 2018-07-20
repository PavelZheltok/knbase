<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MainController
 *
 * @package App\Controller
 */
class MainController
{

    /**
     * @Route("/")
     *
     * @return Response
     */
    public function index()
    {
        return new Response('some test text', 200);
    }

    /**
     * @Route("/test")
     *
     * @return Response
     */
    public function test()
    {
        return new Response('test test page for routes', 200);
    }
}