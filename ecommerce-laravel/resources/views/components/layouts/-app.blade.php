<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Judul Default' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="app-wrapper">
        <header>
            <nav>
                <a href="/">Home</a>
                <a href="/about">About</a>
                <a href="/contact">Contact</a>
            </nav>
        </header>

        <main>
            {{ $slot }}
        </main>

        <footer>
            <p>&copy; {{ date('Y') }} Nama Perusahaan</p>
        </footer>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>