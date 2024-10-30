<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\ChatRepository;
use Illuminate\Http\Request;
use App\Models\ChatGroup;
use Illuminate\Support\Facades\Auth;
use app\Events\NewMessageSent;
use App\Models\ChatParticipant;

class ChatController extends Controller
{
    protected $ChatRepository;
    public function __construct(ChatRepository $chatRepository)
    {
        $this->ChatRepository = $chatRepository;
    }
    public function index()
    {
        $userId = Auth::id();
        $hasGroups = ChatParticipant::where('user_id', $userId)->exists();
        if (!$hasGroups) {
            return view('client.chat.notfound');
        }
        return view('client.chat.chatpage');
    }
    public function leaveGroup($id)
    {
        // Tìm nhóm chat
        $group = ChatGroup::find($id);

        if ($group) {
            // Tìm người dùng hiện tại trong nhóm
            $participant = ChatParticipant::where('group_id', $group->id)
                ->where('user_id', Auth::id())
                ->first();
            if ($participant) {
                // Xóa người dùng khỏi nhóm
                $participant->delete();
                return response()->json(['success' => true]);
            }
        }

        return response()->json(['success' => false], 404);
    }
}
