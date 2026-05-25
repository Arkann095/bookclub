<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Книжный клуб' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite([
        'resources/css/flash.css',
        'resources/css/home/home.css',
        'resources/css/common.css',
        'resources/css/header/header.css',
        'resources/css/footer/footer.css',
        'resources/css/auth/auth.css',
        'resources/css/community/community.css',
        'resources/css/books/index.css',
        'resources/css/books/current-book.css',
        'resources/css/books/create.css',
        'resources/css/profile/show.css',
        'resources/css/profile/followers.css',
        'resources/css/profile/profile-edit.css',
        'resources/css/profile/shelf.css',
        'resources/css/errors/404.css',
        'resources/css/about.css',
        'resources/css/contacts.css',
        'resources/css/api.css',
        'resources/css/auth/verify-email.css',
    ])
</head> 
    @livewireStyles
</head>
<body>
    <x-header.header />

    <main>
        {{ $slot }}
    </main>

    <x-footer.footer />

    @livewireScripts
</body>
</html>