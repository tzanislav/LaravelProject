<div class="header">
    <link rel="stylesheet" href="/css/header.css">

    <img src="{{ URL::asset('/images/Logo_White.png') }}" alt="image" style="height: 100px; margin: 20px;" id="logo">
   
    
    <div style="display: flex; margin-left: 32px;" class='navButtons'>
        <div class="navMenu">
            <a href="/">Home</a>
            <a href="/about" >Renders</a>
            <a href="/">Projects</a>
            @if (Auth::check())
            @if(Auth::user()->clearance > 0)           
            <a href="/admin">Admin</a>
            <a href="/logs" >Logs</a>
            @endif
            @endif
        </div>

        <div class="navTitle">

        </div>

        <div class ="username">
            
                <!-- Check if the user is authenticated -->
                @if (Auth::check())
                
                    <p>
                        <!-- Show the name of the logged-in user -->
                         Welcome, <a href="{{ route('dashboard') }}">  {{ Auth::user()->name }} </a>
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