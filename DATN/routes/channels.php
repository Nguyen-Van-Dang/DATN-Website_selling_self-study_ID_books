<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{groupId}', function ($user, $groupId) {
    return true;
});
