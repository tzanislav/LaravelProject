<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <x-header data="Login" />
    
    <form method="POST" action="{{ route('login') }}">
        <div class="inputBox">
            <img src = "https://laravel-tzani.s3.eu-west-1.amazonaws.com/img/Logo+Black.png" class="adimariLogoMid">
            <h1>Login</h1>
            <div class="inputEmail">
                <div class="texts">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <label for="email">Email</label>
                    <br>
                    <input id="email"  type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    <br>
                    @if ($errors->has('email'))
                        <p class="text-red-500 mt-2">{{ $errors->first('email') }}</p>
                    @endif
                    <br>
                    <br>
                    <label for="password">Password</label>
                    <br>
                    <input id="password" type="password" name="password" required autocomplete="current-password">
                    @if ($errors->has('password'))
                        <p class="errorText">{{ $errors->first('password') }}</p>
                    @endif
                    <br>
                </div>
                <br>
                <div class="inputSettings">
                    <label for="remember_me" class="remember">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>
            </div>




        <br>
            <div class="inputLoginButton">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Forgot your password?</a>
                @endif
                <br>
                <button type="submit" class="ml-3">Log in</button>
            </div>
            <br>
            <br>
            <div class="register">
                <p>Don't have an account?</p>
                <a href="{{ route('register') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Register</a>
            </div>
        </div>
    </form>

</body>
</html>
