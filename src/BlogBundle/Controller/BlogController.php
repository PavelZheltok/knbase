<?php

namespace App\BlogBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BlogController
 *
 * @package App\BlogBundle
 */
class BlogController
{

    /**
     * @Route("/", name="index")
     *
     * @return Response
     */
    public function index()
    {
        return new Response('this is blog main page', 200);
    }

    /**
     * @Route("/test1")
     *
     * @return Response
     */
    public function test()
    {
        return new Response('some blog page', 200);
    }


}