<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UserDeleted extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $deletedId, $restoreId;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['restore', 'forceDelete'];

    public function render()
    {
        $deletedUsers = User::onlyTrashed()->get();
        return view('livewire.admin.user.user-deleted', ['deletedUsers' => $deletedUsers]);
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        session()->flash('success', 'Người dùng đã được khôi phục.');
    }

    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        session()->flash('success', 'Người dùng đã bị xóa vĩnh viễn.');
    }
}
