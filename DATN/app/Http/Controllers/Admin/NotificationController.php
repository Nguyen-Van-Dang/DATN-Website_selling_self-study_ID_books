<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\NotificationRepository;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private NotificationRepository $notificationRepository;


    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function getNotificationById($id)
    {
        $notification = $this->notificationRepository->getNotificationById($id);
        
        return view('admin.notification.detailNotification', ['Notification' => $notification]);
    }
}
