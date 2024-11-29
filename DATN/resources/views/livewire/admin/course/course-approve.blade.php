<div>
    @foreach ($courses as $course)
        <tr>
            <td>{{ $course->id }}</td>
            {{-- <td>{{ $course->name }}</td> --}}
            <td>{{ \Illuminate\Support\Str::limit($course->name, 30, '...') }}</td>
            <td>{{ $course->price }}</td>
            {{-- <td>{{ $course->description }}</td> --}}
            <td>{{ \Illuminate\Support\Str::limit($course->description, 50, '...') }}</td>
            <td>{{ $course->status == 1 ? 'Chờ xác nhận' : $course->status }}</td>
            {{-- <td>{{ $course->deleted_at }}</td> --}}
            <td>
                <div class="flex align-items-center list-user-action">
                    <!-- Duyệt -->
                    <form action="{{ route('model.approve', ['model' => 'course', 'id' => $course->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Duyệt">
                            <i class="ri-check-line"></i>
                        </button>
                    </form>
            
                    <!-- Từ chối (Xóa) -->
                    <form action="{{ route('model.reject', ['model' => 'course', 'id' => $course->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Từ chối">
                            <i class="ri-close-line"></i>
                        </button>
                    </form>
                </div>
            </td>
            

        </tr>
    @endforeach
</div>
