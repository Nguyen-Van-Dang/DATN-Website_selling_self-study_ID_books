import './bootstrap';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '2dd03bcdcd6ca1fda1a6', // Thay thế bằng key Pusher của bạn
    cluster: 'ap1', // Thay thế bằng cluster của bạn
    encrypted: true, // Đảm bảo sử dụng mã hóa
    wsHost: window.location.hostname, // Địa chỉ máy chủ (localhost nếu đang phát triển cục bộ)
    wsPort: 6001, // Cổng WebSocket (thay đổi nếu cần)
    wssPort: 443, // Cổng SSL
    forceTLS: true, // Sử dụng mã hóa SSL
    enabledTransports: ['ws', 'wss'], // Cho phép cả WebSocket không mã hóa và có mã hóa
});
