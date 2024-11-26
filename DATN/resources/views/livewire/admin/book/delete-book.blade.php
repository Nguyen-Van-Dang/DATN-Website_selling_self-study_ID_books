<div>
    @forelse ($bookUsers as $book)
        <tr>
            <td>{{ $book->id }}</td>
            @php
                $course = $book->courseActivations->first();
                $user = $book->user;
                $thumbnail = $book->images()->where('image_name', 'thumbnail')->first();
            @endphp
            <td>
                @if ($thumbnail)
                    <img class="img-fluid img-thumbnail" src="{{ $thumbnail->image_url }}"
                        alt="Ảnh cuốn sách {{ $book->name }}" style="width:80px">
                @else
                    <img class="img-fluid img-thumbnail" src="{{ asset('assets/images/book/book_placeholder.png') }}"
                        alt="Ảnh cuốn sách {{ $book->name }}" style="width:80px">
                @endif
            </td>
            <td>{{ $book->name }}</td>
            <td>
                @if ($book->discount)
                    <span style="font-weight: bold">
                        {{ number_format($book->price - ($book->price * $book->discount) / 100, 0, ',', '.') }}
                        đ
                    </span>
                    <span class="text-muted" style="text-decoration-line: line-through">
                        {{ number_format($book->price, 0, ',', '.') }} đ
                    </span>
                    <br>
                    <span
                        style="background-color: #f44336; color: white; padding: 5px; border-radius: 5px;">
                        -{{ $book->discount }}%
                    </span>
                @else
                    <span>{{ number_format($book->price, 0, ',', '.') }} đ</span>
                @endif

            </td>
            <td>
                @foreach ($book->categories as $category)
                    <span class="badge badge-secondary">{{ $category->name }}</span>
                @endforeach
            </td>
            <td>{{ $book->deleted_at }}</td>
            <td>
                <a href="" class="btn btn-success">Khôi phục</a>
                <a href="" class="btn btn-danger">Xóa vĩnh viễn</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">Không có sách nào bị xóa</td>
        </tr>
    @endforelse
</div>
