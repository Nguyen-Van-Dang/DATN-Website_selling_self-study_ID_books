<?php

namespace App\Repositories;

use App\Models\NotificationUser;

class NotificationUserRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllNotificationUser() {
        return view('admin.notification.listNotification');
    }
}
