@extends('layouts.client.client')

@section('title', 'ReelsUpload1')

@section('content')

    <livewire:reels.reelsUpload1 />
    <script>
        document.getElementById('fileUpload').addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const parentDiv = document.getElementById('dropZone').parentNode;
                parentDiv.style.display = 'none';

                const videoContainer = document.getElementById('videoContainer');
                videoContainer.style.display = 'block';
            }
        });
    </script>
    <script>
        const MAX_SIZE = 1 * 1024 * 1024; // 1GB

        function handleVideoChange(event) {
            const file = event.target.files[0];
            const errorMsgSize = document.getElementById("errorMsgSize");
            const errorMsg = document.getElementById("errorMsg");

            // Ẩn thông báo lỗi trước đó
            errorMsg.style.display = 'none';
            errorMsgSize.style.display = 'none';

            if (file) {
                const videoType = file.type.startsWith('video/');
                if (!videoType) {
                    showErrorMsg(); // Hiển thị thông báo lỗi không phải video
                    return; // Dừng thực hiện nếu không phải video
                }

                if (file.size > MAX_SIZE) {
                    showErrorMsgSize(); // Hiển thị thông báo lỗi kích thước
                    return; // Dừng thực hiện nếu video vượt quá dung lượng
                }

                const videoName = document.getElementById('videoName');
                const videoSize = document.getElementById('videoSize');
                const videoDuration = document.getElementById('videoDuration');
                const videoFrame = document.getElementById('videoFrame');

                videoName.innerHTML = file.name;
                videoSize.innerHTML = (file.size / (1024 * 1024)).toFixed(2) + ' MB'; // Hiển thị kích thước video

                const url = URL.createObjectURL(file);
                videoFrame.src = url; // Cập nhật video player

                // Tạo đối tượng video để lấy thời lượng
                const videoElement = document.createElement('video');
                videoElement.src = url;
                videoElement.addEventListener('loadedmetadata', function() {
                    const duration = Math.floor(videoElement.duration);
                    const minutes = Math.floor(duration / 60);
                    const seconds = duration % 60;
                    videoDuration.innerHTML = minutes + ' phút ' + seconds + ' giây'; // Hiển thị thời lượng video
                });

                videoForm.style.display = "block"; // Hiển thị form khi video hợp lệ
            }
        }

        function showErrorMsg() {
            const errorMsg = document.getElementById("errorMsg");
            errorMsg.style.display = 'block';
            errorMsg.style.top = '10px';
            errorMsg.style.opacity = '1';

            setTimeout(() => {
                errorMsg.style.opacity = '0'; // Giảm độ mờ
                errorMsg.style.top = '-50px'; // Trượt lên ngoài màn hình
                setTimeout(() => {
                    errorMsg.style.display = 'none';
                }, 500); // Thời gian ẩn sau khi độ mờ giảm
            }, 3000); // Thời gian hiển thị thông báo
        }

        function showErrorMsgSize() {
            const errorMsgSize = document.getElementById("errorMsgSize");
            errorMsgSize.style.display = 'block';
            errorMsgSize.style.top = '10px';
            errorMsgSize.style.opacity = '1';

            setTimeout(() => {
                errorMsgSize.style.opacity = '0'; // Giảm độ mờ
                errorMsgSize.style.top = '-50px'; // Trượt lên ngoài màn hình
                setTimeout(() => {
                    errorMsgSize.style.display = 'none';
                }, 500); // Thời gian ẩn sau khi độ mờ giảm
            }, 3000); // Thời gian hiển thị thông báo
        }

        // Xử lý sự kiện kéo và thả
        const dropArea = document.getElementById('dropZone');

        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault(); // Ngăn mở tệp trong tab mới
        });

        dropArea.addEventListener('drop', (event) => {
            event.preventDefault(); // Ngăn mở tệp trong tab mới
            const files = event.dataTransfer.files;
            if (files.length) {
                document.getElementById('fileUpload').files = files; // Gán file cho input
                handleVideoChange({
                    target: {
                        files: files
                    }
                }); // Gọi hàm xử lý
            }
        });

        const videoForm = document.querySelector(".col-lg-12"); // Chọn phần tử chứa form
    </script>






    <script>
        window.onload = function() {
            const videoURL = sessionStorage.getItem('videoURL');
            const videoName = sessionStorage.getItem('videoName');
            const videoSize = sessionStorage.getItem('videoSize');
            const videoDuration = sessionStorage.getItem('videoDuration');

            // Kiểm tra các giá trị từ sessionStorage
            console.log('Video URL:', videoURL);
            console.log('Video Name:', videoName);
            console.log('Video Size:', videoSize);
            console.log('Video Duration:', videoDuration);

            if (videoURL) {
                // Trích xuất VIDEO_ID từ videoURL
                const videoIdMatch = videoURL.match(/\/d\/(.*?)(\/|$)/);
                const videoId = videoIdMatch ? videoIdMatch[1] : null;

                // Cập nhật iframe với VIDEO_ID
                if (videoId) {
                    const videoFrame = document.getElementById('videoFrame');
                    videoFrame.src = `https://drive.google.com/file/d/${videoId}/preview`; // Cập nhật đường dẫn iframe
                } else {
                    console.error('Không thể lấy VIDEO_ID từ URL.');
                }

                // Hiển thị thông tin video
                document.getElementById('videoName').querySelector('b').innerText = videoName || 'N/A';
                document.getElementById('videoSize').querySelector('b').innerText = (videoSize ? (videoSize / (1024 *
                    1024)).toFixed(2) + ' MB' : 'N/A');
                document.getElementById('videoDuration').querySelector('b').innerText = videoDuration ? videoDuration +
                    ' seconds' : '0 seconds';

                // Hiện video thông tin
                document.getElementById('videoInfo').style.display = 'block';
            } else {
                console.error('Không tìm thấy dữ liệu video trong session storage.');
            }
        }

        function handleVideoChange(event) {
            const file = event.target.files[0];
            if (file) {
                // Hiển thị tên video
                document.getElementById('videoName').querySelector('b').innerText = file.name;

                // Hiển thị dung lượng video (chuyển từ bytes sang MB)
                const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                document.getElementById('videoSize').querySelector('b').innerText = sizeInMB + ' MB';

                // Tính và hiển thị thời lượng video
                const video = document.createElement('video');
                video.src = URL.createObjectURL(file);
                video.addEventListener('loadedmetadata', function() {
                    const durationInSeconds = Math.floor(video.duration);
                    document.getElementById('videoDuration').querySelector('b').innerText = durationInSeconds +
                        ' seconds';
                });

                // Hiển thị video để xem trước
                const videoFrame = document.getElementById('videoFrame');
                videoFrame.src = URL.createObjectURL(file);
                videoFrame.load(); // Tải video mới vào thẻ video

                // Hiện phần thông tin video
                document.getElementById('videoInfo').style.display = 'block';
            } else {
                console.error('Không có tệp video nào được chọn.');
            }
        }
    </script>

    <style>
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(106, 106, 106, 0.618);
            border: 2px solid rgba(200, 200, 200, 0.5);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            pointer-events: none;
        }

        .loading-message {
            font-size: 20px;
            color: #333;
            pointer-events: auto;
        }

        .error-msg {
            position: fixed;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, -1, 0, 0.65);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            z-index: 1000;
            transition: top 0.5s ease, opacity 0.5s;
            opacity: 0;
        }

        #videoFrame {
            border-radius: 15px;
            /* Điều chỉnh giá trị theo ý muốn */
            overflow: hidden;
            /* Đảm bảo rằng các góc tròn không bị cắt */
        }

        textarea {
            border: 1px solid #ccc;
            padding: 10px;
            transition: border 0.3s ease;
            color: rgb(128, 128, 128);
        }

        textarea:focus {
            border: none;
            outline: none;
        }

        .error-msg {
            position: fixed;
            top: -50px;
            /* Đặt thông báo ra ngoài màn hình */
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, -1, 0, 0.65);
            /* Màu nền */
            color: white;
            /* Màu chữ */
            padding: 10px 20px;
            /* Khoảng cách bên trong */
            border-radius: 5px;
            /* Bo góc */
            z-index: 1000;
            /* Đảm bảo hiển thị trên các phần tử khác */
            transition: top 0.5s ease, opacity 0.5s;
            /* Hiệu ứng chuyển tiếp cho vị trí và độ mờ */
            opacity: 0;
            /* Bắt đầu với độ mờ 0 */
        }
    </style>
@endsection
