<link rel="stylesheet" href="{{ asset('css/header/header.css') }}">

<header class="site-header">
    <div class="container header-inner">


        <a href="/" class="logo">
            Book<span>Club</span>
        </a>

        <nav class="nav">

            <div class="nav-main">
                <a href="{{ route('books.index') }}" class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}">Каталог</a>
                <a href="{{ route('community') }}" class="nav-link {{ request()->routeIs('community') ? 'active' : '' }}">Сообщество</a>
            </div>

            <div class="nav-right">

                @guest
                    <a href="/login" class="nav-link">Войти</a>
                    <a href="/register" class="btn-primary">Регистрация</a>
                @endguest

                @auth
                    <a href="{{ route('profile.shelf') }}" class="nav-link">Полка</a>

                    <div class="profile">
                        <a href="{{ route('profile.show', auth()->user()) }}">
                            <div class="avatar">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}">
                                @else
                                    <span>{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                @endif
                            </div>
                        </a>
                        <span class="username">
                            {{ auth()->user()->name }}
                        </span>

                        <form action="/logout" method="POST">
                            @csrf
                            <button class="logout">Выйти</button>
                        </form>

                    </div>
                @endauth
            </div>
        </nav>
    </div>
</header>