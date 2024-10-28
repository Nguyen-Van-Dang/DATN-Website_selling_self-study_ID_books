<?php

namespace App\Livewire\Notification;

use App\Models\Notification;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RenderNotification extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        if (Auth::user()->role_id == 1) {
            $notifications = Notification::paginate(10);
        } else {
            $notifications = Notification::where('user_id', Auth::id())->paginate(10);
        }
        return view('livewire.notification.render-notification', [
            'notifications' => $notifications,
        ]);
    }
}