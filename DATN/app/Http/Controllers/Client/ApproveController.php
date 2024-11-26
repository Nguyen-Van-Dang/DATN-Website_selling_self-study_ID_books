<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ApproveRepository;
use App\Mail\ApprovalNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookRejectionNotification;
use App\Mail\CourseRejectionNotification;
use App\Mail\RejectionNotification;
class ApproveController extends Controller
{
    private ApproveRepository $approveRepository;
    public function __construct(ApproveRepository $approveRepository)
    {
        $this->approveRepository = $approveRepository;
    }

    public function index()
    {
        return view('admin.approve.approve');
    }

    public function checkRole()
    {
        return $this->approveRepository->checkRole();
    }
    public function approve($model, $id)
    {
        $modelClass = 'App\\Models\\' . ucfirst($model);
        
        if (!class_exists($modelClass)) {
            return redirect()->back()->withErrors(['error' => 'Model không tồn tại!']);
        }
    
        $item = $modelClass::findOrFail($id);
        $item->status = 0; // Đã duyệt
        $item->save();
    
        // Gửi email cho người dùng
        if ($model === 'user') {
            Mail::to($item->email)->send(new ApprovalNotification($item));
        } elseif ($model === 'book') {
            // Gửi email cho người mua sách
            Mail::to($item->user->email)->send(new ApprovalNotification($item)); // Giả sử book có quan hệ với user
        } elseif ($model === 'course') {
            // Gửi email cho người đăng ký khóa học
            Mail::to($item->user->email)->send(new ApprovalNotification($item)); // Giả sử course có quan hệ với user
        }
    
        return redirect()->back()->with('success', ucfirst($model) . ' đã được duyệt thành công!');
    }
    
    
    public function reject($model, $id)
    {
        $modelClass = 'App\\Models\\' . ucfirst($model);
        
        if (!class_exists($modelClass)) {
            return redirect()->back()->withErrors(['error' => 'Model không tồn tại!']);
        }
    
        $item = $modelClass::findOrFail($id);
    
        // Gửi email cho người dùng thông báo từ chối
        if ($model === 'user') {
            Mail::to($item->email)->send(new RejectionNotification($item));
        } elseif ($model === 'book') {
            // Gửi email cho người mua sách
            Mail::to($item->user->email)->send(new BookRejectionNotification($item)); // Giả sử book có quan hệ với user
        } elseif ($model === 'course') {
            // Gửi email cho người đăng ký khóa học
            Mail::to($item->user->email)->send(new CourseRejectionNotification($item)); // Giả sử course có quan hệ với user
        }
    
        // Xóa bản ghi (từ chối duyệt)
        $item->delete();
    
        return redirect()->back()->with('success', ucfirst($model) . ' đã bị từ chối!');
    }
    
    
    
}
