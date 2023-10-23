<div class="header">
    <link rel="stylesheet" href="/css/header.css">

    <img src="{{ URL::asset('/images/Logo_White.png') }}" alt="image" style="height: 100px; margin: 20px;" id="logo">
   
    
    <div style="display: flex; margin-left: 32px;" class='navButtons'>
        <div class="navMenu">
            <a href="/" style="color: white; margin-right: 16px;">Home</a>
            <a href="/about" style="color: white; margin-right: 16px;">Renders</a>
            <a href="/logs" style="color: white; margin-right: 16px;">Logs</a>
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
            
                <!-- Check if the user is authenticated -->
                @if (Auth::check())
                    <p>
                        <!-- Show the name of the logged-in user -->
                        Welcome, {{ Auth::user()->name }}
                    </p>
                    <p>
                        <!-- Add a logout link -->
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </p>
                @else
                    <p>
                        <!-- Show a login link if the user is not authenticated -->
                        <a href="{{ route('login') }}">Login</a>
                    </p>
                @endif
        </div>

    </div>
</div>

