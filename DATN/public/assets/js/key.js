const textarea = document.getElementById('description');
        const charCount = document.getElementById('charCount');
        const errorMsg = document.getElementById('errorMsg');
        const maxLength = 2000;

        textarea.addEventListener('input', function() {
            // Giới hạn số ký tự
            if (textarea.value.length > maxLength) {
                textarea.value = textarea.value.substring(0, maxLength);
                showErrorMsg(); // Gọi hàm hiển thị thông báo lỗi
            }
            
            const currentLength = textarea.value.length;
            charCount.textContent = `${currentLength} ký tự/${maxLength}`;
        });

        function showErrorMsg() {
            errorMsg.style.display = 'block'; // Hiển thị thông báo
            errorMsg.style.top = '10px'; // Đặt vị trí thông báo xuống dưới
            errorMsg.style.opacity = '1'; // Đặt độ mờ 1

            // Tự động ẩn thông báo sau 3 giây
            setTimeout(() => {
                errorMsg.style.opacity = '0'; // Giảm độ mờ
                setTimeout(() => {
                    errorMsg.style.display = 'none'; // Ẩn thông báo
                    errorMsg.style.top = '-50px'; // Đặt lại vị trí ra ngoài màn hình
                }, 500); // Thời gian ẩn sau khi độ mờ giảm
            }, 3000); // Thời gian hiển thị thông báo
        }