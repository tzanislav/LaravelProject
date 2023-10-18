<div style="height: 128px; 
            font-family: Arial, sans-serif;
            font-size: 16x;
            decoration: none;
            background-color: black; 
            display: flex; align-items: center; 
            width: 100%;
            
            top: 0;
            height: 128px;
            margin: 0px 0px 24px 0px;">

    <img src="{{ URL::asset('/images/Logo_White.png') }}" alt="image" style="height: 100px; margin: 20px;">
   
    
    <div style="display: flex; margin-left: 32px;">
        <div id="menu">
            <a href="/" style="color: white; margin-right: 16px;">Home</a>
            <a href="/contacts" style="color: white; margin-right: 16px;">Contacts</a>
            <a href="/about" style="color: white; margin-right: 16px;">About</a>
            <a href="/users" style="color: white; margin-right: 16px;">Users</a>
        </div>
        
        <p style="color: white; display: flex; margin-left: auto; right: 0px;"> {{$title}} </p>
        @if(session('user'))
        <p style="color: white; display: flex; margin-left: auto; right: 0px;"> Jello,  {{session('user')}} </p>
        <a href="/logout" style="color: white; display: flex; margin-left: auto; right: 0px;"> Logout </a>
        @else
        <a href="/login" style="color: white; display: flex; margin-left: auto; right: 0px;"> Login </a>
        @endif

    </div>
</div>

