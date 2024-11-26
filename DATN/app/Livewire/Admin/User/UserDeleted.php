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
    public $restoreUserModal = false;
    public $isDeletePopupOpen = false;
    public $deletedId, $restoreId;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $deletedUsers = User::onlyTrashed()->get();
        return view('livewire.admin.user.user-deleted', ['deletedUsers' => $deletedUsers]);
    }

    public function openPopup($type, $id = null)
    {
        $this->deletedId = null;
        if ($type === 'delete' && $id) {
            $this->deletedId = $id;
            $this->isDeletePopupOpen = true;
        }
    }
    public function closePopup()
    {
        $this->isDeletePopupOpen = false;
    }

    public function deleted()
    {
        $user = User::find($this->deletedId);

        if ($user) {
            $user->delete();
            toastr()->success('<p>Xóa khóa học thành công!</p>');
        } else {
            session()->flash('error', 'Danh mục không tồn tại.');
        }

        $this->closePopup();
    }

    // Hàm khôi phục người dùng
    public function restore()
    {
        $user = User::onlyTrashed()->find($this->deletedId);

        $user->restore();
        toastr()->success('Người dùng đã được khôi phục thành công.');

        $this->restoreUserModal = false;
    }
}
