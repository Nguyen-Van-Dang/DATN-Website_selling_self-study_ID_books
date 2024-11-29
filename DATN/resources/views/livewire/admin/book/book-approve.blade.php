<div>
    @foreach ($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            {{-- <td>{{ $book->name }}</td> --}}
            <td>{{ \Illuminate\Support\Str::limit($book->name, 30, '...') }}</td>
            {{-- <td>{{ $book->user->name }}</td> --}}
            <td>{{ $book->user ? $book->user->name : 'Không có thông tin' }}</td>
            <td>{{ $book->price }}</td>
            <td>{{ $book->discount }}</td>
            {{-- <td>{{ $book->description }}</td> --}}
            <td>{{ \Illuminate\Support\Str::limit($book->description, 50, '...') }}</td>
            <td>{{ $book->status == 1 ? 'Chờ xác nhận' : $user->status }}</td>
            {{-- <td>{{ $course->deleted_at }}</td> --}}
            <td>
                <div class="flex align-items-center list-user-action">
                    <!-- Duyệt -->
                    <form action="{{ route('model.approve', ['model' => 'book', 'id' => $book->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Duyệt">
                            <i class="ri-check-line"></i>
                        </button>
                    </form>
            
                    <!-- Từ chối (Xóa) -->
                    <form action="{{ route('model.reject', ['model' => 'book', 'id' => $book->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Từ chối">
                            <i class="ri-close-line"></i>
                        </button>
                    </form>
                </div>
            </td>
            

            </form>

        </tr>
    @endforeach
</div>
