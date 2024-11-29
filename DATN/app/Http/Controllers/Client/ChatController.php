<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\ChatRepository;
use Illuminate\Http\Request;
use App\Models\ChatGroup;
use Illuminate\Support\Facades\Auth;
use app\Events\NewMessageSent;
use App\Models\ChatParticipant;
use App\Models\EnrollCourse;

class ChatController extends Controller
{
    protected $ChatRepository;
    public function __construct(ChatRepository $chatRepository)
    {
        $this->ChatRepository = $chatRepository;
    }
    public function index($id = null)
    {
        $userId = Auth::id();
        $hasGroups = ChatParticipant::where('user_id', $userId)->exists();
        if (!$hasGroups) {
            return view('client.chat.notfound');
        }
        return view('client.chat.chatpage', compact('id'));
    }
    public function show($id = null)
    {
        // kiểm tra nhóm chat có tồn tại không
        $chatGroup = ChatGroup::find($id);
        if (!$chatGroup) {
            return redirect()->back()->with('error', 'Nhóm chat không tồn tại');
        }

        $currentUserId = Auth::id();

        // kiểm tra người dùng đã tham gia nhóm chat chưa
        $participant = ChatParticipant::where('group_id', $id)
            ->where('user_id', $currentUserId)
            ->first();

        if ($participant) {
            // người dùng đã tham gia nhóm, cho phép truy cập
            return view('client.chat.chatpage', compact('id'));
        }

        // kiểm tra người dùng đã đăng ký khoá học liên quan đến nhóm chat chưa
        $hasEnrolled = EnrollCourse::where('user_id', $currentUserId)
            ->where('course_id', $chatGroup->course_id)
            ->exists();

        if ($hasEnrolled) {
            // tạo mới thành viên 
            ChatParticipant::create([
                'group_id' => $id,
                'user_id' => $currentUserId,
                'status' => 0,
            ]);

            return view('client.chat.chatpage', compact('id'))->with('success', 'Đã tham gia nhóm chat');
        }

        return redirect()->back()->with('error', 'Bạn không có quyền truy cập nhóm chat này');
    }

    public function leaveGroup($id)
    {
        $group = ChatGroup::find($id);
        if ($group) {
            if (auth::id() == 1 || auth::id() == 2) {
                $group->participants()->delete();
                $group->delete();
                session()->flash('message', 'Nhóm đã bị xóa thành công.');
                return response()->json(['success' => true]);
            } else {
                $participant = ChatParticipant::where('group_id', $group->id)
                    ->where('user_id', Auth::id())
                    ->first();
                if ($participant) {
                    $participant->delete();
                    session()->flash('message', 'Bạn đã rời khỏi nhóm thành công.');
                    return response()->json(['success' => true]);
                }
            }
        }

        return response()->json(['success' => false], 404);
    }
}
