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
            <a class="header__logo" href="/">
            FashionablyLate
            </a>
            <nav>
            <ul class="header-nav">
                <li class="header-nav__item">
                    @if (Request::is('register'))
                        <a class="header-nav__link" href="/login">login</a>
                    @elseif (Request::is('login'))
                        <a class="header-nav__link" href="/register">register</a>
                    @elseif (Request::is('admin') || Request::is('admin/*'))
                        <form action="/logout" method="POST" style="display: inline;">
                    @csrf
                        <button type="submit" class="header-nav__link" style="background: none; border: none; cursor: pointer;">
                            logout
                        </button>
                        </form>
                    @else

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