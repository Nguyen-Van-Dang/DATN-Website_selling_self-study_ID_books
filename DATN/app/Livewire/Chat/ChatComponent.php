<?php

namespace App\Livewire\Chat;

use App\Events\NewMessageEvent;
use App\Http\Requests\SendMessageRequest;
use Livewire\Component;
use App\Models\ChatGroup;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class ChatComponent extends Component
{
    public $groups;
    public $selectedGroup;
    public $groupId;
    public $messages;
    public $myMessages;
    public $otherMessages;
    public $newMessage = '';
    protected $listeners = ['messageReceived' => 'updateMessages'];


    public function mount()
    {
        $currentUserId = Auth::id();
        $this->groups = ChatGroup::whereHas('participants', function ($query) use ($currentUserId) {
            $query->where('user_id', $currentUserId);
        })->get();
        if ($this->groups->isNotEmpty()) {
            $this->selectedGroup = $this->groups->first();
            $this->groupId = $this->selectedGroup->id;

            $this->selectGroup($this->groupId);
        }
    }

    public function selectGroup($groupId)
    {
        $this->groupId = $groupId;
        $this->selectedGroup = ChatGroup::find($this->groupId);
        $this->messages = $this->selectedGroup->messages()->with('user')->get();
        $this->myMessages = $this->messages->where('user_id', Auth::id());
        $this->otherMessages = $this->messages->where('user_id', '!=', Auth::id());
    }


    public function sendMessage()
    {
        $message = ChatMessage::create([
            'user_id' => Auth::id(),
            'group_id' => $this->selectedGroup->id,
            'message' => $this->newMessage,
        ]);

        broadcast(new NewMessageEvent($message))->toOthers();

        $this->newMessage = '';
        $this->messages = $this->selectedGroup->messages()->with('user')->get();
    }

    public function updateMessages($message)
    {
        dd($this->messages->push(new ChatMessage($message)));
    }

    public function render()
    {
        return view('livewire.chat.chatview', [
            'selectedGroup' => $this->selectedGroup,
            'messages' => $this->messages,
        ]);
    }
}
