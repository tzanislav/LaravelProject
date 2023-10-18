<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-header data="Add Member Page Component" />
    @if(session('user'))
    {{session('user')}} had been added
    @endif
    <form action="/AddMember" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}"><br>
        <input type="text" name="email" placeholder="Email" value="{{ old('email') }}"><br>
        <button type="submit">Add Member</button>
        @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </form>


</body>
</html>