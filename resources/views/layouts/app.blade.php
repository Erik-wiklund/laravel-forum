<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Other CSS and JavaScript includes (if any) -->

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <x-head.tinymce-config />
    @vite(['resources/css/app.css','resources/css/custom.css', 'resources/js/app.js', 'resources/js/chat.js'])
</head>


<body class="font-sans antialiased">
    <header class="sticky-navigation">
        @include('layouts.navigation')
        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
    </header>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 content-below-navigation">
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        @yield('content')
                    </div>
                    <div class="col-md-3">
                        @include('layouts.sidebar')
                    </div>
                </div>
            </div>
        </main>
    </div>
    <footer>
        @include('layouts.footer')
    </footer>
</body>
</html>
