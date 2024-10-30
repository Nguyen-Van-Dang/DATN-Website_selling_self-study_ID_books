<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
class RenderUser extends Component
{
    use WithPagination;

    public $userData, $search = '';
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        if (strlen($this->search) >= 1) {
            $users = User::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('id', $this->search)

                ->paginate(10);
        } else {
            if (Auth::user()->role_id == 1) {
                $users = User::paginate(10);
            } else {
                $users = User::where('id', Auth::id())->paginate(10);
            }
        }
    
        return view('livewire.user.render-user', [
            'users' => $users,
            'userData' => $this->userData,
        ]);
    }
    
}