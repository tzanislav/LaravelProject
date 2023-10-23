<!DOCTYPE html>
<html>
<head>
    <title>Confirm Password</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <x-header data="Confirm Password" />
    
    <form method="POST" action="{{ route('password.confirm') }}">
        <div class="inputBox">
            <img src="https://laravel-tzani.s3.eu-west-1.amazonaws.com/img/Logo+Black.png" class="adimariLogoMid">
            <h1>Confirm Password</h1>
            <div class="inputEmail">
                <div class="texts">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <label for="password">Password</label>
                    <br>
                    <input id="password" type="password" name="password" required autocomplete="current-password">
                    @if ($errors->has('password'))
                        <p class="errorText">{{ $errors->first('password') }}</p>
                    @endif
                </div>
            </div>

            <br>
            <div class="inputLoginButton">
                <button type="submit" class="ml-3">Confirm</button>
            </div>
        </div>
    </form>

</body>
</html>
