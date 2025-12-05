<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Aulab Post</title>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">

    {{-- NAVBAR --}}
    <x-navbar />

    <main class="py-4">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    @isset($footer)
        <x-footer />
    @endisset

</body>
</html>
