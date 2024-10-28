<?php

namespace App\Livewire\Notification;

use App\Models\Notification;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;    

class RenderNotificationDetail extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $Notification = Notification::paginate(10);
        return view('livewire.notification.render-notification-detail', [
            'Notification' => $Notification,
        ]);
    }
}