<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS -->
    <link rel="stylesheet" href="/css/main.css">
    <livewire:styles />
    {{-- @livewireStyles --}}
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <title>Laraflix</title>
</head>

<body class="font-sans bg-black text-white">
    <nav class="border-b border-gray-800">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between px-4 py-6">
            <ul class="flex flex-col md:flex-row items-center">
                <li class="text-red-700 font-bold">
                    <a href="{{ route('movies.index') }}" class="flex">
                        <svg class="flex-shrink-0 h-6 w-6 text-white-600 mt-1" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                        </svg>
                        <p class="pl-2 text-xl">Laraflix</p>
                    </a>
                </li>
                <li class="md:ml-16 mt-3 md:mt-0">
                    <a class="hover:text-gray-300" href="{{ route('movies.index') }}">Movies</a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a class="hover:text-gray-300" href="{{ route('tv.index') }}">TV Shows</a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a class="hover:text-gray-300" href="{{ route('actors.index') }}">Actors</a>
                </li>
            </ul>
            <div class="flex items-center mt-3 md:mt-0">
                <livewire:search-dropdown>
                <div class="ml-4">
                    <a href="">
                        {{-- <img src="https://instagram.fisb5-1.fna.fbcdn.net/v/t51.2885-19/s320x320/103548129_1455804077941834_3287250115486018150_n.jpg?_nc_ht=instagram.fisb5-1.fna.fbcdn.net&_nc_ohc=J0XFhJkgEOwAX-KV6JU&oh=e5001396206e5d7b9fdee8ef202d5906&oe=5FA41328" alt="avatar" class="rounded-full w-8 h-8"> --}}
                        <img src="{{asset('storage/img/avatar.jpg')}}" alt="avatar" class="rounded-full w-8 h-8">
                    </a>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')
    {{-- @livewireScripts --}}
    <livewire:scripts />
</body>

</html>
