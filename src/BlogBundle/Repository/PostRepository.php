<?php

namespace App\BlogBundle\Repository;

use App\BlogBundle\Ecxeption\PostNotFoundException;
use App\BlogBundle\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function findOneBy(array $criteria, array $orderBy = null)
    {
        $post = parent::findOneBy($criteria, $orderBy);
//        die('repo');

        if ($post) {
            return $post;
        } else {
            throw new PostNotFoundException();
        }
    }
}