<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Login UI is disabled in demo mode (auto-login authenticator).
        return $this->redirectToRoute('app_projects');
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Logout is disabled in demo mode (auto-login authenticator).
        // Kept only to avoid 404s if old links/bookmarks exist.
    }
}