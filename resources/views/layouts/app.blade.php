<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Control Procesos') }}</title>


    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <livewire:layout.navigation />


        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif


        <main>
            {{ $slot }}
        </main>
    </div>
    @if (session()->has('toastr'))
        <script>
            window.toastrFlash = {
                type: '{{ session('toastr')['type'] }}',
                message: @json(session('toastr')['message'])
            };
        </script>
    @endif
    @livewireScripts
</body>
@if (session('toast'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toast = @json(session('toast'));
            Livewire.dispatch('toast', {
                type: toast.type,
                message: toast.message
            });
        });
    </script>
@endif

</html>
