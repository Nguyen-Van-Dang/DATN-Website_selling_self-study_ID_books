<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class RenderUser extends Component
{
    use WithPagination;

    public $userData;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // Phân trang thay vì lấy tất cả người dùng
        $users = User::paginate(5);

        return view('livewire.user.render-user', [
            'users' => $users,
            'userData' => $this->userData,
        ]);
    }
}