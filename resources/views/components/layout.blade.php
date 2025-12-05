<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>The Aulab Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

    <x-navbar />

    <main class="py-4">
        {{ $slot }}
    </main>

</body>
</html>
