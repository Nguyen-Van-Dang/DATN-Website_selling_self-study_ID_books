@extends('layouts.admin.admin')

@section('title', 'Danh sách tài khoản')

@section('content')

    <div class="container-fluid">
        <div class="row">

            <livewire:admin.user.user-index />

            <script>
                function openPopup(type) {
                    if (type === 'add') {
                        document.getElementById("addCourseCateModal").classList.add("is-open");
                    } else if (type === 'edit') {
                        document.getElementById("isEditPopupOpen").classList.add("is-open");
                    } else(type === 'delete') {
                        document.getElementById("deletedCourseCateModal").classList.add("is-open");
                    }
                    document.getElementById("overlay").style.display = "block";
                }

                function closePopup() {
                    document.getElementById("addCourseCateModal").classList.remove("is-open");
                    document.getElementById("isEditPopupOpen").classList.remove("is-open");
                    document.getElementById("deletedCourseCateModal").classList.remove("is-open");
                    document.getElementById("overlay").style.display = "none";
                }
            </script>
            <style>
                td a {
                    color: black;
                    text-decoration: none;
                }

                td a:hover {
                    color: var(--iq-primary) !important;
                }

                .zoom-img {
                    transition: transform 0.3s ease;
                    cursor: pointer;
                }

                .zoom-img:hover {
                    transform: scale(2.4);
                }

                .modal-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    opacity: 0;
                    visibility: hidden;
                    transition: opacity 0.5s ease, visibility 0.5s ease;
                }

                .modal {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    visibility: hidden;
                }

                .modal-content {
                    opacity: 0;
                    transform: translateY(-33%);
                    transition: opacity 0.5s ease, transform 0.5s ease;
                }

                .modal.is-open .modal-overlay {
                    opacity: 1;
                    visibility: visible;
                }

                .modal.is-open .modal-content {
                    opacity: 1;
                    transform: translateY(0);
                    visibility: visible;
                }

                .modal:not(.is-open) .modal-overlay {
                    opacity: 0;
                    visibility: hidden;
                }

                .modal:not(.is-open) .modal-content {
                    opacity: 0;
                    transform: translateY(-33%);
                    visibility: hidden;
                }

                .modal-content {
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 5px;
                    width: 50%;
                    position: relative;
                    max-height: 90vh;
                    overflow-y: auto;
                    padding-right: 15px;
                }

                .modal-body-scrollable {
                    max-height: calc(85vh - 100px);
                    overflow-y: auto;
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
