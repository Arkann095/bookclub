<link rel="stylesheet" href="{{ asset('css/header/header.css') }}">

<header class="site-header">
    <div class="container header-inner">


        <a href="/" class="logo">
            Book<span>Club</span>
        </a>

        <nav class="nav">

            <div class="nav-main">
                <a href="{{ route('books.index') }}" class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}">{{ __('Catalog') }}</a>
                <a href="{{ route('community') }}" class="nav-link {{ request()->routeIs('community') ? 'active' : '' }}">{{ __('Community') }}</a>
            </div>

            <div class="nav-right">

                @guest
                    <a href="/login" class="nav-link">{{ __('Log In') }}</a>
                    <a href="/register" class="btn-primary">{{ __('Sign Up') }}</a>
                @endguest

                @auth
                    <a href="{{ route('profile.shelf') }}" class="nav-link">{{ __('Bookshelf') }}</a>
                    @php
                        $unreadCount = \Illuminate\Support\Facades\DB::table('notifications')
                            ->where('notifiable_type', App\Models\User::class)
                            ->where('notifiable_id', auth()->id())
                            ->whereNull('read_at')
                            ->count();
                    @endphp
                    <a href="{{ route('profile.show', auth()->user()) }}?tab=notifications" class="notification-bell">
                        @if($unreadCount > 0)
                            🔔 <span class="badge">{{ $unreadCount }}</span>
                        @else
                            🔕
                        @endif
                    </a>
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
                            <button class="logout">{{ __('Log Out') }}</button>
                        </form>
                        @auth
                            @if(auth()->user()->is_admin)
                                <a href="/admin" class="nav-link">{{ __('Admin') }}</a>
                            @endif
                        @endauth
                    </div>
                @endauth
            </div>
        </nav>
    </div>
</header>