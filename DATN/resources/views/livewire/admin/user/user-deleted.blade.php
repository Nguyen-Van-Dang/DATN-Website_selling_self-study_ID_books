<div>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @forelse ($deletedUsers as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>
                @php
                    $firstImage = $user->images->first();
                @endphp

                @if ($firstImage)
                    <img src="{{ $firstImage->image_url }}" alt="Image" class="img-fluid avatar-100 rounded" />
                @else
                    <img src="{{ asset('assets/images/book/user/thub.jpg') }}" alt="No Image"
                        class="img-fluid avatar-100 rounded" />
                @endif
            </td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if ($user->role_id == 1)
                    <span style="background-color: #f44336; color: white; padding: 5px; border-radius: 5px;">Admin</span>
                @elseif ($user->role_id == 2)
                    <span style="background-color: #2196F3; color: white; padding: 5px; border-radius: 5px;">Giáo
                        viên</span>
                @elseif ($user->role_id == 3)
                    <span style="background-color: #4CAF50; color: white; padding: 5px; border-radius: 5px;">Học
                        sinh</span>
                @else
                    <span style="background-color: #9E9E9E; color: white; padding: 5px; border-radius: 5px;">Không
                        xác định</span>
                @endif
            </td>
            <td>{{ $user->deleted_at }}</td>
            <td>
                <button wire:click.prevent="restore({{ $user->id }})" class="btn btn-success">Khôi phục</button>
                <button wire:click.prevent="forceDelete({{ $user->id }})" class="btn btn-danger">Xóa vĩnh viễn</button>
                
            </td>

        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">Không có tài khoản nào bị xóa</td>
        </tr>
    @endforelse
</div>
