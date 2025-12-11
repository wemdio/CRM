<?php

namespace App\Controller;

use App\Service\NotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{
    public function __construct(
        private NotificationService $notificationService
    ) {}

    #[Route('/notifications', name: 'app_notifications')]
    public function index(): Response
    {
        $notifications = $this->notificationService->getUserUnreadNotifications($this->getUser());

        return $this->render('notifications/index.html.twig', [
            'notifications' => $notifications,
        ]);
    }

    #[Route('/api/notifications/unread', name: 'api_notifications_unread')]
    public function getUnreadNotifications(): JsonResponse
    {
        $notifications = $this->notificationService->getUserUnreadNotifications($this->getUser());

        $data = [];
        foreach ($notifications as $notification) {
            $data[] = [
                'id' => $notification->getId(),
                'message' => $notification->getMessage(),
                'type' => $notification->getType(),
                'createdAt' => $notification->getCreatedAt()->format('H:i:s'),
            ];
        }

        return $this->json($data);
    }

    #[Route('/api/notifications/{id}/mark-read', name: 'api_notification_mark_read', methods: ['POST'])]
    public function markAsRead(int $id): JsonResponse
    {
        $notification = $this->notificationService->markNotificationAsRead($id, $this->getUser());
        
        if (!$notification) {
            return $this->json(['error' => 'Notification not found'], 404);
        }
        
        return $this->json(['success' => true]);
    }

    #[Route('/notifications/mark-all-read', name: 'app_notifications_mark_all_read', methods: ['POST'])]
    public function markAllAsRead(): Response
    {
        $this->notificationService->markAllAsRead($this->getUser());
        
        $this->addFlash('success', 'Все уведомления прочитаны');
        return $this->redirectToRoute('app_tools');
    }
}