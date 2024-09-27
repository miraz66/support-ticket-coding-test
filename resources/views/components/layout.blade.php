<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Support Ticket System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black text-white font-hanken-grotesk pb-20">
    <div class="px-10">
        <div class="border-b border-white/10">
            <nav class="flex max-w-7xl mx-auto  justify-between items-center py-4">
                <div>
                    <a href="/">
                        <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="">
                    </a>
                </div>

                <div class="space-x-6 font-bold">
                    <a href="/">Customer Support</a>
                </div>

                @auth
                    <div class="space-x-6 font-bold flex">
                        <a href="/customer/create">Post a Ticket</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Log Out</button>
                        </form>
                    </div>
                @endauth

                @guest
                    <div class="space-x-6 font-bold">
                        <a href="/register">Sign Up</a>
                        <a href="/login">Log In</a>
                    </div>
                @endguest
            </nav>
        </div>

        <main class="mt-10 max-w-7xl mx-auto">
            {{ $slot }}
        </main>
    </div>

</body>

</html>
