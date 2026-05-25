{{-- resources/views/about.blade.php --}}
<x-layout>
    <x-slot name="title">О проекте</x-slot>

    <link rel="stylesheet" href="{{ asset('css/about.css') }}">

    <section class="about-hero">
        <div class="container">
            <h1 class="about-title">О проекте</h1>
        </div>
    </section>

    <div class="container about-content">
        <div class="about-card">
            <div class="about-intro">
                <div class="about-avatar">
                    
                </div>
                <p class="about-greeting">
                    Привет! Меня зовут <strong>Артур</strong>, я backend-разработчик. Этот проект — мой pet-project, созданный чтобы показать навыки разработки на современном стеке.
                </p>
            </div>

            <div class="about-stack">
                <h3>Стек технологий которыми я владею</h3>
                <div class="stack-tags">
                    <span class="stack-tag">PHP</span>
                    <span class="stack-tag">Laravel</span>
                    <span class="stack-tag">Livewire</span>
                    <span class="stack-tag">CSS</span>
                    <span class="stack-tag">HTML</span>
                    <span class="stack-tag">Tailwind</span>
                    <span class="stack-tag">Filament</span>
                </div>
            </div>

            <div class="about-description">
                <h3><span class="accent">BookClub</span> — это платформа для читателей</h3>
                
                <div class="features-list">
                    <div class="feature-item">
                        <span class="feature-icon">📖</span>
                        <span>Загружать и скачивать книги</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">⭐</span>
                        <span>Оставлять рецензии и оценки</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">💬</span>
                        <span>Обсуждать книги в комментариях</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">👥</span>
                        <span>Подписываться на других читателей</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">📚</span>
                        <span>Вести личную книжную полку</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">🔒</span>
                        <span>Управлять профилем и приватностью</span>
                    </div>
                </div>
            </div>

            <div class="about-footer">
                <p>Проект находится в активной разработке. Буду рад обратной связи и предложениям!</p>
            </div>
        </div>
    </div>
</x-layout>