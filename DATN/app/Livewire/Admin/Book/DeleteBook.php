<?php

namespace App\Livewire\Admin\Book;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Book;

class DeleteBook extends Component
{
    public function render()
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();
    
        if ($user->role_id == 1) {
            // Nếu là quản trị viên (role_id == 1), hiển thị tất cả các sách đã bị xóa
            $bookUsers = Book::onlyTrashed()->get();
        } else {
            // Nếu là người dùng thông thường (role_id == 2), chỉ hiển thị sách của chính họ đã bị xóa
            $bookUsers = Book::onlyTrashed()
                ->where('user_id', $user->id)
                ->get();
        }
    
        return view('livewire.admin.book.delete-book', ['bookUsers' => $bookUsers]);
    }
    
}
