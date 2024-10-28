<div class="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/7.14.3/video.min.js"></script>
    <div class="col-lg-12">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <form method="post" enctype="multipart/form-data" action="{{ route('reelsUpload1') }}" style="padding: 0">
                @csrf
                <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                    <div class="iq-header-title">
                        <h4 class="card-title mb-0">
                            <a><span id="videoName" style="padding-right: 20px"><b></b></span></a>
                        </h4>
                    </div>
                    <div class="iq-card-header-toolbar d-flex align-items-center">
                        <a href="#" class="btn btn-sm btn-primary view-more"
                            onclick="document.getElementById('videoInput').click()">
                            <svg fill="currentColor" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"
                                width="1em" height="1em">
                                <path
                                    d="M24 8c4.06 0 7.76 1.5 10.58 4H29a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v4.8A20 20 0 0 0 4.14 26.34c.06.55.58.92 1.12.83l1.98-.34c.54-.09.9-.6.85-1.15A16 16 0 0 1 24 8Zm16 16c0-.57-.03-1.13-.09-1.68-.05-.55.31-1.06.85-1.15l1.98-.34a.96.96 0 0 1 1.12.83A20 20 0 0 1 11 39.2V44a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V33a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-5.58A16 16 0 0 0 40 24Z">
                                </path>
                            </svg>
                            Thay thế
                        </a>
                        <input name="video_url" type="file" id="videoInput" accept="video/*" style="display: none;"
                            onchange="handleVideoChange(event)">
                    </div>
                </div>
                <div class="iq-card-body" style="border-bottom: 1px solid var(--iq-border-light);">
                    <a href="#" style="cursor: default; color: gray">Dung lượng: <span id="videoSize"
                            style="padding-right: 20px"><b></b></span></a>
                    <a href="#" style="cursor: default; color: gray">Thời lượng: <span
                            id="videoDuration"><b></b></span></a>
                </div>
                <div class="iq-card-body">
                    <div class="row" style="border-bottom: 1px solid var(--iq-border-light);">
                        <div class="col-8">
                            <p style="color: black">Mô tả</p>
                            <textarea id="description" name="title" cols="80" rows="5"
                                placeholder="Chia sẻ thêm về Video của bạn tại đây..."
                                style="border-radius: 10px; border: none; background: rgba(0, 0, 0, 0.13); padding: 10px;"></textarea>
                            <div id="charCount"
                                style="color: #00000075; margin-top: -30px; position: absolute; margin-left: 75%; font-size: 10px">
                                0 ký tự/2000
                            </div>
                            <p style="color: black">
                                Ảnh bìa
                                <svg data-toggle="tooltip" data-placement="top"
                                    title="Chọn hoặc tải ảnh bìa lên từ thiết bị của bạn. Ảnh bìa đẹp có thể thu hút sự quan tâm của người xem một cách hiệu quả."
                                    fill="rgba(0,0,0,0.48)" height="1em" width="1em" viewBox="0 0 48 48"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M24 6a18 18 0 1 0 0 36 18 18 0 0 0 0-36ZM2 24a22 22 0 1 1 44 0 22 22 0 0 1-44 0Zm25-8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-4 6a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V23a1 1 0 0 0-1-1h-2Z">
                                    </path>
                                </svg>
                            </p>
                            <button id="selectImageButton" class="btn btn-sm btn-primary view-more">
                                Chọn ảnh
                            </button>
                            <input type="file" name="thumbnail" id="cover" accept="image/*"
                                style="display: none;" required>
                            <div id="preview" style="margin-top: 10px;"></div>
                        </div>
                        <div class="col-4 text-center">
                            <p style="color: black">Xem trước</p>
                            <video id="videoFrame" controls width="100%" height="600"></video>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <button type="submit"
                            style="width: 90px; height: 35px; border: none; color: white; background: #11e1c2; border-radius: 5px;">
                            Đăng
                        </button>
                        <button id="cancelButton"
                            style="width: 90px; height: 35px; border: none; color: black; background-color: #0000000e; border-radius: 5px;">
                            Hủy bỏ
                        </button>
                    </div>

                    <!-- Popup xác nhận -->
                    <div id="confirmPopup"
                        style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; border: 1px solid #ccc; border-radius: 5px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); z-index: 1000;">
                        <p>Bạn có chắc chắn muốn hủy bỏ không?</p>
                        <div class="text-center">
                            <button id="yesButton" type="submit"
                                style="width: 90px; height: 35px; border: none; color: white; background: #11e1c2; border-radius: 5px;">
                                <a href="{{ route('reelsUpload') }}" class="xn" style="color:white;">Xác nhận</a>
                            </button>
                            <button id="noButton"
                                style="width: 90px; height: 35px; border: none; color: black; background-color: #0000000e; border-radius: 5px;">
                                Trở về
                            </button>
                        </div>
                    </div>

                    <!-- Màn che -->
                    <div id="overlay"
                        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 999;">
                    </div>
                    <div id="errorMsg" class="error-msg">Vượt quá 2000 ký tự!</div>
                </div>
            </form>
        </div>
    </div>

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
                document.getElementById('videoName').querySelector('b').innerText = videoName;

                // Chuyển đổi dung lượng từ bytes sang MB
                if (videoSize) {
                    const sizeInMB = (videoSize / (1024 * 1024)).toFixed(
                        2); // Chuyển đổi và làm tròn đến 2 chữ số thập phân
                    document.getElementById('videoSize').querySelector('b').innerText = sizeInMB + ' MB';
                } else {
                    document.getElementById('videoSize').querySelector('b').innerText = 'N/A';
                }

                // Hiển thị độ dài video
                if (videoDuration) {
                    document.getElementById('videoDuration').querySelector('b').innerText = videoDuration + ' seconds';
                } else {
                    document.getElementById('videoDuration').querySelector('b').innerText =
                        '0 seconds'; // Nếu là undefined thì mặc định là '0 seconds'
                }
            } else {
                console.error('No video data found in session storage.');
            }
        }
    </script>

    <script>
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
            }
        }
    </script>

    <style>
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
</div>
