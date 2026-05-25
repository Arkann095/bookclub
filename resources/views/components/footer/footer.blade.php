<link rel="stylesheet" href="{{ asset('css/footer/footer.css') }}">

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <div class="footer-logo">Book<span style="color:#c49a6c;">Club</span></div>
                <p>Ваш персональный книжный клуб. Читайте, рецензируйте, обсуждайте.</p>
            </div>
            <div class="footer-links">
                <h4>Навигация</h4>
                <ul>
                    <li><a href="/">Главная</a></li>
                    <li><a href="{{ route('books.index') }}">Книги</a></li>
                    <li><a href="{{ route('community') }}">Популярное</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>О нас</h4>
                <ul>
                    <li><a href="{{ route('about') }}">О проекте</a></li>
                    <li><a href="{{ route('contacts') }}">Контакты</a></li>
                    <li><a href="{{ route('api') }}">API</a></li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            &copy; {{ date('Y') }} BookClub. Все права защищены. С любовью к книгам.
        </div>
    </div>
</footer>
