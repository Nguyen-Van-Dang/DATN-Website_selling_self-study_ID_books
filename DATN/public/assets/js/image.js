const fileInput = document.getElementById('cover');
const previewContainer = document.getElementById('preview');
const selectImageButton = document.getElementById('selectImageButton');

// Khi bấm nút chọn ảnh, kích hoạt input file
selectImageButton.addEventListener('click', () => {
    fileInput.click();
});

// Lắng nghe sự kiện thay đổi file
fileInput.addEventListener('change', function(event) {
    const file = event.target.files[0];

    // Kiểm tra nếu có ảnh hợp lệ được chọn
    if (file && file.type.startsWith('image/')) {
        // Tạo URL cho ảnh để xem trước
        const imgPreview = document.createElement('img');
        imgPreview.src = URL.createObjectURL(file);
        imgPreview.style.maxWidth = '100%';
        imgPreview.style.maxHeight = '200px';
        imgPreview.style.borderRadius = '5px';
        imgPreview.style.cursor = 'pointer';
        imgPreview.style.display = 'inline-block'; // Đảm bảo ảnh hiển thị cùng với dấu "X"

        // Tạo dấu "X" để xóa ảnh
        const closeButton = document.createElement('span');
        closeButton.textContent = 'x';
        closeButton.style.color = '#0000007a';
        closeButton.style.cursor = 'pointer';
        closeButton.style.fontSize = '20px';
        closeButton.style.marginLeft = '-15px';
        closeButton.style.marginTop = '-5px';
        closeButton.style.position = 'absolute';

        // Ẩn nút và hiển thị ảnh xem trước
        selectImageButton.style.display = 'none';
        previewContainer.innerHTML = ''; // Xóa nội dung trước đó
        previewContainer.appendChild(imgPreview);
        previewContainer.appendChild(closeButton); // Thêm dấu "X"

        // Khi bấm vào dấu "X", xóa ảnh và hiển thị lại nút
        closeButton.addEventListener('click', () => {
            // Đặt lại input file và hiển thị lại nút
            fileInput.value = '';
            selectImageButton.style.display = 'block';
            previewContainer.innerHTML = ''; // Xóa ảnh xem trước
        });

        // Khi bấm vào ảnh xem trước, chọn lại file khác
        imgPreview.addEventListener('click', () => {
            fileInput.click();
        });

        // Giải phóng URL khi ảnh không còn sử dụng
        imgPreview.onload = function() {
            URL.revokeObjectURL(imgPreview.src);
        };

        // Thêm hiệu ứng hover cho dấu "X"
        closeButton.addEventListener('mouseenter', () => {
            closeButton.style.color = '#0dd6b8'; // Thay đổi màu khi hover
            closeButton.style.transform = 'scale(1.2)'; // Tăng kích thước
        });

        closeButton.addEventListener('mouseleave', () => {
            closeButton.style.color = '#0000007a'; // Trả về màu ban đầu
            closeButton.style.transform = 'scale(1)'; // Trả về kích thước ban đầu
        });
    } else {
        // Nếu không chọn ảnh hoặc ảnh không hợp lệ, giữ lại nút
        previewContainer.innerHTML = ''; // Xóa nội dung nếu không hợp lệ
    }
});