<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <x-header data="Email Verification" />
    
    <div class="inputBox">
        <img src="https://laravel-tzani.s3.eu-west-1.amazonaws.com/img/Logo+Black.png" class="adimariLogoMid">
        <h1>Email Verification</h1>
        <div class="inputEmail">
            <div class="texts">
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>
                
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif
            </div>
        </div>

        <br>
        <div class="inputLoginButton">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="ml-3">Resend Verification Email</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>

</body>
</html>
