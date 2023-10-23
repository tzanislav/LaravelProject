<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs View</title>
</head>
<body>
    <x-header data="Logs" />
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
            <td>
                @if(is_array($log->content))
                    @foreach($log->content as $key => $value)
                        {{ $key }} : {{ $value }} 
                    @endforeach
                @else
                {{ $log->content }}
                @endif
            </td>
            <td>{{ $log->owner }}</td>
            <td>{{ $log->created_at }}</td>
        </tr>
        @endforeach
    </table>








</body>
</html>
