import "./bootstrap";

import Echo from "laravel-echo";
import Pusher from "pusher-js";

import toastr from "toastr";
import "public/assets/css/toastr.min.css"; // Đảm bảo rằng bạn đã thêm file CSS của Toastr

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: "2dd03bcdcd6ca1fda1a6", // Thay thế bằng key Pusher của bạn
    cluster: "ap1", // Thay thế bằng cluster của bạn
    encrypted: true, // Đảm bảo sử dụng mã hóa
    wsHost: window.location.hostname, // Địa chỉ máy chủ (localhost nếu đang phát triển cục bộ)
    wsPort: 6001, // Cổng WebSocket (thay đổi nếu cần)
    wssPort: 443, // Cổng SSL
    forceTLS: true, // Sử dụng mã hóa SSL
    enabledTransports: ["ws", "wss"], // Cho phép cả WebSocket không mã hóa và có mã hóa
});
document.addEventListener("DOMContentLoaded", function () {
    if (window.Laravel.message) {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-center", // Vị trí thông báo
            timeOut: "5000", // Thời gian hiển thị (ms)
            extendedTimeOut: "1000", // Thời gian gia hạn khi hover
            fadeIn: 300, // Thời gian fade-in
            fadeOut: 1000, // Thời gian fade-out
            showMethod: "slideDown", // Hiển thị từ trên xuống
            hideMethod: "fadeOut", // Ẩn với hiệu ứng fade-out
        };

        // Hiển thị thông báo
        toastr[window.Laravel.alert_type](window.Laravel.message);
    }

    if (window.Laravel.message_error) {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-center", // Vị trí thông báo
            timeOut: "5000", // Thời gian hiển thị (ms)
            extendedTimeOut: "1000", // Thời gian gia hạn khi hover
            fadeIn: 300, // Thời gian fade-in
            fadeOut: 1000, // Thời gian fade-out
            showMethod: "slideDown", // Hiển thị từ trên xuống
            hideMethod: "fadeOut", // Ẩn với hiệu ứng fade-out
        };

        // Hiển thị thông báo lỗi
        toastr[window.Laravel.alert_type_error](window.Laravel.message_error);
    }
});
