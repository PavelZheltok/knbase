<?php

namespace App\Controller;

use App\Entity\User as User;
use App\Forms\LoginType;
use App\Forms\UserType;
//use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends AbstractController
{
    /**
     * @Route("/register", name="user_registration")
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $userPasswordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('main_page');
        }

        return $this->render('knbase/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/login", name="user_login")
     *
     * @param AuthenticationUtils $authenticationUtils
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(AuthenticationUtils $authenticationUtils, Request $request)
    {
        //$user = new User();
        $form = $this->createForm(LoginType::class);

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        $form->handleRequest($request);
        $errors = null;

        if ($form->isSubmitted()) {
            $formData = $form->getData();
            $email = $formData['email'];
            $plainPassword = $formData['plainPassword'];

            $userRepo = $this->getDoctrine()->getManager()->getRepository(User::class);
            $user = $userRepo->findOneBy(['email' => $email]);
        } else {
            $errors = $form->getErrors();
        }

        return $this->render('knbase/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
            'form'          => $form->createView(),
        ]);
    }

    /**
     *@Route("/logout", name="user_logout")
     */
    public function logout()
    {

    }
}