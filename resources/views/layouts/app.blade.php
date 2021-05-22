<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Master Layout</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>

<body class="bg-gray-100">
    <nav class="p-6 bg-white flex justify-between mb-6">
        <ul class="flex justify-between">
            @auth
            <li>
                <a href="" class="p-3">{{ auth()->user()->name }}</a>
            </li>
            @endauth
           
            @guest
            <li>
                <a href="{{ route('login') }}" class="p-3">Login</a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="p-3">Register</a>
            </li>
            @endguest
            
            @auth
            <li>
                <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                    @csrf
                    <button>Logout</button>
                </form>
                
            </li>
            @endauth
        </ul>
        <ul class="flex justify-between">
            <li>
                <a href="{{ route('home') }}" class="p-3">Home</a>
            </li>
            
            <li>
                <a href="{{ route('dashboard') }}" class="p-3">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('posts') }}" class="p-3">Post</a>
            </li>
            
        </ul>

    </nav>
    
    @yield('content')
    @livewireScripts
</body>

</html>