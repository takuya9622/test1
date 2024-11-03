<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <div class="header-left"></div>
                <a class="header__logo" href="/">FashionablyLate</a>
                <nav class="header-right">
                    <ul class="header-nav">
                        <li class="header-nav__item">
                            @if (Request::is('register'))
                                <a class="header-nav__link" href="/login">login</a>
                            @elseif (Request::is('login'))
                                <a class="header-nav__link" href="/register">register</a>
                            @elseif (Request::is('admin') || Request::is('admin/*'))
                                <form action="/logout" method="POST" class="header-nav__form">
                                    @csrf
                                    <button type="submit" class="header-nav__link">logout</button>
                                </form>
                            @endif
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>


    <main>
        @yield('content')
    </main>
</body>

</html>