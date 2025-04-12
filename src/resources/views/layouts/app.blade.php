<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Zen+Kaku+Gothic+Antique:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @yield('css')
</head>
<body>
    <div class="app">
        <div class="header">
            <input class="overlay-input" type="checkbox" id="overlay-input" />
            <label for="overlay-input" class="menu-button"><span></span></label>
            <h1 class="title">Rese</h1>
            <div class="menu">
                <ul class="menu-lists">
                @if(Auth::check())
                    @if(Auth::user()->role === 'user')
                        <li><a class="menu-link" href="{{ route('index') }}">Home</a></li>
                        <li>
                            <form class="logout-form" action="/logout" method="post">
                            @csrf
                                <input class="logout-button" type="submit" value="Logout">
                            </form>
                        </li>
                        <li><a class="menu-link" href="{{ route('mypage') }}">Mypage</a></li>
                    @elseif(Auth::user()->role === 'owner')
                        <li><a class="menu-link" href="{{ route('owner.shop') }}">Home</a></li>
                        <li>
                            <form class="logout-form" action="/logout" method="post">
                            @csrf
                                <input class="logout-button" type="submit" value="Logout">
                            </form>
                        </li>
                        <li><a class="menu-link" href="{{ route('payment') }}">Payment</a></li>
                    @elseif(Auth::user()->role === 'admin')
                        <li>
                            <form class="logout-form" action="/logout" method="post">
                            @csrf
                                <input class="logout-button" type="submit" value="Logout">
                            </form>
                        </li>
                        <li><a class="menu-link" href="{{ route('admin.mail') }}">Mail</a></li>
                    @endif
                @else
                    <li><a class="menu-link" href="{{ route('index') }}">Home</a></li>
                    <li><a class="menu-link" href="/register">Registration</a></li>
                    <li><a class="menu-link" href="/login">Login</a></li>
                @endif
                </ul>
            </div>
            @yield('header')
        </div>
        @yield('content')
    </div>
</body>
</html>