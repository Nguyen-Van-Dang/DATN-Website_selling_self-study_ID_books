<div class="">
    <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/7.14.3/video.min.js"></script>

    <!-- Phần chọn video -->
    <div class="iq-card iq-card-block iq-card-stretch iq-card-height" style="padding: 30px" id="dropZone">
        <!-- Vùng kéo và thả tệp -->
        <label for="fileUpload" style="display: flex; flex-direction: column; align-items: center; cursor: pointer; border: 2px dashed #ccc; padding: 100px 0;">
            <svg fill="currentColor" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" width="10%" height="10%">
                <path d="M25.84 37h8.66a9.5 9.5 0 0 0 1.35-18.9A12 12 0 0 0 12 20v.01A8.5 8.5 0 0 0 12.5 37h10.34V25.6l-1.72 1.74a1 1 0 0 1-1.42 0l-.7-.7a1 1 0 0 1 0-1.41l4.4-4.4c.68-.76 1.22-.77 2 .08l4.28 4.32a1 1 0 0 1 0 1.4l-.7.72a1 1 0 0 1-1.42 0l-1.72-1.75V37Z"></path>
            </svg>
            <div style="font-size: 18px; font-weight: bold;">Chọn video để tải lên</div>
            <div style="color: #777; margin-top: 5px;">Hoặc kéo và thả vào đây</div>
            <input type="file" id="fileUpload" style="display: none;" accept="video/*" onchange="handleVideoChange(event)" wire:model="reelsVideo">
            <label for="fileUpload" style="background-color: #ff4d6d; color: white; border: none; padding: 10px 20px; font-size: 14px; border-radius: 5px; cursor: pointer;">
                Chọn tệp
            </label>
        </label>
    </div>

    <!-- Phần upload video -->
    <div class="col-lg-12" id="videoContainer" style="display: none;">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <form wire:submit.prevent="submit" style="padding: 0">
                @csrf
                <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                    <div class="iq-header-title">
                        <h4 class="card-title mb-0">
                            <a><span id="videoName" style="padding-right: 20px"><b></b></span></a>
                        </h4>
                    </div>
                    <div class="iq-card-header-toolbar d-flex align-items-center">
                        <a href="#" class="btn btn-sm btn-primary view-more" onclick="document.getElementById('videoInput').click()">
                            <svg fill="currentColor" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em">
                                <path d="M24 8c4.06 0 7.76 1.5 10.58 4H29a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v4.8A20 20 0 0 0 4.14 26.34c.06.55.58.92 1.12.83l1.98-.34c.54-.09.9-.6.85-1.15A16 16 0 0 1 24 8Zm16 16c0-.57-.03-1.13-.09-1.68-.05-.55.31-1.06.85-1.15l1.98-.34a.96.96 0 0 1 1.12.83A20 20 0 0 1 11 39.2V44a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V33a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-5.58A16 16 0 0 0 40 24Z"></path>
                            </svg>
                            Thay thế
                        </a>
                        <input name="reelsVideo" wire:model="reelsVideo" type="file" id="videoInput" accept="video/*" style="display: none;" onchange="handleVideoChange(event)">
                    </div>
                </div>
                <div class="iq-card-body" style="border-bottom: 1px solid var(--iq-border-light);">
                    <a href="#" style="cursor: default; color: gray">Dung lượng: <span id="videoSize" style="padding-right: 20px"><b></b></span></a>
                    <a href="#" style="cursor: default; color: gray">Thời lượng: <span id="videoDuration"><b></b></span></a>
                </div>
                <div class="iq-card-body">
                    <div class="row" style="border-bottom: 1px solid var(--iq-border-light);">
                        <div class="col-8">
                            <p style="color: black">Mô tả</p>
                            <textarea id="title" cols="80" rows="5" wire:model="title" placeholder="Chia sẻ thêm về Video của bạn tại đây..." style="border-radius: 10px; border: none; background: rgba(0, 0, 0, 0.13); padding: 10px;"></textarea>
                            <div id="charCount" style="color: #00000075; margin-top: -30px; position: absolute; margin-left: 75%; font-size: 10px">0 ký tự/2000</div>
                            <p style="color: black">Ảnh bìa
                                <svg data-toggle="tooltip" data-placement="top" title="Chọn hoặc tải ảnh bìa lên từ thiết bị của bạn. Ảnh bìa đẹp có thể thu hút sự quan tâm của người xem một cách hiệu quả." fill="rgba(0,0,0,0.48)" height="1em" width="1em" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 6a18 18 0 1 0 0 36 18 18 0 0 0 0-36ZM2 24a22 22 0 1 1 44 0 22 22 0 0 1-44 0Zm25-8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-4 6a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V23a1 1 0 0 0-1-1h-2Z"></path>
                                </svg>
                            </p>
                            <br>
                            <div class="custom-file">
                                <img id="image-placeholder" src="{{ asset('assets/images/book/user/thub.jpg') }}" alt="Click to choose image" class="img-thumbnail" style="cursor: pointer; width: 100%; max-width: 140px;">
                                <input type="file" class="custom-file-input" accept="image/png, image/jpeg, image/jpg" wire:model="reelsImg" id="image-input" style="display: none;">
                            </div>
                        </div>
                        <div class="col-4 text-center">
                            <p style="color: black">Xem trước</p>
                            <video id="videoFrame" controls width="100%" height="600" wire:model="reelsVideo"></video>
                        </div>
                    </div>

                    <div class="iq-card-body">
                        <button type="submit" class="btn btn-primary" style="width: 100%" id="submitBtn" disabled>Đăng video</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
