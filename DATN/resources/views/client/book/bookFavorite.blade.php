@extends('layouts.client.client')

@section('title', 'Sách Yêu Thích')

@section('content')

    <div class="container-fluid">
        @livewireStyles
        <livewire:client.book.likes />
        @livewireScripts
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
                    const heartIcons = document.querySelectorAll(`.heart-icon-${bookId}`);
                    heartIcons.forEach(icon => {
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
