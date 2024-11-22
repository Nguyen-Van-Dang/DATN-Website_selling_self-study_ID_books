@extends('layouts.admin.admin')

@section('title', 'Sửa khóa học')

@section('content')

    <div class="container-fluid">
        @livewire('admin.course.course-update', [
            'course' => $course,
            'teachers' => $teachers,
            'lectureCategories' => $lectureCategories,
        ])
    </div>
    <script>
        document.getElementById('image-placeholder').addEventListener('click', function() {
            document.getElementById('image-input').click();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('pdfInput');
            const label = document.getElementById('pdfLabel');

            input.addEventListener('change', () => {
                const fileName = input.files[0]?.name || 'Chọn file';
                label.textContent = fileName;
            });
        });
    </script>
    <style>
        .form-control {
            line-height: 25px
        }

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
@endsection
