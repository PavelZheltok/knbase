<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class MainController
 *
 * @package App\Controller
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_page")
     *
     * @return Response
     */
    public function index(Request $request, AuthorizationCheckerInterface $checker)
    {
        if ($checker->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->render('blog/main.html.twig');
        }

        return $this->redirectToRoute('fos_user_security_login');
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