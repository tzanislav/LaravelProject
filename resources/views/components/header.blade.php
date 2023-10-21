<div class="header">
    <link rel="stylesheet" href="/css/header.css">

    <img src="{{ URL::asset('/images/Logo_White.png') }}" alt="image" style="height: 100px; margin: 20px;" id="logo">
   
    
    <div style="display: flex; margin-left: 32px;" class='navButtons'>
        <div class="navMenu">
            <a href="/" style="color: white; margin-right: 16px;">Home</a>
            <a href="/about" style="color: white; margin-right: 16px;">Renders</a>
            <a href="/" style="color: white; margin-right: 16px;">Projects</a>
        </div>

        <div class="navTitle">
            @if(session('project'))
            <p style="color: white; display: flex; margin-left: auto; right: 0px;" class="navTitle"> {{session('project')}} </p>
            @else
            <p style="color: white; display: flex; margin-left: auto; right: 0px;" class="navTitle"> Welcome </p>
            @endif
        </div>

        <div class ="username">
            @if(session('user'))
            <p style="color: white; display: flex; margin-left: auto; right: 0px;"> Hello,  {{session('user')}} </p>
            <a href="/logout" style="color: white; display: flex; margin-left: auto; right: 0px;"> Logout </a>
            @else
            <a href="/login" style="color: white; display: flex; margin-left: auto; right: 0px;"> Login </a>
            @endif
        </div>

    </div>
</div>

