<?php

namespace App\EventListener;

use App\Repository\UserRepository;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[AsEventListener(event: 'kernel.request', priority: -10)]
class AutoLoginListener
{
    public function __construct(
        private UserRepository $userRepository,
        private TokenStorageInterface $tokenStorage
    ) {}

    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        if ($this->tokenStorage->getToken()) {
            return;
        }

        $user = $this->userRepository->findOneBy(['name' => 'admin']);

        if ($user) {
            // Create a token for the user. firewall name is 'main' usually.
            $token = new UsernamePasswordToken($user, 'main', $user->getRoles());
            $this->tokenStorage->setToken($token);

            // Manually save the token to the session so subsequent requests don't need to re-authenticate
            $session = $event->getRequest()->getSession();
            $session->set('_security_main', serialize($token));
        }
    }
}

