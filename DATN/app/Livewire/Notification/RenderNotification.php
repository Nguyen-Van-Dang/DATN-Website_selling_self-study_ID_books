<?php

namespace App\Livewire\Notification;

use App\Models\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class RenderNotification extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $notifications = Notification::paginate(5);

        return view('livewire.notification.render-notification', [
            'notifications' => $notifications,
        ]);
    }
}