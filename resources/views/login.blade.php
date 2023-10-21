<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/login.css">


</head>
<body>
    <x-header data="Log in Page Compo4nent" />
    <div class="loginPage">
        <div class="loginForm">
            <div class="loginTitle">
                <h1>Log in</h1>
            </div>
            <form action="" method="POST" >
                @csrf
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <br>
                <br>
                <button type="submit">Log in</button>
            </form>

            @if($errors->any())

            <div>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach

                </ul>
            </div>
            @endif
        </div>
    </div>
    
</body>
</html>