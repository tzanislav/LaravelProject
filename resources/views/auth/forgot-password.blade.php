<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <x-header data="Forgot Password" />
    
    <form method="POST" action="{{ route('password.email') }}">
        <div class="inputBox">
            <img src="https://laravel-tzani.s3.eu-west-1.amazonaws.com/img/Logo+Black.png" class="adimariLogoMid">
            <h1>Forgot Password</h1>
            <div class="inputEmail">
                <div class="texts">
                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('Forgot your password? No problem. Just let us know your email address, and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <label for="email">Email</label>
                    <br>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <p class="text-red-500 mt-2">{{ $errors->first('email') }}</p>
                    @endif
                </div>
            </div>

            <br>
            <div class="inputLoginButton">
                <button type="submit" class="ml-3">Email Password Reset Link</button>
            </div>
        </div>
    </form>

</body>
</html>
