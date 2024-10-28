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

    public function getNotificationById($id)
    {
        return Notification::getNotificationById($id);
    }
}
