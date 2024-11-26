<div>
    @forelse ($courseDeleted as $course)
        <tr>
            <td>{{ $course->id }}</td>
            <td style="width: 10%;">
                @php
                    $firstImage = $course->images->first();
                @endphp

                @if ($firstImage)
                    <img src="{{ $firstImage->image_url }}" alt="Image"
                        class="img-fluid avatar-100 rounded" />
                @else
                    <img src="{{ asset('assets/images/book/user/course.jpg') }}" alt="No Image"
                        class="img-fluid avatar-100 rounded" />
                @endif
            </td>
            <td>{{ strlen($course->name) > 100 ? substr($course->name, 0, 100) . '...' : $course->name }}
            </td>
            <td>
                @if ($course->discount > 0)
                    <span class="fw-bold text-danger">
                        {{ number_format($course->price - $course->discount, 0, ',', '.') }} đ
                    </span>
                    <br>
                    <span class="text-muted"
                        style="text-decoration: line-through; margin-left: 8px;">
                        {{ number_format($course->price, 0, ',', '.') }} đ
                    </span>
                    <br>
                    @php
                        $discountPercent = round(($course->discount / $course->price) * 100, 2);
                    @endphp
                    <div
                        style="background-color: #f44336; color: white; padding: 3px 8px; border-radius: 5px; display: inline-block; margin-top: 5px;">
                        -{{ $discountPercent }}%
                    </div>
                @else
                    <span class="fw-bold">{{ number_format($course->price, 0, ',', '.') }}
                        đ</span>
                @endif
            </td>
            @php
                $user = $course->user;
            @endphp
            <td>{{ $user ? optional($course->user)->name : 'Không có người tạo' }}</td>
            <td>{{ $course->deleted_at }}</td>
            <td>
                <a href="" class="btn btn-success">Khôi phục</a>
                <a href="" class="btn btn-danger">Xóa vĩnh viễn</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">Không có khóa học nào bị xóa</td>
        </tr>
    @endforelse
</div>
