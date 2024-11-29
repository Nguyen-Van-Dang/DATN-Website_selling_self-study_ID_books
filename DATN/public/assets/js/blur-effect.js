document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('a'); // Tất cả liên kết trên trang
    const body = document.body;

    // Khi tải trang, thêm lớp fade-in
    body.classList.add('fade-in');

    links.forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');

            // Nếu href không tồn tại hoặc là javascript:void(0), không làm gì
            if (!href || href === 'javascript:void(0)') {
                return;
            }

            e.preventDefault(); // Ngăn tải ngay lập tức

            // Thêm lớp fade-out
            body.classList.add('fade-out');

            // Chuyển trang sau khi hiệu ứng kết thúc
            setTimeout(() => {
                window.location.href = href;
            }, 1000); // 500ms là thời gian của animation
        });
    });
});
