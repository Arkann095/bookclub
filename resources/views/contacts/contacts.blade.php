{{-- resources/views/contacts.blade.php --}}
<x-layout>
    <x-slot name="title">Контакты</x-slot>

    <link rel="stylesheet" href="{{ asset('css/contacts.css') }}">

    <section class="contacts-hero">
        <div class="container">
            <h1 class="contacts-title">Контакты</h1>
        </div>
    </section>

    <div class="container contacts-content">
        <div class="contacts-card">
            <div class="contact-item">
                <span class="contact-icon">🐙</span>
                <div class="contact-info">
                    <h3>GitHub</h3>
                    <a href="https://github.com/Arkann095" target="_blank" class="contact-link">
                        github.com/Arkann095
                    </a>
                    <p class="contact-hint">Репозиторий проекта и исходный код</p>
                </div>
            </div>
        </div>
    </div>
</x-layout>