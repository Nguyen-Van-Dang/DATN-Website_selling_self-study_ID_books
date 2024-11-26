<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
class UserApprove extends Component
{

    public function render()
{
    $users = User::where('status', 1)->get();
    return view('livewire.admin.user.user-approve', ['users' => $users]);
}
}
