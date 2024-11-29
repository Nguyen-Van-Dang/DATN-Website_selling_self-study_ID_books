<div>
    @foreach ($users as $user)
        @if ($user->role_id == 2)
            <tr>
                <td>{{ $user->id }}</td>
                {{-- <td>{{ $user->name }}</td> --}}
                <td>{{ \Illuminate\Support\Str::limit($user->name, 30, '...') }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->status == 1 ? 'Chờ xác nhận' : $user->status }}</td>
                {{-- <td>{{ $course->deleted_at }}</td> --}}
                <td>
                    <div class="flex align-items-center list-user-action">
                        <!-- Duyệt -->
                        <form action="{{ route('model.approve', ['model' => 'user', 'id' => $user->id]) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Duyệt">
                                <i class="ri-check-line"></i>
                            </button>
                        </form>

                        <!-- Từ chối (Xóa) -->
                        <form action="{{ route('model.reject', ['model' => 'user', 'id' => $user->id]) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Từ chối">
                                <i class="ri-close-line"></i>
                            </button>
                        </form>
                    </div>
                </td>

            </tr>
        @endif
    @endforeach
</div>
