@extends('layouts.client.client')

@section('title', 'Chi Tiết Sách')

@section('content')
    <div class="container-fluid">
        <livewire:client.book.bookdetail :id="$id" />
    </div>
    <script>
        function toggleFavorite(bookId) {
            fetch(`/sach/${bookId}/toggle-favorite`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Cập nhật màu sắc cho sản phẩm chính (nếu có)
                    const mainHeartIcon = document.querySelector(`.main-heart-icon-${bookId}`);
                    if (mainHeartIcon) {
                        mainHeartIcon.style.color = data.is_favorite ? 'red' : 'white';
                    }

                    // Cập nhật màu sắc cho sản phẩm tương tự
                    const relatedHeartIcons = document.querySelectorAll(`.related-heart-icon-${bookId}`);
                    relatedHeartIcons.forEach(icon => {
                        icon.style.color = data.is_favorite ? 'red' : 'pink';
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        function addToCart(bookId) {
            fetch(`/gio-hang/cart/add/${bookId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => data.success && Livewire.dispatch('cartUpdated'))
        }
    </script>
@endsection
