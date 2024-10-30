<?php

namespace App\Livewire\Chat;

use App\Events\NewMessageEvent;
use App\Http\Requests\SendMessageRequest;
use Livewire\Component;
use App\Models\ChatGroup;
use App\Models\ChatMessage;
use App\Models\ChatParticipant;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;


class ChatComponent extends Component
{
    public $groups;
    public $selectedGroup;
    public $groupId;
    public $messages;
    public $myMessages;
    public $otherMessages;
    public $newMessage = '';
    public $searchTerm = '';

    public $latestMessage;

    public $lastMessageTime = null;
    protected $listeners = ['messageReceived' => 'updateMessages'];

    use WithPagination;

    public function mount()
    {
        $currentUserId = Auth::id();

        $this->groups = ChatGroup::whereHas('participants', function ($query) use ($currentUserId) {
            $query->where('user_id', $currentUserId);
        })->get();

        if ($this->groups->isNotEmpty()) {
            $this->selectGroup($this->groups->first()->id);
        }

        $this->loadGroups();
    }
    public function updatedSearchTerm()
    {
        $this->resetPage();
        $this->loadGroups();
    }

    public function loadGroups()
    {
        $currentUserId = Auth::id();

        $this->groups = ChatGroup::whereHas('participants', function ($query) use ($currentUserId) {
            $query->where('user_id', $currentUserId);
        })

            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->get();
    }
    public function selectGroup($groupId)
    {
        $this->groupId = $groupId;
        $this->selectedGroup = ChatGroup::find($this->groupId);
        $this->messages = $this->selectedGroup->messages()->with('user')->get();
        $this->myMessages = $this->messages->where('user_id', Auth::id());
        $this->otherMessages = $this->messages->where('user_id', '!=', Auth::id());

        $this->latestMessage = ChatMessage::where('group_id', $this->selectedGroup->id)
            ->orderBy('created_at', 'desc')
            ->first();
    }


    public function sendMessage()
    {
        // if ($this->lastMessageTime && now()->diffInSeconds($this->lastMessageTime) < 1) {
        //     return;
        // }
        // $this->lastMessageTime = now();


        if (empty(trim($this->newMessage))) {
            return;
        }

        $message = ChatMessage::create([
            'user_id' => Auth::id(),
            'group_id' => $this->selectedGroup->id,
            'message' => $this->newMessage,
        ]);

        broadcast(new NewMessageEvent($message))->toOthers();

        $this->messages->push($message);
        $this->newMessage = '';
        $this->messages = $this->selectedGroup->messages()->with('user')->get();
        $this->loadGroups();
    }

    public function updateMessages($message)
    {
        $this->messages->push(new ChatMessage($message));
    }

    public function render()
    {
        return view('livewire.chat.chatview', [
            'selectedGroup' => $this->selectedGroup,
            'messages' => $this->messages,
            'latestMessage' => $this->latestMessage,
        ]);
    }
}
