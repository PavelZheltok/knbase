<?php

namespace App\BlogBundle\Controller;

use App\BlogBundle\Ecxeption\PostNotFoundException;
use App\BlogBundle\Entity\Post;
use App\BlogBundle\Repository\PostRepository;
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
     * @Route("/posts/{alias}", defaults={"alias"=null})
     *
     * @param string $alias
     * @return Response
     */
    public function posts($alias)
    {
        if (empty($alias)) {
            return $this->index();
        }

        try {
            $post = $this
                ->getDoctrine()
                ->getRepository(Post::class)
                ->findOneBy([
                    'alias' => $alias
                ]);
        } catch (PostNotFoundException $e) {
            die('catched');
        }

        return $this->render('blog/post.html.twig', [
            'post' => $post,
        ]);
    }


}