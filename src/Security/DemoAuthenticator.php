<?php

namespace App\Security;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

/**
 * Demo-only authenticator: automatically logs in a demo/admin user on every request.
 * This removes the need for any login UI.
 */
final class DemoAuthenticator extends AbstractAuthenticator
{
    public function __construct(
        private readonly UserRepository $users,
        private readonly EntityManagerInterface $em,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function supports(Request $request): ?bool
    {
        // Always authenticate. This is intended for demo environments only.
        return true;
    }

    public function authenticate(Request $request): Passport
    {
        return new SelfValidatingPassport(
            new UserBadge('admin', function (string $userIdentifier): User {
                $user = $this->users->findOneBy(['name' => $userIdentifier]);
                if ($user) {
                    return $user;
                }

                // If DB is not ready, surface a clear error instead of a redirect loop.
                // (Entrypoint creates schema + user, but this is a safe fallback.)
                try {
                    $user = new User();
                    $user->setName('admin');
                    $user->setPosition('Руководитель');
                    $user->setContact('admin@example.com');
                    $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
                    $this->em->persist($user);
                    $this->em->flush();
                    return $user;
                } catch (\Throwable $e) {
                    $ex = new UserNotFoundException(sprintf('Demo user "%s" could not be created/loaded.', $userIdentifier), 0, $e);
                    $ex->setUserIdentifier($userIdentifier);
                    throw $ex;
                }
            })
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, \Symfony\Component\Security\Core\Exception\AuthenticationException $exception): ?Response
    {
        return new Response('Demo authentication failed: '.$exception->getMessageKey(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}


