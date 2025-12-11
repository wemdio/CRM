<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Notification;
use App\Repository\NotificationRepository;
use Doctrine\ORM\EntityManagerInterface;

class NotificationService
{
    public function __construct(
        private NotificationRepository $notificationRepository,
        private EntityManagerInterface $entityManager
    ) {}

    public function createNotification(User $user, string $message, string $type = 'info'): void
    {
        $notification = new Notification();
        $notification->setUser($user);
        $notification->setMessage($message);
        $notification->setType($type);

        $this->entityManager->persist($notification);
        $this->entityManager->flush();
    }

    public function getUserUnreadNotifications(User $user): array
    {
        return $this->notificationRepository->findUnreadByUser($user);
    }

    public function markNotificationAsRead(int $notificationId, User $user): ?Notification
    {
        $notification = $this->notificationRepository->find($notificationId);
        
        if ($notification && $notification->getUser()->getId() === $user->getId()) {
            $notification->setIsRead(true);
            $this->entityManager->flush();
            return $notification;
        }
        
        return null;
    }

    public function markAllAsRead(User $user): void
    {
        $notifications = $this->getUserUnreadNotifications($user);
        
        foreach ($notifications as $notification) {
            $notification->setIsRead(true);
        }
        
        $this->entityManager->flush();
    }
}