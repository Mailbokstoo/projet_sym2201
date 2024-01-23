<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserSecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login_user')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->render('account/index.html.twig');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login_user.html.twig', ['last_username' => $lastUsername]);
    }

    #[Route(path: '/logout', name: 'app_logout_user')]
    public function logout(): Response
    {
        return $this->render('security/login_user.html.twig');
    }
}
