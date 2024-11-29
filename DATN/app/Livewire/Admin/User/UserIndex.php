<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Services\GoogleDriveService;
use App\Jobs\UploadFileJob;

class UserIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $userData, $newImg;
    public $existingImageUrl;
    public $name, $image_url, $email, $phone, $password, $role_id, $status, $sex;
    public $nameAdd, $image_urlAdd, $emailAdd, $phoneAdd, $role_idAdd, $statusAdd, $passwordAdd, $sexAdd;
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
                $this->sexAdd = $user->sex;
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
        $rules = [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,' . $this->editingId,
            'phone' => [
                'required',
                'numeric',
                'unique:users,phone,' . $this->editingId,
                'regex:/^0[0-9]{9}$/',
                'digits:10',
            ],
            'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]*$/',
                'min:6',
                'max:25',
            ],
            'image_url' => [
                'required',
                'max:2048',
            ],
        ];

        $messages = [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không được quá 50 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Số điện thoại không được để trống',
            'password.regex' => 'Mật khẩu ít nhất 1 chữ cái in hoa, 1 chữ cái thường, và có 1 số.',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá 25 ký tự.',
            'phone.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và có đúng 10 chữ số.',
            'phone.digits' => 'Số điện thoại phải có đúng 10 chữ số.',
            'phone.unique' => 'Số điện thoại này đã được sử dụng, vui lòng chọn số khác.',
            'image_url.required' => 'Hình ảnh không được để trống',
            'image_url.max' => 'Kích thước ảnh không được vượt quá 2MB.',
        ];

        // Validate dữ liệu
        $this->validate($rules, $messages);
        // Tạo người dùng mới
        $user = new User();
        $user->name = $this->name;
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->role_id = $this->role_id = 1;
        $user->status = 0;
        $user->sex = $this->sex;
        $user->password = bcrypt($this->password);
        $user->save();

        // Nếu có ảnh, thực hiện xử lý ảnh
        if ($this->image_url) {
            $folderId = '1E1KVm0X-uBr6vyWLPuzrRu4XGhnOJY2M';
            $filePath = $this->image_url->store('temp');
            UploadFileJob::dispatch($user, $folderId, $filePath, 'thumbnail');
            $user->save();
        }

        // Reset form sau khi xử lý
        $this->reset(['name', 'phone', 'email', 'role_id', 'status', 'password', 'image_url']);
        $this->isAddPopupOpen = false;
        return redirect('/admin/danh-sach-nguoi-dung')->with('success', 'Thêm tài khoản thành công');
    }
    public function updateUser()
    {
        $rules = [
            'nameAdd' => 'required|max:50',
            'emailAdd' => 'required|email|unique:users,email,' . $this->editingId,
            'phoneAdd' => [
                'required',
                'numeric',
                'unique:users,phone,' . $this->editingId,
                'regex:/^0[0-9]{9}$/',
                'digits:10',
            ],
            'passwordAdd' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]*$/',
                'min:6',
                'max:25',
            ],
            'newImg' => [
                'required',
                'max:2048',
            ],
        ];

        $messages = [
            'nameAdd.required' => 'Tên không được để trống',
            'nameAdd.max' => 'Tên không được quá 50 ký tự',
            'emailAdd.required' => 'Email không được để trống',
            'emailAdd.email' => 'Email không đúng định dạng',
            'emailAdd.unique' => 'Email đã tồn tại',
            'phoneAdd.required' => 'Số điện thoại không được để trống',
            'passwordAdd.regex' => 'Mật khẩu ít nhất 1 chữ cái in hoa, 1 chữ cái thường, và có 1 số.',
            'passwordAdd.required' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'passwordAdd.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'passwordAdd.max' => 'Mật khẩu không được vượt quá 25 ký tự.',
            'phoneAdd.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và có đúng 10 chữ số.',
            'phoneAdd.digits' => 'Số điện thoại phải có đúng 10 chữ số.',
            'phoneAdd.unique' => 'Số điện thoại này đã được sử dụng, vui lòng chọn số khác.',
            'newImg.required' => 'Hình ảnh không được để trống',
            'newImg.max' => 'Kích thước ảnh không được vượt quá 2MB.',
        ];

        // Validate dữ liệu
        $this->validate($rules, $messages);

        $user = User::find($this->editingId);

        if (!$user) {
            session()->flash('error', 'Người dùng không tồn tại.');
            return;
        }

        $user->name = $this->nameAdd;
        $user->email = $this->emailAdd;
        $user->phone = $this->phoneAdd;
        $user->role_id = $this->role_idAdd;
        $user->password = bcrypt($this->passwordAdd);
        $user->status = 0;
        $user->sex = $this->sexAdd;

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
        $this->reset(['editingId', 'nameAdd', 'emailAdd', 'phoneAdd', 'role_idAdd', 'statusAdd', 'newImg', 'passwordAdd']);
        $this->isEditPopupOpen = false;
        return redirect('/admin/danh-sach-nguoi-dung')->with('success', 'Sửa tài khoản thành công');
    }
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
                toastr()->success('Người dùng đã được xóa thành công.');
            }
        }
        $this->reset(['search']);
        $this->closePopup();
    }
}
