
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <div class="footer-logo">Book<span style="color:#c49a6c;">Club</span></div>
                <p>{{ __('Your personal book club. Read, review, and discuss.') }}</p>
            </div>
            <div class="footer-links">
                <h4>{{ __('Navigation') }}</h4>
                <ul>
                    <li><a href="/">{{ __('Main') }}</a></li>
                    <li><a href="{{ route('books.index') }}">{{ __('Books') }}</a></li>
                    <li><a href="{{ route('community') }}">{{ __('Popular') }}</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>{{ __('About') }}</h4>
                <ul>
                    <li><a href="{{ route('about') }}">{{ __('About project') }}</a></li>
                    <li><a href="{{ route('contacts') }}">{{ __('Contacts') }}</a></li>
                    <li><a href="{{ route('api') }}">API</a></li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            &copy; {{ date('Y') }} BookClub. {{ __('All rights reserved. With love for books.') }}
        </div>
        <div class="lang-switcher">
            <a href="{{ route('lang.switch', 'ru') }}" class="lang-link {{ app()->getLocale() === 'ru' ? 'active' : '' }}">RU</a>
            <a href="{{ route('lang.switch', 'en') }}" class="lang-link {{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
        </div>
    </div>
</footer>
