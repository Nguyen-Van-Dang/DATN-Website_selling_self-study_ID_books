<?php

namespace App\Livewire\Admin\BookCategory;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\BookCategories;

class DeleteBookcate extends Component
{
    public function render()
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();
        if ($user->role_id == 1) {
            // Nếu là quản trị viên (role_id == 1), hiển thị tất cả các sách đã bị xóa
            $bookcateUsers = BookCategories::onlyTrashed()->get();
        } else {
            // Nếu là người dùng thông thường (role_id == 2), chỉ hiển thị sách của chính họ đã bị xóa
            $bookcateUsers = BookCategories::onlyTrashed()
                ->where('user_id', $user->id)
                ->get();
        }
        return view('livewire.admin.book-category.delete-bookcate', ['bookcateUsers' => $bookcateUsers]);
    }
}
