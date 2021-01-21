<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Mycms</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routerName" content="{{ Route::currentRouteName() }}">

    {{-- Fontawesome --}}
    <script src="https://kit.fontawesome.com/a0140a30a1.js" crossorigin="anonymous"></script>

    {{-- CKEditor 5 --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    {{-- Bootstrap --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> --}}

    {{-- Fancybox --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    {{-- Custom JS --}}
    <script src="{{ url('/static/js/admin.js?v='.time())}}"></script>

    {{-- Custom style --}}
    <link rel="stylesheet" href="{{ url('/static/css/admin.css?v='.time())}}">
    <link rel="stylesheet" href="{{ url('/static/css/components/alert.css?v='.time())}}">
    <link rel="stylesheet" href="{{ url('/static/css/components/tooltip.css?v='.time())}}">

    {{-- Roboto font --}}
    <link rel="stylesheet" href="https://use.typekit.net/qzc0ply.css">
</head>
<body>

    <nav class="navbar">
        <div class="profile">
            <img class="avatar" src="{{url('/static/images/avatar.png')}}" alt="avatar">
            <span>
                <a href="/profile">Hi, {{ Auth::user()->firstname }}</a>
            </span>
        </div>
        <a href="/logout">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </nav>

    <div class="sidebar">
        @include('admin.sidebar')
    </div>

    <div class="container">
        <ul class="breadcrumb glass">
            <li class="breadcrumb-item">
                <a href="{{ url('/admin') }}">Dashboard&nbsp;</a>
            </li>
            @section('breadcrumb')
            @show
        </ul>

        @section('content')
        @show
    </div>

</body>
</html>
