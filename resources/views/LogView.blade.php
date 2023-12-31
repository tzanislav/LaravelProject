<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs View</title>
    <link rel="stylesheet" href="/css/style.css">

</head>
<body>
    <x-header data="Logs" />
    
    <br>
    <div class="inputBox" style="width:80%">
        <img src = "https://laravel-tzani.s3.eu-west-1.amazonaws.com/img/Logo+Black.png" class="adimariLogoMid">
        <br>
        <br>
        <br>
        <table>
            <tr>
                <th>Log ID</th>
                <th>Type</th>
                <th>Content</th>
                <th>Owner</th>
                <th>Created At</th>
            </tr>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->type }}</td>
                <td>{{ $log->content }}</td>
                <td>{{ $log->owner }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
