<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - User Dashboard</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <!-- Custom User Navigation -->
    <x-user-navigation />

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer if needed -->
    <footer class="text-center py-4 dark:text-gray-300">
        &copy; {{ date('Y') }} ReLove Bazaar. All rights reserved.
    </footer>
</body>
</html>
