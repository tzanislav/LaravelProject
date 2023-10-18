<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>
    <style>
        tr{
            border: 1px solid black;
        }
    </style>
</head>
<body>

    <table>
        <tr>

            <th>Email</th>
            <th>First Name</th>

        </tr>
        

        @foreach($collection as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
        </tr>  
        @endforeach
    </table>

    @if($errors->any())

    <div>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach

        </ul>
    </div>
    @endif

    <form action="users" method="POST" >
        {{method_field('PUT')}}
        @csrf       
        <input type="text" name="first_name" placeholder="First Name">

        <input type="text" name="email" placeholder="Email">
        <button type="submit">Submit</button>
    </form>
    

</body>
</html>