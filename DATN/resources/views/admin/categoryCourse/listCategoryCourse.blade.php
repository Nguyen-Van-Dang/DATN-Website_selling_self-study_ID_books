@extends('layouts.admin.admin')

@section('title', 'Danh sách danh mục khóa học')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <livewire:courseCate.render-courseCate />
            {{--  --}}
            <script>
                function openPopup(type) {
                    if (type === 'add') {
                        document.getElementById("addCourseCateModal").classList.add("is-open");
                    } else if (type === 'edit') {
                        document.getElementById("editCourseCateModal").classList.add("is-open");
                    } else (type === 'delete') {
                        document.getElementById("deletedCourseCateModal").classList.add("is-open");
                    }
                    document.getElementById("overlay").style.display = "block";
                }

                function closePopup() {
                    document.getElementById("addCourseCateModal").classList.remove("is-open");
                    document.getElementById("editCourseCateModal").classList.remove("is-open");
                    document.getElementById("deletedCourseCateModal").classList.remove("is-open");
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

                #confirmPopup {
                    display: none;
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background-color: white;
                    padding: 20px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    z-index: 1000;
                    border-radius: 5px;
                }
            </style>

        </div>
    </div>

@endsection
