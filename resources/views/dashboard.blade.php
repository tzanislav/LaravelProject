<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <x-header data="Dashboard" />

    <div class="inputBox">
        <img src="https://laravel-tzani.s3.eu-west-1.amazonaws.com/img/Logo+Black.png" class="adimariLogoMid">
        <h1>Dashboard</h1>
        <div class="textContent">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ __("You're logged in!") }}
                        </div>
                        <br>
                            <br>
                            <br>
                        <div class="p-6 text-gray-900">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
