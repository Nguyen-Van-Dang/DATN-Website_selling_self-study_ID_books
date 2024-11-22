<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads; // Thêm vào đây
use Illuminate\Support\Facades\Storage;
use Google\Service\Drive\Permission as Google_Service_Drive_Permission;
use App\Services\GoogleDriveService;
use App\Jobs\UploadFileJob;

class UserIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $userData, $newImg;
    public $existingImageUrl;
    public $name, $image_url, $email, $phone, $password, $role_id, $status;
    public $nameAdd, $image_urlAdd, $emailAdd, $phoneAdd, $role_idAdd, $statusAdd, $passwordAdd;
    public $editingId, $deletedId, $search = '';
    public $isAddPopupOpen = false;
    public $isEditPopupOpen = false;
    public $isDeletePopupOpen = false;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        if (strlen($this->search) >= 1) {
            $users = User::where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('id', $this->search);
            })
                ->whereNull('deleted_at')
                ->orderBy('role_id')
                ->paginate(10);
        } else {
            if (Auth::user()->role_id == 1) {
                $users = User::whereNull('deleted_at')
                    ->orderBy('role_id')
                    ->paginate(10);
            } else {
                $users = User::where('id', Auth::id())
                    ->whereNull('deleted_at')
                    ->paginate(10);
            }
        }

        return view('livewire.admin.user.user-index', [
            'users' => $users,
        ]);
    }

    public function openPopup($type, $id = null)
    {
        $this->deletedId = null;
        if ($type === 'add') {
            $this->isAddPopupOpen = true;
        } elseif ($type === 'edit' && $id) {
            $this->editingId = $id;
            $user = User::find($id);
            if ($user) {
                $this->nameAdd = $user->name;
                $this->passwordAdd = $user->password;
                $this->image_urlAdd = $user->images()->first() ? $user->images()->first()->image_url : null;
                $this->emailAdd = $user->email;
                $this->phoneAdd = $user->phone;
                $this->role_idAdd = $user->role_id;
                $this->statusAdd = $user->status;
            }
            $this->isEditPopupOpen = true;
        } elseif ($type === 'delete' && $id) {
            $this->deletedId = $id;
            $this->isDeletePopupOpen = true;
        }
    }

    public function closePopup()
    {
        $this->isAddPopupOpen = false;
        $this->isEditPopupOpen = false;
        $this->isDeletePopupOpen = false;
        $this->deletedId = null;
    }

    public function createUser()
    {
        $user = new User();
        $user->name = $this->name;
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->role_id = $this->role_id;
        $user->status = 0;
        $user->password = bcrypt($this->password);

        $user->save();

        if ($this->image_url) {
            $folderId = '1E1KVm0X-uBr6vyWLPuzrRu4XGhnOJY2M';
            $filePath = $this->image_url->store('temp');
            UploadFileJob::dispatch($user, $folderId, $filePath, 'thumbnail');
            $user->save();
        }

        session()->flash('message', 'Thêm tài khoản thành công');
        $this->reset(['name', 'phone', 'email', 'role_id', 'status', 'password', 'image_url']);
        $this->isAddPopupOpen = false;
    }
    public function updateUser()
    {
        $user = User::find($this->editingId);
    
        if (!$user) {
            session()->flash('error', 'Người dùng không tồn tại.');
            return;
        }

        $user->name = $this->nameAdd;
        $user->email = $this->emailAdd;
        $user->phone = $this->phoneAdd;
        $user->role_id = $this->role_idAdd;
        $user->status = 0;

        if ($this->newImg) {
            $folderId = '1E1KVm0X-uBr6vyWLPuzrRu4XGhnOJY2M';
            if ($user->images()->count() > 0) {
                $firstImage = $user->images()->first();
                if (!empty($firstImage->file_id)) {
                    $googleDriveService = new GoogleDriveService();
                    $googleDriveService->deleteFile($firstImage->file_id);
                }
                $firstImage->delete();
            }
            $filePath = $this->newImg->store('temp');
            UploadFileJob::dispatch($user, $folderId, $filePath, 'avatar');
        }
        $user->save();
        // session()->flash('success', 'Người dùng đã được cập nhật thành công.');
    
        $this->reset(['editingId', 'nameAdd', 'emailAdd', 'phoneAdd', 'role_idAdd', 'statusAdd', 'newImg']);
        $this->isEditPopupOpen = false;
        return redirect()->with('success', 'Mật khẩu đã được thay đổi thành công. Vui lòng đăng nhập lại với mật khẩu mới.');
    }

    //khôi phục
    public function restoreUser($id)
    {
        $user = User::withTrashed()->find($id);

        if ($user) {
            $user->restore();
            session()->flash('message', 'Người dùng đã được khôi phục thành công.');
        } else {
            session()->flash('error', 'Không tìm thấy người dùng.');
        }
    }

    //xóa mềm
    public function deleted()
    {
        $user = User::find($this->deletedId);
        if (!$user) {
            session()->flash('error', 'Người dùng không tồn tại.');
        } else {
            if ($user->role_id == 1) {
                toastr()->error('Không thể xóa quản trị viên.');
            } else {
                $user->delete();
                toastr()->success( 'Người dùng đã được xóa thành công.');
            }
        }
        $this->reset(['search']);
        $this->closePopup();
    }
    
}
