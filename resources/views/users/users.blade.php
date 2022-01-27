<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
</head>
<body>
    <table style="">
        <thead>
            {{-- <th>Avatar</th> --}}
            <th>Name</th>
            <th>Email</th>
            <th colspan="2">Modifications</th>
        </thead>
        @foreach ($users as $user)
        <tr>
            {{-- <td><img src="{{asset($usr->avatar_link)}}" alt=""></td> --}}
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                <form action="/users/delete/{{$user->id}}" method="post">
                    @csrf
                    <input type="submit" value="Delete">
                </form>
            </td>
            <td><button onclick="location.href='/users/edit/{{$user->id}}'">Edit</button></td>
            
        </tr>
        @endforeach
    </table>
</body>
</html>