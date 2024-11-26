<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Contact; // Hoặc model bạn sử dụng cho liên hệ
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail; // Mailable để gửi email cho liên hệ

class ManageContactSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contact:manage-schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Quản lý các yêu cầu liên hệ chưa xử lý hoặc cần nhắc nhở';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // 1. Lấy danh sách các liên hệ chưa xử lý (ví dụ dựa vào trạng thái)
        $unprocessedContacts = Contact::where('status', 'unprocessed')->get();

        // 2. Duyệt qua từng liên hệ và gửi email nhắc nhở (ví dụ)
        foreach ($unprocessedContacts as $contact) {
            // Gửi email nhắc nhở
            try {
                Mail::to($contact->email)->send(new ContactUsMail($contact)); // Bạn có thể custom lại mailable này
                $this->info("Đã gửi email nhắc nhở cho liên hệ ID: {$contact->id}");
            } catch (\Exception $e) {
                $this->error("Lỗi khi gửi email cho liên hệ ID: {$contact->id}. Lỗi: {$e->getMessage()}");
            }
        }

        // 3. Xử lý các liên hệ cũ đã quá hạn (ví dụ xóa những liên hệ không còn cần thiết)
        Contact::where('created_at', '<', now()->subMonths(6)) // Các liên hệ cũ hơn 6 tháng
            ->where('status', 'unprocessed')
            ->delete();

        $this->info('Đã xử lý xong các liên hệ.');
    }
}
