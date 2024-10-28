<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\ChatRepository;
use Illuminate\Http\Request;
use App\Models\ChatGroup;
use Illuminate\Support\Facades\Auth;
use app\Events\NewMessageSent;

class ChatController extends Controller
{
    protected $ChatRepository;
    public function __construct(ChatRepository $chatRepository)
    {
        $this->ChatRepository = $chatRepository;
    }
    public function index()
    {
        return view('client.chat.chatpage');
    }
}
