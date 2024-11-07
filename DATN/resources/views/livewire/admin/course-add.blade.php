<div>
    <div class="row">
        <div class="col-sm-6">
            <div class="iq-card modal-content">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Thêm khóa học</h4>
                    </div>
                </div>
                <div class="iq-card-body modal-body-scrollable">
                    <div class="form-group">
                        <label>Tên khóa học:</label>
                        <input wire:model="courseName" type="text" class="form-control"
                            placeholder="Nhập tên khóa học...">
                    </div>
                    <div class="form-group">
                        <label>Mô tả khóa học:</label>
                        <textarea wire:model="description" class="form-control" rows="2" placeholder="Nhập mô tả..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Chọn ảnh khóa học:</label>
                        <div class="custom-file" wire:ignore>
                            <input wire:model="courseImage" type="file" class="custom-file-input" id="imageInput"
                                onchange="showImagePreview(event)">
                            <label class="custom-file-label" for="imageInput" id="imageLabel">Chọn file</label>
                        </div>
                        <!-- Hiển thị hình ảnh thu nhỏ -->
                        <div id="imagePreview" style="margin-top: 10px;" wire:ignore>
                            <!-- Ảnh thu nhỏ sẽ xuất hiện ở đây sau khi chọn -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Chọn khóa học PDF:</label>
                        <div class="custom-file" wire:ignore>
                            <input wire:model="documentFile" type="file" class="custom-file-input" id="pdfInput"
                                onchange="showPDFName(event)">
                            <label class="custom-file-label" for="pdfInput" id="pdfLabel">Chọn file</label>
                        </div>
                    </div>
                    <script>
                        function showImagePreview(event) {
                            // Hiển thị tên file ảnh
                            let fileName = event.target.files[0].name;
                            document.getElementById('imageLabel').innerHTML = fileName;

                            // Tạo hình ảnh thu nhỏ
                            let reader = new FileReader();
                            reader.onload = function(e) {
                                let imagePreview = document.getElementById('imagePreview');
                                imagePreview.innerHTML =
                                    `<img src="${e.target.result}" alt="Thumbnail" style="max-width: 100px; max-height: 100px;"/>`;
                            };
                            reader.readAsDataURL(event.target.files[0]);
                        }

                        function showPDFName(event) {
                            // Hiển thị tên file PDF
                            let fileName = event.target.files[0].name;
                            document.getElementById('pdfLabel').innerHTML = fileName;
                        }
                    </script>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Giá khóa học:</label>
                            <input wire:model="price" type="number" class="form-control"
                                placeholder="Nhập giá khóa học...">
                        </div>
                        <div class="col-md-6">
                            <label>Giảm giá:</label>
                            <input wire:model="discount" type="number" class="form-control"
                                placeholder="Nhập giá giảm khóa học...">
                        </div>
                    </div>
                    <button wire:click="storeCourse" class="btn btn-primary">Gửi</button>
                    <button type="reset" class="btn btn-danger">Trở lại</button>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="iq-card modal-content">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Thêm chương bài giảng</h4>
                    </div>
                </div>
                <div class="iq-card-body modal-body-scrollable">
                    <div id="chapterContainer" wire:ignore>
                        <!-- Nơi sẽ thêm các chương -->
                    </div>
                    <div class="d-flex align-items-center">
                        <span id="addChapterButton" class="btn btn-primary" style="cursor:pointer;">Thêm chương</span>
                    </div>
                </div>
            </div>
            <script>
                document.getElementById('addChapterButton').addEventListener('click', function() {
                    const chapterIndex = document.querySelectorAll('#chapterContainer .chapter').length;
                    const chapterDiv = document.createElement('div');
                    chapterDiv.classList.add('form-group', 'mt-3', 'chapter');

                    const chapterInputContainer = document.createElement('div');
                    chapterInputContainer.classList.add('d-flex', 'align-items-center');

                    const chapterInput = document.createElement('input');
                    chapterInput.type = 'text';
                    chapterInput.classList.add('form-control');
                    chapterInput.placeholder = 'Nhập tên chương...';
                    chapterInput.setAttribute('wire:model.defer', `lectureCategories.${chapterIndex}`);
                    chapterInput.style.width = '70%';

                    const addLectureButton = document.createElement('span');
                    addLectureButton.classList.add('btn', 'btn-success', 'ml-2');
                    addLectureButton.style.cursor = 'pointer';
                    addLectureButton.textContent = '+ Thêm';

                    const deleteChapterButton = document.createElement('span');
                    deleteChapterButton.classList.add('btn', 'btn-danger', 'ml-2');
                    deleteChapterButton.style.cursor = 'pointer';
                    deleteChapterButton.textContent = '- Xóa';

                    deleteChapterButton.addEventListener('click', function() {
                        chapterDiv.remove();
                    });

                    addLectureButton.addEventListener('click', function() {
                        const lectureIndex = chapterDiv.querySelectorAll('.lecture').length;
                        const lectureDiv = document.createElement('div');
                        lectureDiv.classList.add('lecture');
                        lectureDiv.style.marginLeft = '20px';
                        lectureDiv.style.marginTop = '10px';

                        const lectureInput = document.createElement('input');
                        lectureInput.type = 'text';
                        lectureInput.classList.add('form-control');
                        lectureInput.placeholder = 'Nhập tên bài giảng...';
                        lectureInput.setAttribute('wire:model.defer', `lectures.${chapterIndex}.${lectureIndex}`);

                        const videoInput = document.createElement('div');
                        videoInput.classList.add('custom-file', 'mt-2');
                        videoInput.setAttribute('wire:ignore', ''); // Ngăn Livewire xử lý lại video input

                        const videoFileInput = document.createElement('input');
                        videoFileInput.type = 'file';
                        videoFileInput.classList.add('custom-file-input');
                        videoFileInput.accept = 'video/mp4, video/avi, video/mov';
                        videoFileInput.setAttribute('multiple', ''); // Thêm thuộc tính multiple để chọn nhiều tệp
                        videoFileInput.setAttribute('wire:model.defer',
                            `lectureVideo.${chapterIndex}.${lectureIndex}`);

                        const videoLabel = document.createElement('label');
                        videoLabel.classList.add('custom-file-label');
                        videoLabel.textContent = 'Chọn video';

                        videoFileInput.addEventListener('change', function() {
                            setTimeout(() => {
                                const fileNames = Array.from(videoFileInput.files).map(file => file
                                    .name).join(', ');
                                videoLabel.textContent = fileNames.length > 0 ? fileNames :
                                    'Chọn video';
                            }, 0);
                        });

                        const deleteLectureButton = document.createElement('span');
                        deleteLectureButton.classList.add('btn', 'btn-danger');
                        deleteLectureButton.style.cursor = 'pointer';
                        deleteLectureButton.textContent = 'Xóa Bài Giảng';

                        deleteLectureButton.addEventListener('click', function() {
                            lectureDiv.remove();
                        });

                        videoInput.appendChild(videoFileInput);
                        videoInput.appendChild(videoLabel);

                        lectureDiv.appendChild(lectureInput);
                        lectureDiv.appendChild(videoInput);
                        lectureDiv.appendChild(deleteLectureButton);
                        chapterDiv.appendChild(lectureDiv);
                    });

                    chapterInputContainer.appendChild(chapterInput);
                    chapterInputContainer.appendChild(addLectureButton);
                    chapterInputContainer.appendChild(deleteChapterButton);
                    chapterDiv.appendChild(chapterInputContainer);
                    chapterDiv.appendChild(document.createElement('hr'));
                    document.getElementById('chapterContainer').appendChild(chapterDiv);
                });
            </script>
        </div>
        <style>
            .modal-content {
                max-height: 90vh;
                overflow-y: auto;
                padding-right: 15px;
            }

            .modal-body-scrollable {
                max-height: calc(85vh - 100px);
                overflow-y: auto;
            }

            .chapter {
                border: 1px solid #ccc;
                padding: 10px;
                margin-bottom: 10px;
                border-radius: 5px;
            }
        </style>
    </div>
</div>
