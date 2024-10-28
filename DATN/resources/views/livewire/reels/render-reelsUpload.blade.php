<div class="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="iq-card iq-card-block iq-card-stretch iq-card-height" style="padding: 30px">
        <!-- Vùng kéo và thả tệp -->
        <label for="fileUpload"
            style="display: flex; flex-direction: column; align-items: center; cursor: pointer; border: 2px dashed #ccc; padding: 100px 0;"
            id="dropZone">
            <svg fill="currentColor" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" width="10%" height="10%">
                <path
                    d="M25.84 37h8.66a9.5 9.5 0 0 0 1.35-18.9A12 12 0 0 0 12 20v.01A8.5 8.5 0 0 0 12.5 37h10.34V25.6l-1.72 1.74a1 1 0 0 1-1.42 0l-.7-.7a1 1 0 0 1 0-1.41l4.4-4.4c.68-.76 1.22-.77 2 .08l4.28 4.32a1 1 0 0 1 0 1.4l-.7.72a1 1 0 0 1-1.42 0l-1.72-1.75V37Z">
                </path>
            </svg>
            <div style="font-size: 18px; font-weight: bold;">Chọn video để tải lên</div>
            <div style="color: #777; margin-top: 5px;">Hoặc kéo và thả vào đây</div>
            <input type="file" id="fileUpload" style="display: none;" accept="video/*" onchange="validateFileType()">
            <label for="fileUpload"
                style="background-color: #ff4d6d; color: white; border: none; padding: 10px 20px; font-size: 14px; border-radius: 5px; cursor: pointer;">
                Chọn tệp
            </label>
        </label>
        <!-- Phần icon -->
        <div style="display: flex; justify-content: space-around; margin-top: 20px; font-size: 14px; color: #444;">
            <div class="row">
                <div class="col-3">
                    <div style="text-align: center;">
                        <div style="font-weight: bold;">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjUiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNSAyNCIgZmlsbD0ibm9uZSIKICB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgogIDxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBkPSJNMTggOS42MDQ4OUwyMi41OTE1IDYuNDYzNDVDMjMuMTg4OSA2LjA1NDc2IDIzLjk5OTggNi40ODI0OCAyMy45OTk4IDcuMjA2MjNWMTYuNzkzNkMyMy45OTk4IDE3LjUxNzQgMjMuMTg4OSAxNy45NDUxIDIyLjU5MTUgMTcuNTM2NEwxOC4wMDAyIDE0LjM5NUwxOC4wMDAxIDEyLjAwMDNMMjEuOTk5NSAxNC43MDg1VjkuMjkxOTlMMTguMDAwMSAxMi4wMDAzTDE4IDkuNjA0ODlaIiBmaWxsPSJibGFjayIgZmlsbC1vcGFjaXR5PSIwLjMyIi8+CiAgPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xIDYuNUMxIDQuODQzMTUgMi4zNDMxNSAzLjUgNCAzLjVIMTVDMTYuNjU2OSAzLjUgMTggNC44NDMxNSAxOCA2LjVWMTcuNUMxOCAxOS4xNTY5IDE2LjY1NjkgMjAuNSAxNSAyMC41SDRDMi4zNDMxNSAyMC41IDEgMTkuMTU2OSAxIDE3LjVWNi41Wk00IDUuNUgxNUMxNS41NTIzIDUuNSAxNiA1Ljk0NzcyIDE2IDYuNVYxNy41QzE2IDE4LjA1MjMgMTUuNTUyMyAxOC41IDE1IDE4LjVINEMzLjQ0NzcyIDE4LjUgMyAxOC4wNTIzIDMgMTcuNVY2LjVDMyA1Ljk0NzcyIDMuNDQ3NzIgNS41IDQgNS41WiIgZmlsbD0iYmxhY2siIGZpbGwtb3BhY2l0eT0iMC4zMiIvPgo8L3N2Zz4K"
                                alt="Dung lượng và thời lượng" class="jsx-399202212">
                            Dung lượng và thời lượng
                        </div>
                        <div style="color: #777;">Dung lượng tối đa: 1GB, thời lượng video: 60 phút.</div>
                    </div>
                </div>
                <div class="col-3">
                    <div style="text-align: center;">
                        <div style="font-weight: bold;">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjUiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNSAyNCIgZmlsbD0ibm9uZSIKICB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgogIDxwYXRoIGQ9Ik02IDRDNS43MjM4NiA0IDUuNSA0LjIyMzg2IDUuNSA0LjVWMTkuNUM1LjUgMTkuNzc2MSA1LjcyMzg2IDIwIDYgMjBIMTlDMTkuMjc2MSAyMCAxOS41IDE5Ljc3NjEgMTkuNSAxOS41VjEwSDE0QzEzLjQ0NzcgMTAgMTMgOS41NTIyOCAxMyA5VjRINlpNMTUgNS4yODM5OFY4SDE3Ljk0MjNMMTUgNS4yODM5OFpNMy41IDQuNUMzLjUgMy4xMTkyOSA0LjYxOTI5IDIgNiAySDE0QzE0LjI1MTQgMiAxNC40OTM2IDIuMDk0NjggMTQuNjc4MyAyLjI2NTJMMjEuMTc4MyA4LjI2NTJDMjEuMzgzNCA4LjQ1NDUgMjEuNSA4LjcyMDkgMjEuNSA5VjE5LjVDMjEuNSAyMC44ODA3IDIwLjM4MDcgMjIgMTkgMjJINkM0LjYxOTI5IDIyIDMuNSAyMC44ODA3IDMuNSAxOS41VjQuNVoiIGZpbGw9ImJsYWNrIiBmaWxsLW9wYWNpdHk9IjAuMzIiLz4KICA8cGF0aCBkPSJNMTQuNzgyNiAxMy40NDM2QzE1LjA3MjUgMTMuNjExIDE1LjA3MjUgMTQuMDI5MyAxNC43ODI2IDE0LjE5NjdMMTAuNjUyMiAxNi41ODE0QzEwLjM2MjMgMTYuNzQ4NyAxMCAxNi41Mzk1IDEwIDE2LjIwNDhWMTEuNDM1NEMxMCAxMS4xMDA3IDEwLjM2MjMgMTAuODkxNiAxMC42NTIyIDExLjA1ODlMMTQuNzgyNiAxMy40NDM2WiIgZmlsbD0iYmxhY2siIGZpbGwtb3BhY2l0eT0iMC4zMiIvPgo8L3N2Zz4K"
                                alt="Định dạng tập tin" class="jsx-399202212">
                            Định dạng tập tin
                        </div>
                        <div style="color: #777;">Đề xuất: ".mp4". Có hỗ trợ các định dạng khác.</div>
                    </div>
                </div>
                <div class="col-3">
                    <div style="text-align: center;">
                        <div style="font-weight: bold;">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjUiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNSAyNCIgZmlsbD0ibm9uZSIKICB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgogIDxwYXRoIGQ9Ik00IDJDMi42MTkyOSAyIDEuNSAzLjExOTI5IDEuNSA0LjVWMTkuNUMxLjUgMjAuODgwNyAyLjYxOTI5IDIyIDQgMjJIMjFDMjIuMzgwNyAyMiAyMy41IDIwLjg4MDcgMjMuNSAxOS41VjQuNUMyMy41IDMuMTE5MjkgMjIuMzgwNyAyIDIxIDJINFpNMy41IDQuNUMzLjUgNC4yMjM4NiAzLjcyMzg2IDQgNCA0SDIxQzIxLjI3NjEgNCAyMS41IDQuMjIzODYgMjEuNSA0LjVWMTkuNUMyMS41IDE5Ljc3NjEgMjEuMjc2MSAyMCAyMSAyMEg0QzMuNzIzODYgMjAgMy41IDE5Ljc3NjEgMy41IDE5LjVWNC41WiIgZmlsbD0iYmxhY2siIGZpbGwtb3BhY2l0eT0iMC4zMiIvPgogIDxwYXRoIGQ9Ik02LjcwMDk0IDE1LjA5NzdDNi4yMjQzNyAxNS4wOTc3IDUuOTQzMTIgMTQuNzkzIDUuOTQzMTIgMTQuNDI1OEM1Ljk0MzEyIDE0LjIyNjYgNS45OSAxNC4wNzQyIDYuMDgzNzUgMTMuOTA2Mkw3Ljg4ODQ0IDEwLjY0NDVWMTAuNjEzM0g1Ljc3MTI1QzUuMzk2MjUgMTAuNjEzMyA1LjEyNjcyIDEwLjM1OTQgNS4xMjY3MiA5Ljk4NDM4QzUuMTI2NzIgOS42MDkzOCA1LjM5NjI1IDkuMzYzMjggNS43NzEyNSA5LjM2MzI4SDguNTc1OTRDOS4xMTEwOSA5LjM2MzI4IDkuNTM2ODcgOS42OTUzMSA5LjUzNjg3IDEwLjIzMDVDOS41MzY4NyAxMC41MTk1IDkuNDQ3MDMgMTAuNzg1MiA5LjI0MzkxIDExLjE3MTlMNy40MzkyMiAxNC42MDk0QzcuMjUxNzIgMTQuOTY4OCA3LjA1NjQxIDE1LjA5NzcgNi43MDA5NCAxNS4wOTc3Wk0xMC42NDA2IDE1QzEwLjEwMTYgMTUgOS44NjcxOSAxNC42OTkyIDkuODY3MTkgMTQuMjg1MkM5Ljg2NzE5IDEzLjk4MDUgMTAuMDA3OCAxMy43NDYxIDEwLjMyMDMgMTMuNDg0NEwxMS44NzExIDEyLjE1NjJDMTIuNTAzOSAxMS42MTMzIDEyLjY4MzYgMTEuMzY3MiAxMi42ODM2IDExLjAzMTJDMTIuNjgzNiAxMC42NzU4IDEyLjQxMDIgMTAuNDI5NyAxMi4wMDc4IDEwLjQyOTdDMTEuNzEwOSAxMC40Mjk3IDExLjUwNzggMTAuNTY2NCAxMS4yOTY5IDEwLjg3MTFDMTEuMDc4MSAxMS4xOTE0IDEwLjg3ODkgMTEuMzA4NiAxMC41NjI1IDExLjMwODZDMTAuMTQwNiAxMS4zMDg2IDkuODgyODEgMTEuMDYyNSA5Ljg4MjgxIDEwLjY2NDFDOS44ODI4MSAxMC41MzUyIDkuOTA2MjUgMTAuNDE0MSA5Ljk1NzAzIDEwLjI5NjlDMTAuMjUzOSA5LjYyNSAxMS4wNDY5IDkuMjA3MDMgMTIuMDMxMiA5LjIwNzAzQzEzLjQwMjMgOS4yMDcwMyAxNC4yNzczIDkuODk4NDQgMTQuMjc3MyAxMC45MjE5QzE0LjI3NzMgMTEuNjc5NyAxMy44ODY3IDEyLjA3NDIgMTMuMDExNyAxMi44MzJMMTEuOTg0NCAxMy43MTg4VjEzLjc1SDEzLjc3MzRDMTQuMTg3NSAxMy43NSAxNC40MjE5IDEzLjk5NjEgMTQuNDIxOSAxNC4zNzVDMTQuNDIxOSAxNC43NDYxIDE0LjE4NzUgMTUgMTMuNzczNCAxNUgxMC42NDA2Wk0xNy4xOTM2IDE1LjE1NjJDMTUuNjQ2NyAxNS4xNTYyIDE0LjY3MDIgMTQuMDMxMiAxNC42NzAyIDEyLjE2OEMxNC42NzAyIDEwLjI5MyAxNS42NTg0IDkuMjAzMTIgMTcuMTkzNiA5LjIwMzEyQzE4LjcyODggOS4yMDMxMiAxOS43MTMxIDEwLjI4OTEgMTkuNzEzMSAxMi4xNjQxQzE5LjcxMzEgMTQuMDIzNCAxOC43NDA1IDE1LjE1NjIgMTcuMTkzNiAxNS4xNTYyWk0xNy4xOTM2IDEzLjg4MjhDMTcuNzAxNCAxMy44ODI4IDE4LjAyNTYgMTMuMzQ3NyAxOC4wMjU2IDEyLjE2OEMxOC4wMjU2IDEwLjk4NDQgMTcuNzAxNCAxMC40NzY2IDE3LjE5MzYgMTAuNDc2NkMxNi42ODU4IDEwLjQ3NjYgMTYuMzU3NyAxMC45ODQ0IDE2LjM1NzcgMTIuMTY4QzE2LjM1NzcgMTMuMzQ3NyAxNi42ODU4IDEzLjg4MjggMTcuMTkzNiAxMy44ODI4WiIgZmlsbD0iYmxhY2siIGZpbGwtb3BhY2l0eT0iMC4zMiIvPgo8L3N2Zz4K"
                                alt="Độ phân giải video" class="jsx-399202212">
                            Độ phân giải video
                        </div>
                        <div style="color: #777;">Độ phân giải tối thiểu: 720p. Có hỗ trợ 2K và 4K.</div>
                    </div>
                </div>
                <div class="col-3">
                    <div style="text-align: center;">
                        <div style="font-weight: bold;">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjUiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNSAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTguNSA3LjVMMTcgNy41TDE3IDE2SDguNVY3LjVaTTYuNSA3LjVMNi40OTk5OSAxNi4yMjMxQzYuNDk5OTUgMTYuMzQyMyA2LjQ5OTg5IDE2LjQ4NDUgNi41MTAxMyAxNi42MDk4QzYuNTIyIDE2Ljc1NSA2LjU1MjQ0IDE2Ljk2MyA2LjY2MzQ5IDE3LjE4MUM2LjgwNzMgMTcuNDYzMiA3LjAzNjc3IDE3LjY5MjcgNy4zMTkwMSAxNy44MzY1QzcuNTM2OTYgMTcuOTQ3NiA3Ljc0NDk1IDE3Ljk3OCA3Ljg5MDE3IDE3Ljk4OTlDOC4wMTU0NSAxOC4wMDAxIDguMTU3NjUgMTguMDAwMSA4LjI3Njc1IDE4TDE3IDE4VjIxLjJDMTcgMjEuNDggMTcgMjEuNjIgMTcuMDU0NSAyMS43MjdDMTcuMTAyNCAyMS44MjExIDE3LjE3ODkgMjEuODk3NiAxNy4yNzMgMjEuOTQ1NUMxNy4zOCAyMiAxNy41MiAyMiAxNy44IDIySDE4LjJDMTguNDggMjIgMTguNjIgMjIgMTguNzI3IDIxLjk0NTVDMTguODIxMSAyMS44OTc2IDE4Ljg5NzYgMjEuODIxMSAxOC45NDU1IDIxLjcyN0MxOSAyMS42MiAxOSAyMS40OCAxOSAyMS4yVjE4SDIxLjdDMjEuOTggMTggMjIuMTIgMTggMjIuMjI3IDE3Ljk0NTVDMjIuMzIxMSAxNy44OTc2IDIyLjM5NzYgMTcuODIxMSAyMi40NDU1IDE3LjcyN0MyMi41IDE3LjYyIDIyLjUgMTcuNDggMjIuNSAxNy4yVjE2LjhDMjIuNSAxNi41MiAyMi41IDE2LjM4IDIyLjQ0NTUgMTYuMjczQzIyLjM5NzYgMTYuMTc4OSAyMi4zMjExIDE2LjEwMjQgMjIuMjI3IDE2LjA1NDVDMjIuMTIgMTYgMjEuOTggMTYgMjEuNyAxNkgxOUwxOSA3LjI3Njg2QzE5LjAwMDEgNy4xNTc3NSAxOS4wMDAxIDcuMDE1NDggMTguOTg5OSA2Ljg5MDE3QzE4Ljk3OCA2Ljc0NDk1IDE4Ljk0NzYgNi41MzY5NiAxOC44MzY1IDYuMzE5MDFDMTguNjkyNyA2LjAzNjc3IDE4LjQ2MzIgNS44MDczIDE4LjE4MSA1LjY2MzQ5QzE3Ljk2MyA1LjU1MjQ0IDE3Ljc1NSA1LjUyMiAxNy42MDk4IDUuNTEwMTNDMTcuNDg0NiA1LjQ5OTkgMTcuMzQyMyA1LjQ5OTk1IDE3LjIyMzMgNS40OTk5OUw4LjUgNS41VjIuOEM4LjUgMi41MTk5NyA4LjUgMi4zNzk5NiA4LjQ0NTUgMi4yNzNDOC4zOTc1NyAyLjE3ODkyIDguMzIxMDggMi4xMDI0MyA4LjIyNjk5IDIuMDU0NUM4LjEyMDA0IDIgNy45ODAwMyAyIDcuNyAySDcuM0M3LjAxOTk3IDIgNi44Nzk5NiAyIDYuNzczIDIuMDU0NUM2LjY3ODkyIDIuMTAyNDMgNi42MDI0MyAyLjE3ODkyIDYuNTU0NSAyLjI3M0M2LjUgMi4zNzk5NiA2LjUgMi41MTk5NyA2LjUgMi44VjUuNUwzLjMgNS41QzMuMDE5OTcgNS41IDIuODc5OTYgNS41IDIuNzczIDUuNTU0NUMyLjY3ODkyIDUuNjAyNDMgMi42MDI0MyA1LjY3ODkyIDIuNTU0NSA1Ljc3M0MyLjUgNS44Nzk5NiAyLjUgNi4wMTk5NyAyLjUgNi4zVjYuN0MyLjUgNi45ODAwMyAyLjUgNy4xMjAwNCAyLjU1NDUgNy4yMjY5OUMyLjYwMjQzIDcuMzIxMDcgMi42Nzg5MiA3LjM5NzU2IDIuNzczIDcuNDQ1NUMyLjg3OTk2IDcuNSAzLjAxOTk3IDcuNSAzLjMgNy41TDYuNSA3LjVaIiBmaWxsPSJibGFjayIgZmlsbC1vcGFjaXR5PSIwLjMyIi8+Cjwvc3ZnPgo="
                                alt="Tỷ lệ khung hình" class="jsx-399202212">
                            Tỷ lệ khung hình
                        </div>
                        <div style="color: #777;">Đề xuất: 16:9 cho chế độ ngang, 9:16 cho chế độ dọc.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Thông báo lỗi -->
    <div id="errorMsg" class="error-msg">Chỉ cho phép tải video lên</div>
    <div id="errorMsgSize" class="error-msg">Chỉ cho phép tải video dưới 1GB!</div>
    <!-- Overlay loading icon -->
    <div id="loadingOverlay" class="loading-overlay" style="display: none;">
        <div class="loading-message"
            style="width: 50px; height: 50px; border: 5px solid #f3f3f3; border-radius: 50%; border-top: 5px solid #3498db; animation: spin 1s linear infinite;">
        </div>
    </div>

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
    </style>
    <script>
        document.getElementById('fileUpload').addEventListener('change', async function() {
            const file = this.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (file) {
                // Hiện overlay loading
                document.getElementById('loadingOverlay').style.display = 'flex';

                const formData = new FormData();
                formData.append('video', file);

                try {
                    const response = await fetch('/reelsUpload', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: formData,
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();

                    if (data.videoURL) {
                        // Lưu thông tin video vào sessionStorage
                        sessionStorage.setItem('videoURL', data.videoURL);
                        sessionStorage.setItem('videoName', file.name); // Lưu tên video
                        sessionStorage.setItem('videoSize', file.size); // Lưu dung lượng video

                        // Tạo URL tạm thời cho video đã tải lên
                        const tempVideoURL = URL.createObjectURL(file);
                        const videoElement = document.createElement('video');
                        videoElement.src = tempVideoURL;

                        // Lắng nghe sự kiện loadedmetadata để lấy độ dài video
                        videoElement.addEventListener('loadedmetadata', function() {
                            const duration = Math.floor(this.duration); // Lấy độ dài video
                            sessionStorage.setItem('videoDuration', duration); // Lưu vào sessionStorage

                            // Chuyển hướng đến trang reelsUpload1
                            window.location.href = 'http://127.0.0.1:8000/reelsUpload1';
                        });

                        // Kích hoạt video để lấy metadata
                        videoElement.play();
                    } else {
                        console.error('No video URL returned from server.');
                    }
                } catch (error) {
                    console.error('Error uploading video:', error);
                } finally {
                    // Ẩn overlay loading sau khi tải lên hoàn tất (thành công hoặc thất bại)
                    document.getElementById('loadingOverlay').style.display = 'none';
                }
            } else {
                console.error('No file selected for upload');
            }
        });
    </script>
    
    <script>
        const dropZone = document.getElementById("dropZone");
        const errorMsg = document.getElementById("errorMsg");
        const errorMsgSze = document.getElementById("errorMsgSize"); // Đảm bảo tên ID đúng
        const MAX_SIZE = 1 * 1024 * 1024 * 1024; // 1GB
    
        // Ngăn hành vi mặc định khi kéo và thả vào khu vực tải lên
        dropZone.addEventListener("dragover", (event) => {
            event.preventDefault();
            dropZone.style.borderColor = "#00aaff"; // Đổi màu viền khi kéo vào
        });
    
        dropZone.addEventListener("dragleave", () => {
            dropZone.style.borderColor = "#ccc"; // Trả lại màu viền ban đầu khi rời đi
        });
    
        dropZone.addEventListener("drop", (event) => {
            event.preventDefault(); // Ngăn mở tệp trong tab mới
    
            const file = event.dataTransfer.files[0];
            if (file) {
                if (!file.type.startsWith("video/")) {
                    showErrorMsg(); // Hiển thị thông báo lỗi nếu không phải video
                } else if (file.size > MAX_SIZE) {
                    showErrorMsgSize(); // Hiển thị thông báo lỗi nếu video vượt quá dung lượng
                } else {
                    document.getElementById("fileUpload").files = event.dataTransfer.files; // Gán tệp cho input nếu là video
                }
            }
        });
    
        function validateFileType() {
            const fileInput = document.getElementById("fileUpload");
            const file = fileInput.files[0];
    
            if (file) {
                if (!file.type.startsWith("video/")) {
                    showErrorMsg(); // Hiển thị thông báo lỗi nếu không phải video
                    fileInput.value = ""; // Xóa tệp nếu không phải là video
                } else if (file.size > MAX_SIZE) {
                    showErrorMsgSize(); // Hiển thị thông báo lỗi nếu video vượt quá dung lượng
                    fileInput.value = ""; // Xóa tệp nếu vượt quá dung lượng
                }
            }
        }
    
        function showErrorMsg() {
            errorMsg.style.display = 'block';
            errorMsg.style.top = '10px';
            errorMsg.style.opacity = '1';
    
            // Tự động ẩn thông báo sau 3 giây
            setTimeout(() => {
                errorMsg.style.opacity = '0'; // Giảm độ mờ
                errorMsg.style.top = '-50px'; // Trượt lên ngoài màn hình
                setTimeout(() => {
                    errorMsg.style.display = 'none';
                }, 500); // Thời gian ẩn sau khi độ mờ giảm
            }, 3000); // Thời gian hiển thị thông báo
        }
    
        function showErrorMsgSize() {
            errorMsgSze.style.display = 'block';
            errorMsgSze.style.top = '10px';
            errorMsgSze.style.opacity = '1';
    
            // Tự động ẩn thông báo sau 3 giây
            setTimeout(() => {
                errorMsgSze.style.opacity = '0'; // Giảm độ mờ
                errorMsgSze.style.top = '-50px'; // Trượt lên ngoài màn hình
                setTimeout(() => {
                    errorMsgSze.style.display = 'none';
                }, 500); // Thời gian ẩn sau khi độ mờ giảm
            }, 3000); // Thời gian hiển thị thông báo
        }
    </script>
    
</div>
