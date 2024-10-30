// Import Bootstrap hoặc các thư viện khác mà bạn cần
import './bootstrap';

// Import Laravel Echo và Pusher
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Khởi tạo Pusher
window.Pusher = Pusher;

// Khởi tạo Laravel Echo
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '2dd03bcdcd6ca1fda1a6', // Thay thế bằng key Pusher của bạn
    cluster: 'ap1', // Thay thế bằng cluster của bạn
    encrypted: true,
});

// Optional: Nếu bạn đang sử dụng Livewire, hãy thêm đoạn này
import 'livewire/livewire';
