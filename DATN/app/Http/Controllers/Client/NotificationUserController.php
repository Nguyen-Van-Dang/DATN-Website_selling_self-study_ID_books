<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\NotificationUserRepository;
use Illuminate\Http\Request;

class NotificationUserController extends Controller
{
    private NotificationUserRepository $notificationUserRepository;
    public function __construct(NotificationUserRepository $notificationUserRepository)
    {
        $this->notificationUserRepository = $notificationUserRepository;
    }

    public function getAllNotificationUser(){
        return $this->notificationUserRepository->getAllNotificationUser();
    }
}
