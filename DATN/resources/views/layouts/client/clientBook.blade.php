<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'TRANG CHỦ')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/icon/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/bookID.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toast.css') }}">
    <script src="{{ asset('assets/js/bookID.js') }}"></script>
    <script src="{{ asset('assets/js/toast.js') }}" defer></script>
</head>
<body>
            @yield('content')
</body>
</html>