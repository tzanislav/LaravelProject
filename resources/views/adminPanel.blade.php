<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<x-header data="Logs" />
    <h5>Admin Panel</h5>
    @foreach ($users as $user)
        <p>This is user {{ $user->name }}</p>
        <form action="/admin/{{$user->id}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <input type="text" name="clearance" value="{{ $user->clearance }}">
            <input type="submit" value="Update">
        </form>
    @endforeach



</body>
</html>