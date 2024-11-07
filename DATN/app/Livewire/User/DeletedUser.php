<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class DeletedUser extends Component
{
    use WithPagination;

    public $userData;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $users = User::onlyTrashed()->paginate(1);

        return view('livewire.user.user-render', [
            'users' => $users
        ]);
    }
}
