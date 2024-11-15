@extends('layouts.admin.admin')

@section('title', 'Cập nhật')

@section('content')
    {{-- view --}}
    <div class="container-fluid">
        @livewire('admin.book.update-book', ['book' => $book, 'teachers' => $teachers, 'categories' => $categories])
    </div>
    <style>
        .select2-selection--multiple {
            padding: 0px !important;
        }

        .select2-selection__choice {
            font-size: 12px !important;
            margin-top: 3px !important;
            padding-right: 5px !important;
        }

        .select2-selection__clear {
            margin: 0px !important;

        }

        .select2-search__field {
            margin: 0px !important;
        }
    </style>
@endsection
