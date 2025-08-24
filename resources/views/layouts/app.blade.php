<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>@yield('title')</title>

    {{-- blade-formatter-disable --}}
    <style type="text/tailwindcss">
        .btn {
            @apply rounded-md shadow-sm text-center font-bold ring-1 ring-slate-700/10  text-white py-2 px-2;
        }
        .btn-red {
            @apply bg-red-500 hover:bg-red-600;
        }
        .btn-info {
            @apply bg-blue-500 hover:bg-blue-600;
        }
        .btn-gray {
            @apply bg-gray-200 text-gray-500 hover:bg-gray-700 hover:text-gray-400;
        }
        .btn-green {
            @apply bg-green-500 hover:bg-green-600;
        }
        label {
            @apply block mb-2 uppercase text-slate-700;
        }
        input:not([type="checkbox"]), textarea {
            @apply shadow-sm appearance-none w-full py-2 px-3 border rounded-md focus:ring-1 focus:ring-sky-500 text-slate-700 leading-tight focus:outline-none;
        }
        .error {
            @apply text-red-500 text-sm;
        }

    </style>
    {{-- blade-formatter-enable --}}
</head>
<body class="container mx-auto mt-10 mb-10 max-w-lg">
    @yield('styles')
    <h1 class="text-2xl font-bold">@yield('title')</h1>
@if (session()->has('success'))
<div class="relative mb-7 rounded-md border-green-500 px-4 py-3 text-center bg-green-100 text-green-700 text-lg" role="alert" x-data="{show: true}" x-show="show">
    <strong class="font-bold">Success!</strong>
    <div>
    {{ session('success') }}
    </div>
    <button type="button" class="close absolute top-0 right-0" aria-label="Close" x-on:click="show = false">
        <span aria-hidden="true" class="text-2xl font-bold">&times;</span>
    </button>
</div>
@endif
    <div>@yield('content')</div>
</body>
</html>
