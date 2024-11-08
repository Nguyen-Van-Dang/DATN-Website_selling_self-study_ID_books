<div>
    <div class="modal {{ $isAddPopupOpen ? 'is-open' : '' }}" id="addCourseCateModal" wire:click="closePopup()">
        <div class="modal-content" wire:click.stop>
            <span class="close" wire:click="closePopup()">&times;</span>
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Tạo nhóm chat mới</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <form wire:submit.prevent="createGroup">
                            <div class="form-group">
                                <label>Tên nhóm chat</label>
                                <input wire:model="groupName" type="text" class="form-control"
                                    placeholder="Nhập tên nhóm học...">
                                @error('groupName')
                                    <span class="text-danger">{{ $message }}<br /></span>
                                @enderror

                                <label>Mô tả nhóm</label>
                                <input wire:model="groupDescription" type="text" class="form-control"
                                    placeholder="Nhập mô tả...">
                                @error('groupDescription')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <label>Khoá học đại diện</label>
                                <select wire:model="course_id" class="form-control">
                                    <option value="" disabled selected>Chọn khoá học</option>
                                    @for ($i = 1; $i <= 15; $i++)
                                        <option value="{{ $i }}">Khoá học {{ $i }}</option>
                                    @endfor
                                </select>
                                @error('course_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                            <button type="button" class="btn btn-danger" wire:click="closePopup()">Hủy</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .modal {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal.is-open {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 50%;
            position: relative;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            cursor: pointer;
        }
    </style>
</div>
