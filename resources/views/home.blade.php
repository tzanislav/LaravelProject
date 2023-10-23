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
    <img src = "https://laravel-tzani.s3.eu-west-1.amazonaws.com/img/Logo+Black.png" class="adimariLogoLarge">
        <div class="titles">
            <div class="homeTitle">
                <h1>Welcome</h1>
            </div>

        </div>
        <div class="projectList">  
        <div >
                <h2>Select project</h2>
        </div>          
                @foreach($uniqueItems as $item)
                <a href="/list/{{$item->project}}">{{$item->project}}</a></li>      
                @endforeach                      
        </div>
    </div>

</body>
</html>