<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members list</title>
    <style>

        .w-5{
            position: relative;
            height: 64px;
            top: 28px;
        }

    </style>
</head>
<body>
    <x-header data="Members list Page Component" />
    <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th> Delete </th>
        </tr>
        @foreach($users as $item)
        <tr>
            <td>{{$item['id']}}</td>
            <td>{{$item['name']}}</td>
            <td>{{$item['email']}}</td>
            <td><a href={{"delete/".$item['id'] }} method="delete"> Del</a></td>

        </tr>
        @endforeach
    </table>

    <ul class="pagination">
        {{$users->links()}}
    </ul>
</body>


</html>