<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/home.css">
</head>
<body>
    
    <x-Header data="Home"/>
    <div class="inputBox">
        <div class="titles">
            <div class="homeTitle">
                <h1>Welcome</h1>
            </div>
            <div class="homeContent">
                <p>Select project</p>
            </div>
        </div>
        <div class="projects">
            <div class="container">
                
                @foreach($uniqueItems as $item)
                <a href="/list/{{$item->project}}">{{$item->project}}</a></li>      
                @endforeach             
            </div>           
        </div>
    </div>

</body>
</html>