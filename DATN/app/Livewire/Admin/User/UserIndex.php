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
            $users = User::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('id', $this->search)
                ->orderBy('role_id')
                ->paginate(10);
        } else {
            if (Auth::user()->role_id == 1) {
                $users = User::orderBy('role_id')->paginate(10);
            } else {
                $users = User::where('id', Auth::id())->paginate(10);
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
        $user->status = $this->status;
        $user->password = bcrypt($this->password);

        $user->save();

        if ($this->image_url) {

            $folderId = '1E1KVm0X-uBr6vyWLPuzrRu4XGhnOJY2M';
            $googleDriveService = new GoogleDriveService();
            $fileId = $googleDriveService->uploadAndGetFileId($this->image_url, $folderId);
            $image_url = "https://drive.google.com/thumbnail?id=" . $fileId;
            $user->images()->create([
                'image_url' => $image_url,
                'image_name' => 'avatar'
            ]);

            $user->save();
        }

        session()->flash('message', 'Thêm tài khoản thành công');
        $this->reset(['name', 'phone', 'email', 'role_id', 'status', 'password', 'image_url']);
        $this->isAddPopupOpen = false;
    }

    public function updateUser()
    {
        // Tìm người dùng bằng ID
        $user = User::find($this->editingId);

        if (!$user) {
            session()->flash('error', 'Người dùng không tồn tại.');
            return;
        }

        // Cập nhật các thông tin của người dùng
        $user->name = $this->nameAdd;
        $user->email = $this->emailAdd;
        $user->phone = $this->phoneAdd;
        $user->role_id = $this->role_idAdd;
        $user->status = 0;
        // Kiểm tra nếu có ảnh mới
        if (isset($this->newImg)) {
            $folderId = '1E1KVm0X-uBr6vyWLPuzrRu4XGhnOJY2M';
            $googleDriveService = new GoogleDriveService();

            // Nếu người dùng chưa có ảnh, upload ảnh mới
            if ($user->images()->count() == 0) {
                $fileId = $googleDriveService->uploadAndGetFileId($this->newImg, $folderId);

                // Tạo một bản ghi mới trong bảng images
                $user->images()->create([
                    'image_url' => "https://drive.google.com/thumbnail?id=" . $fileId
                ]);
            } else {
                // Nếu người dùng đã có ảnh, cập nhật ảnh cũ
                $firstImage = $user->images()->first();
                if ($firstImage) {
                    $fileId = $googleDriveService->updateFile($firstImage->file_id, $this->newImg, $folderId);
                    $firstImage->update([
                        'image_url' => "https://drive.google.com/thumbnail?id=" . $fileId
                    ]);
                }
            }
        }

        // Lưu thông tin người dùng
        $user->save();

        // Thông báo thành công
        session()->flash('message', 'Người dùng đã được cập nhật thành công.');

        // Reset lại các trường
        $this->reset(['editingId', 'nameAdd', 'emailAdd', 'phoneAdd', 'role_idAdd', 'statusAdd', 'image_urlAdd']);
        $this->isEditPopupOpen = false;
    }
    public function deleted()
    {
        $user = User::find($this->deletedId);

        if ($user) {
            $user->delete();
            session()->flash('message', 'Người dùng đã được xóa thành công.');
        } else {
            session()->flash('error', 'Người dùng không tồn tại.');
        }

        $this->closePopup();
    }
}