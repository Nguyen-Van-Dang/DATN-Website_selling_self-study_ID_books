<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'TRANG CHỦ ADMIN')</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/typography.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>

<body>

    <div class="wrapper">
        <div class="iq-sidebar">
            <x-client.sidebar></x-client.sidebar>
        </div>
        <div class="iq-top-navbar">
            <x-client.header></x-client.header>
        </div>
        <div id="content-page" class="content-page">
            @yield('content')

        </div>
        <footer class="iq-footer">
            <x-client.footer></x-client.footer>
        </footer>
    </div>
    {{-- <x-footer /> --}}
</body>

</html>
