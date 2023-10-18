<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <style>
        body {
            background-color: #333;
            color: #fff;
            font-family: Arial, sans-serif;
            font-size: 48px;
            display: flex;
            flex-direction: column;
            align-items: center;
            
            
            height: 100vh;
            margin: 0;
        }
        a {
            color: #fff;
            font-size: 16px;
            text-decoration: none;
            margin: 10px;
        }
        a:hover {
        text-decoration: underline;
        }
        h2 {
            font-size: 24px;
            margin: 0;
        }
        h3 {
            font-size: 16px;
            margin: 0;
        }
        .main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 128px;
        }


    </style>
</head>
<body>
    
    <x-Header data="Home"/>
    
    <div class="main">
    Welcome
    <h2>
    Last page visited:
    </h2>
    <h3>
    {{URL::previous()}}
    </h3>

    <!--  -->

    <form action="home" method="POST">
        @csrf
        <input type="text" name="user" placeholder="Enter your name" value="{{ old('user') }}"><br>
        <span style="color: red; font-size: 10px;">@error('user'){{$message}}@enderror</span><br>
        <input type="text" name="password2" placeholder="Enter your password" value="{{ old('password') }}"><br>
        <span style="color: red; font-size: 10px">@error('password2'){{$message}}@enderror</span><br>
        <button type="submit">Submit</button>
    </form>
    </div>
</body>
</html>

