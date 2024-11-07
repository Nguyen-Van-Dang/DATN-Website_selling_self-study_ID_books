<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\WithFileUploads; // Thêm vào đây
use Illuminate\Support\Facades\Storage;

use Google\Service\Drive\Permission as Google_Service_Drive_Permission;

class RenderUser extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $userData;
    public $name, $image_url, $email, $phone, $password, $role_id, $status;
    public $nameAdd, $image_urlAdd, $emailAdd, $phoneAdd, $role_idAdd, $statusAdd;
    public $editingId, $deletedId, $search = '';
    public $isAddPopupOpen = false;
    public $isEditPopupOpen = false;
    public $isDeletePopupOpen = false;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $users = User::paginate(5);
        return view('livewire.user.render-user', [
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
                // $this->image_urlAdd = $user->image_url;
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
        $user->image_url = $this->image_url;
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->role_id = $this->role_id;
        $user->status = $this->status;
        // $user->password = bcrypt($this->password); // Mã hóa mật khẩu
        $user->save();
        session()->flash('message', 'Thêm thành công');
        $this->isAddPopupOpen = false;
    }

    // update
    // public function updateUser()
    // {
    //     // Validate dữ liệu đầu vào
    //     $this->validate([
    //         'name' => 'required|unique:users,name,' . $this->editingId,
    //         // 'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'email' => 'required|email|unique:users,email,' . $this->editingId,
    //         'phone' => 'required|unique:users,phone,' . $this->editingId,
    //         'role_id' => 'required',
    //         'status' => 'required',   
    //     ]);

    //     // Tìm người dùng theo ID đang chỉnh sửa
    //     $user = User::find($this->editingId);

    //     // // Xử lý upload ảnh nếu có và nếu $image_url là instance của UploadedFile
    //     // if ($this->image_url && $this->image_url instanceof \Illuminate\Http\UploadedFile) {
    //     //     // Lưu tên tệp và thư mục
    //     //     $imageName = $this->image_url->getClientOriginalName();
    //     //     $directory = 'User/Thumbnails';
    //     //     $disk = Storage::disk('google');

    //     //     // Kiểm tra và tạo thư mục nếu chưa tồn tại
    //     //     if (!$disk->exists($directory)) {
    //     //         $disk->makeDirectory($directory);
    //     //     }

    //     //     // Lưu ảnh vào Google Drive và lấy metadata
    //     //     $imagePath = $directory . '/' . $imageName;
    //     //     $disk->put($imagePath, file_get_contents($this->image_url));
    //     //     $this->setFilePublic($disk, $imagePath);

    //     //     // Lấy metadata của ảnh để cập nhật URL
    //     //     $imageMeta = $disk->getAdapter()->getMetadata($imagePath);
    //     //     if (isset($imageMeta->extraMetadata()['id'])) {
    //     //         $user->image_url = 'https://drive.google.com/file/d/' . $imageMeta->extraMetadata()['id'] . '/preview';
    //     //     } else {
    //     //         session()->flash('error', 'Không thể lấy ID của file.');
    //     //     }
    //     // }

    //     // Cập nhật các trường khác
    //     $user->name = $this->name;
    //     // $user->image_url = $this->image_url;
    //     $user->email = $this->email;
    //     $user->phone = $this->phone;
    //     $user->role_id = $this->role_id;
    //     $user->status = $this->status;
    //     $user->save();
    //     session()->flash('message', 'Người dùng đã được cập nhật thành công.');
    //     $this->isEditPopupOpen = false;
    //     $this->editingId = null;
    // }
    public function updateUser()
    {
        // Validate dữ liệu đầu vào
        $this->validate([
            'nameAdd' => 'required|unique:users,name,' . $this->editingId,
            'emailAdd' => 'required|email|unique:users,email,' . $this->editingId,
            'phoneAdd' => 'required|unique:users,phone,' . $this->editingId,
            'role_idAdd' => 'required',
            'statusAdd' => 'required',
        ]);
    
        // Tìm người dùng theo ID đang chỉnh sửa
        $user = User::find($this->editingId);
    
        if (!$user) {
            session()->flash('error', 'Người dùng không tồn tại.');
            return;
        }
    
        // Cập nhật thông tin người dùng
        $user->name = $this->nameAdd;
        $user->email = $this->emailAdd;
        $user->phone = $this->phoneAdd;
        $user->role_id = $this->role_idAdd;
        $user->status = $this->statusAdd;
        $user->save();
    
        session()->flash('message', 'Người dùng đã được cập nhật thành công.');
        $this->isEditPopupOpen = false;
        $this->editingId = null;
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
