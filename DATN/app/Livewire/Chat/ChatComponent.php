<?php

namespace App\Livewire\Chat;

use App\Events\NewMessageEvent;
use App\Http\Requests\CreateChatGroupRequest;
use App\Http\Requests\SendMessageRequest;
use Livewire\Component;
use App\Models\ChatGroup;
use App\Models\ChatMessage;
use App\Models\ChatParticipant;
use App\Models\Course;
use App\Services\GoogleDriveService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class ChatComponent extends Component
{
    use WithFileUploads;
    public $groups, $selectedGroup,  $groupId, $messages, $myMessages, $otherMessages, $latestMessage, $latitude, $longitude, $members;
    public $newMessage = '';
    public $searchTerm = '';
    public $searchMemberTerm = '';
    public $image = '';
    protected $listeners = [
        'messageReceived' => 'updateMessages',
        'messageSent' => 'updateGroups',
    ];

    public $isAddPopupOpen = false;
    public $isEditPopupOpen = false;
    public $isDeletePopupOpen = false;
    public  $deletedId;
    public $editingId;
    public $groupName, $groupDescription, $groupCourse, $groupImage;
    public $courses = [];


    public function openPopup($type, $id = null)
    {
        if ($type === 'add') {
            $this->isAddPopupOpen = true;
        } elseif ($type === 'edit' && $id) {
            $this->editingId = $id;
            $groupFind = ChatGroup::find($id);
            if ($groupFind) {
                $this->groupName = $groupFind->name;
                $this->groupDescription = $groupFind->description;
                $this->groupCourse = $groupFind->course_id;
                $this->groupImage = $groupFind->avatar;
            }
            $this->isEditPopupOpen = true;
        } elseif ($type === 'delete' && $id) {
            $this->deletedId = $id;
            $this->isDeletePopupOpen = true;
        }
    }
    public function closePopup()
    {
        $this->reset(['isAddPopupOpen', 'isEditPopupOpen', 'isDeletePopupOpen', 'groupName', 'groupDescription', 'deletedId', 'editingId', 'groupImage', 'groupCourse']);
    }
    public function mount()
    {
        $currentUserId = Auth::id();
        $isAddPopupOpen = false;
        $this->groups = ChatGroup::whereHas('participants', function ($query) use ($currentUserId) {
            $query->where('user_id', $currentUserId);
        })->get();

        if ($this->groups->isNotEmpty()) {
            $this->selectGroup($this->groups->first()->id);
        }
        $this->loadCourses($currentUserId);
        $this->loadGroups();
    }
    public function updatedSearchTerm()
    {
        $this->loadGroups();
    }
    public function updatedSearchMemberTerm()
    {
        $this->loadMembers();
    }
    public function updateGroups()
    {
        $this->loadGroups();
    }

    public function loadGroups()
    {
        $currentUserId = Auth::id();

        $this->groups = ChatGroup::whereHas('participants', function ($query) use ($currentUserId) {
            $query->where('user_id', $currentUserId);
        })
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->with(['messages' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->get()
            ->sortByDesc(function ($group) {
                return $group->messages->first() ? $group->messages->first()->created_at : null;
            });
        $this->groups = $this->groups->values();
    }
    public function loadMembers()
    {
        $this->selectedGroup->participants = $this->selectedGroup->participants()->where('role', 0)
            ->whereHas('user', function ($query) {
                $query->where('name', 'like', '%' . $this->searchMemberTerm . '%');
            })->get();
    }
    public function selectGroup($groupId)
    {
        $this->groupId = $groupId;
        $this->selectedGroup = ChatGroup::with('media')->find($this->groupId);
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

        $this->newMessage = '';
        $this->messages = $this->selectedGroup->messages()->with('user')->get();
        $this->loadGroups();
    }

    public function updateMessages($message)
    {
        $this->messages = $this->selectedGroup->messages()->with('user')->get();
        $this->loadGroups();
    }

    public function loadCourses($user_id)
    {
        $this->courses = Course::where('user_id', $user_id)->get();
    }
    public function createParticipant($user_id, $group_id, $role)
    {
        $participant = new ChatParticipant();
        $participant->user_id = $user_id;
        $participant->group_id = $group_id;
        $participant->role = $role;
        $participant->save();
    }
    public function createChatGroup()
    {
        $validatedData = $this->validate([
            'groupName' => 'required|string|max:255',
            'groupDescription' => 'required|string|max:500',
            'groupImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'groupCourse' => 'required',
        ], [
            'groupName.required' => 'Tên nhóm chat là bắt buộc.',
            'groupName.max' => 'Tên nhóm chat không được vượt quá 255 ký tự.',
            'groupDescription.required' => 'Mô tả nhóm là bắt buộc.',
            'groupDescription.max' => 'Mô tả nhóm không được vượt quá 500 ký tự.',
            'groupImage.image' => 'Phải là định dạng ảnh',
            'groupImage.max' => 'Ảnh vượt quá dung lượng cho phép (2 MB) ',
            'groupCourse.required' => 'Khoá học đại diện là bắt buộc.',
        ]);

        $groupCreate = new ChatGroup();
        $groupCreate->name = $this->groupName;
        $groupCreate->description = $this->groupDescription;
        $groupCreate->course_id = $this->groupCourse;

        if ($this->groupImage) {
            $folderId = '1ccvEGR7O8_BIV5X6Kq4CSct6VviDckUz';
            $googleDriveService = new GoogleDriveService();
            $fileId = $googleDriveService->uploadAndGetFileId($this->groupImage, $folderId);
            $groupCreate->avatar = "https://drive.google.com/thumbnail?id=" . $fileId;
        } else {
            $groupCreate->avatar = '';
        }

        $groupCreate->save();



        $currentUser = Auth::id();
        $groupId = $groupCreate->id;
        $role = 1;
        $this->createParticipant($currentUser, $groupId, $role);


        $this->reset(['groupName', 'groupDescription', 'groupCourse', 'groupImage']);
        $this->closePopup();
        $this->loadGroups();
    }

    public function updateChatGroup()
    {
        $validatedData = $this->validate([
            'groupName' => 'nullable|string|max:255',
            'groupDescription' => 'nullable|string|max:500',
            'groupCourse' => 'nullable',
        ], [
            'groupName.max' => 'Tên nhóm chat không được vượt quá 255 ký tự.',
            'groupDescription.max' => 'Mô tả nhóm không được vượt quá 500 ký tự.',
        ]);
        $groupUpdate =  ChatGroup::find($this->editingId);
        if (isset($this->groupName)) {
            $groupUpdate->name = $this->groupName;
        }
        if (isset($this->groupDescription)) {
            $groupUpdate->description = $this->groupDescription;
        }
        if (isset($this->groupCourse)) {
            $groupUpdate->course_id = $this->groupCourse;
        }
        if (isset($this->groupImage)) {
            $folderId = '1ccvEGR7O8_BIV5X6Kq4CSct6VviDckUz';
            $googleDriveService = new GoogleDriveService();

            if (is_null($groupUpdate->avatar)) {
                $fileId = $googleDriveService->uploadAndGetFileId($this->groupImage, $folderId);
                $groupUpdate->avatar = "https://drive.google.com/thumbnail?id=" . $fileId;
            } elseif ($groupUpdate->avatar != $this->groupImage) {
                $fileId = $googleDriveService->updateFile($groupUpdate->avatar, $this->groupImage, $folderId);
                $groupUpdate->avatar = "https://drive.google.com/thumbnail?id=" . $fileId;
            }
        }
        $groupUpdate->save();
        $this->reset(['groupName', 'groupDescription', 'groupCourse', 'groupImage']);
        $this->closePopup();
        $this->loadGroups();
    }


    public function render()
    {
        return view('livewire.chat.chatview', [
            'selectedGroup' => $this->selectedGroup,
            'messages' => $this->messages,
            'latestMessage' => $this->latestMessage
        ]);
    }
}
