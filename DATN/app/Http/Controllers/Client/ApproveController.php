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
use App\Mail\BookApprovalNotification;
use App\Mail\CourseApprovalNotification;

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

        $item = $modelClass::find($id);

        if (!$item) {
            return redirect()->back()->withErrors(['error' => 'Item không tồn tại!']);
        }

        $item->status = 0; // Đã duyệt
        $item->save();

        // Gửi email cho người dùng
        if ($model === 'user') {
            Mail::to($item->email)->send(new ApprovalNotification($item));
        } elseif ($model === 'book') {
            if ($item->user) {
                Mail::to($item->user->email)->send(new BookApprovalNotification($item));
            } else {
                return redirect()->back()->withErrors(['error' => 'User không tồn tại!']);
            }
        } elseif ($model === 'course') {
            if ($item->user) {
                Mail::to($item->user->email)->send(new CourseApprovalNotification($item));
            } else {
                return redirect()->back()->withErrors(['error' => 'User không tồn tại!']);
            }
        }

        return redirect()->back()->with('success', ucfirst($model) . ' đã được duyệt thành công!');
    }

    public function reject($model, $id)
    {
        $modelClass = 'App\\Models\\' . ucfirst($model);

        if (!class_exists($modelClass)) {
            return redirect()->back()->withErrors(['error' => 'Model không tồn tại!']);
        }

        $item = $modelClass::find($id);

        if (!$item) {
            return redirect()->back()->withErrors(['error' => 'Item không tồn tại!']);
        }

        // Gửi email cho người dùng thông báo từ chối
        if ($model === 'user') {
            Mail::to($item->email)->send(new RejectionNotification($item));
        } elseif ($model === 'book') {
            if ($item->user) {
                Mail::to($item->user->email)->send(new BookRejectionNotification($item));
            } else {
                return redirect()->back()->withErrors(['error' => 'User không tồn tại!']);
            }
        } elseif ($model === 'course') {
            if ($item->user) {
                Mail::to($item->user->email)->send(new CourseRejectionNotification($item));
            } else {
                return redirect()->back()->withErrors(['error' => 'User không tồn tại!']);
            }
        }

        // Xóa bản ghi (từ chối duyệt)
        $item->delete();

        return redirect()->back()->with('success', ucfirst($model) . ' đã bị từ chối!');
    }
}
