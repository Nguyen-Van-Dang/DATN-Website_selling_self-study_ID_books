<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;
use App\Models\Contact;

class ContactController extends Controller
{
    private ContactRepository $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * Store the contact form submission and send email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeContact(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:5000',
        ]);
    
        // Gọi repository để lưu liên hệ
        $contact = $this->contactRepository->store($validatedData);
    
        // Kiểm tra nếu email đã tồn tại
        if (!$contact) {
            session()->flash('error', 'Email này đã được sử dụng để gửi liên hệ trước đó!');
            return redirect()->route('addContact');
        }
    
        // Gửi email
        try {
            Mail::to('infobookstorefpt@gmail.com')->send(new ContactUsMail($validatedData));
            session()->flash('success', 'Bạn đã gửi thông tin liên hệ thành công, chúng tôi sẽ liên hệ đến bạn trong thời gian sớm nhất !!!');
        } catch (\Exception $e) {
            session()->flash('error', 'Đã có lỗi xảy ra, vui lòng thử lại!');
        }
    
        return redirect()->route('addContact');
    }
    



    public function getAllContact(Request $request)
    {
        $query = Contact::query();

        // Lọc theo vai trò
        if ($request->filled('role')) {
            $query->whereHas('user.role', function ($q) use ($request) {
                $q->where('id', $request->role);
            });
        }

        // Lọc theo ngày
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Load thông tin user và role liên quan
        $contacts = $query->with(['user.role'])->orderBy('created_at', 'desc')->get();

        return view('admin.contact.listContact', compact('contacts'));
    }



    public function replyContactForm($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contact.replyContact', compact('contact'));
    }

    public function sendReply(Request $request, $id)
    {
        $validatedData = $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        $contact = Contact::findOrFail($id);

        // Gửi email phản hồi
        try {
            Mail::to($contact->email)->send(new ContactUsMail([
                'name' => $contact->name,
                'email' => $contact->email,
                'message' => $validatedData['message'],
            ]));

            // Cập nhật trạng thái
            $contact->update(['is_replied' => true]);

            session()->flash('success', 'Đã gửi phản hồi thành công!');
        } catch (\Exception $e) {
            session()->flash('error', 'Gửi phản hồi thất bại!');
        }

        return redirect()->route('listContact');
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return redirect()->route('listContact')->with('error', 'Liên hệ không tồn tại.');
        }

        $contact->delete();

        return redirect()->route('listContact')->with('success', 'Liên hệ đã được xóa thành công.');
    }




    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if ($ids) {
            // Xóa các liên hệ theo ID
            Contact::whereIn('id', $ids)->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
}
