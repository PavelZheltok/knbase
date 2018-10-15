<?php

namespace App\BlogBundle\Controller;

use App\BlogBundle\Ecxeption\PostNotFoundException;
use App\BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CRUDController extends AbstractController
{
    /**
     * @Route("/post/create", name="create_post")
     *
     * @param Request $request
     * @return Post
     */
    public function create(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(Post::class, $post);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()
                ->getManager()
                ->persist($post);
            $this->getDoctrine()
                ->getManager()
                ->flush();
        }

        return $post;
    }

    /**
     * @param int $id
     * @return null|object
     * @throws PostNotFoundException
     */
    public function  read(int $id)
    {
        $post = $this->getDoctrine()
            ->getRepository(Post::class)
            ->find($id);

        if ($post) {
            return $post;
        } else {
            throw new PostNotFoundException();
        }
    }

    /**
     * @param Post $post
     * @param array $data
     * @return Post
     */
    public function update(Post $post, array $data)
    {
        return $post;
    }

    /**
     * @param Post $post
     */
    public function delete(Post $post)
    {
        $this->getDoctrine()->getManager()->remove($post);
        $this->getDoctrine()->getManager()->flush();
    }

}