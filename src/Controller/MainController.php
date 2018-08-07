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
     * @Route("/index")
     *
     * @return Response
     */
    public function index()
    {
        return new Response('<html><body>some test text</body></html>', 200);
    }

    /**
     * @Route("/test")
     *
     * @return Response
     */
    public function test()
    {
        return new Response('<html><body>test test page for routes</body></html>', 200);
    }

    /**
     * @Route("/admin")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
}