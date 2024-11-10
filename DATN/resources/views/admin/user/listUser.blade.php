<!-- resources/views/admin/user/list.blade.php -->
@extends('layouts.admin.admin')

@section('title', 'Danh sách tài khoản')

@section('content')

    <div class="container-fluid">
        <div class="row">

            <livewire:user.render-user />

        

            <script>
                // Mở popup xác nhận xóa
                function openDeletePopup(url) {
                    document.getElementById("editCourseCateModal").action = url; // Cập nhật URL xóa
                    document.getElementById("confirmDeleteModal").classList.add("is-open");
                    document.getElementById("overlay").style.display = "block";
                }

                // Đóng popup
                function closePopup() {
                    document.getElementById("confirmDeleteModal").classList.remove("is-open");
                    document.getElementById("overlay").style.display = "none";
                }
            </script>

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
    </div>

@endsection
