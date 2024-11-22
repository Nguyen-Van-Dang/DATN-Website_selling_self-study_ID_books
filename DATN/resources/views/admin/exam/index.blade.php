@extends('layouts.admin.admin')

@section('title', 'Danh sách đề thi')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Danh sách bài tập</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <a href="{{ route('admin.de-thi.create') }}" class="btn btn-primary">Thêm bài tập</a>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table class="data-tables table table-striped table-bordered" style="width:100%">
                                <thead class="text-center">
                                    <tr>
                                        <th style="width: 3%;">STT</th>
                                        <th style="width: 20%;">Tên bài tập</th>
                                        <th style="width: 15%;">Tên khóa học</th>
                                        <th style="width: 15%;">Tác giả bài tập</th>
                                        <th style="width: 6%;">Xem trước</th>
                                        <th style="width: 10%;">Số lần kiểm tra</th>
                                        <th style="width: 10%; text-align: center;">Hoạt động</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($exams as $exam)
                                        <tr>
                                            <td>1</td>
                                            <td>{{ $exam->name }}</td>
                                            <td>{{ $exam->course->name }}</td>
                                            <td>{{ $exam->course->user->name }}</td>
                                            <td><a href="{{ route('admin.de-thi.download', $exam->id) }}" target="_blank"
                                                    type="application/pdf"><i
                                                        class="ri-file-fill text-secondary font-size-18"></i></a></td>
                                            <td>
                                                @if ($exam->results)
                                                    {{ count($exam->results) }}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td>
                                                <div class="flex align-items-center list-user-action text-center">
                                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top"
                                                        title="Cập nhật"
                                                        href="{{ route('admin.de-thi.edit', $exam->id) }}"><i
                                                            class="ri-pencil-line"></i></a>
                                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top"
                                                        title="Xóa"
                                                        onclick="confirmDelete(this, {{ $exam->id }}, '{{ $exam->name }}')"
                                                        href="#"
                                                        data-url="{{ route('admin.de-thi.destroy', ':id') }}">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="deleteModal" tabindex="-1"
                                            role="dialog"aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered d-flex align-items-center justify-content-center "
                                                role="document">
                                                <div class="modal-content text-center">
                                                    <div class="modal-body">
                                                        <div class="iq-card mb-0">
                                                            <div class="iq-card-header">
                                                                <div class="iq-header-title">
                                                                    <h5>Xác nhận xoá bộ đề
                                                                        <b id="itemName"></b> ?
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <div class="iq-card-body">
                                                                <form id="deleteForm" method="POST" action="">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-primary"
                                                                        style="width: 100px; height: 40px;">Xác
                                                                        nhận</button>
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal"
                                                                        style="width: 100px; height: 40px;">Hủy</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function confirmDelete(element, id, name) {
                const url = element.getAttribute('data-url').replace(':id', id);
                document.getElementById('deleteForm').action = url;
                document.getElementById('itemName').textContent = name;
                $('#deleteModal').modal('show');
            }
        </script>
    </div>

@endsection
