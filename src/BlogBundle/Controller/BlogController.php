<?php

namespace App\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BlogController
 *
 * @package App\BlogBundle
 */
class BlogController extends AbstractController
{

    /**
     * @Route("/", name="index")
     *
     * @return Response
     */
    public function index()
    {
        return $this->render('blog/main.html.twig');
    }

    /**
     * @Route("/post")
     *
     * @return Response
     */
    public function test()
    {
        return $this->render('blog/post.html.twig');
    }


}