<?php

namespace App\repositories;

use App\Models\Notification;

class NotificationRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllNotification() {
        $Notification = Notification::getAll();
        return view('admin.notification.listNotification', ['Notification' => $Notification]);
    }
}
