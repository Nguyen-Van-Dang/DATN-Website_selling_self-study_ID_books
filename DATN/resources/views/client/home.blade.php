@extends('layouts.client.client')

@section('title', 'Trang Chủ')

@section('content')
    <div class="container-fluid">
        <livewire:client.homepage />
    </div>
    <style>
        .trendy-course {
            transition: transform 0.3s ease;
        }

        .trendy-course:hover {
            transform: scale(1.05);
        }

        .course-image {
            aspect-ratio: 1.5/1;
            object-fit: cover
        }
    </style>
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
                    const favoriteCountElement = document.querySelector(`#favorite-count-${bookId}`);
                    if (favoriteCountElement) {
                        favoriteCountElement.textContent = data.new_favorite_count;
                    }
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
