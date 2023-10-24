<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Welcome | TestApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    h1{
        text-align: center;
    }
    th, td{
        padding: 10px;
        border: 1px solid black;
    }
    #usersTable{
        margin-right: auto;
        margin-left: auto;
    }
</style>
</head>
<body>
    <div class="text-center">
        <a href="{{ url('/register') }}" class="btn btn-primary">Create a New User</a>
        <!-- <button onclick="window.location='{{ url("users/index") }}'">Create a user</button> -->
    </div>

    <br><br>
    @if(Session::has('flash_message'))
    <div class="alert alert-success"><em> {!! session('flash_message') !!}</em></div>
    @endif
    <div id="usersTable">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ">
            <div class="main bg-light border p-4 table-responsive">
            <table class="table">
            <thead>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Country</th>
                <th>Phone No</th>
                <th>Address</th>
                <th>City</th>
                <th>Actions</th>
            </thead>
            @foreach($users as $key => $data)
            <tr>
                <td>{{$data->first_name}}</td>
                <td>{{$data->last_name}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->country}}</td>
                <td>{{$data->phone_no}}</td>
                <td>{{$data->address}}</td>
                <td>{{$data->city}}</td>
                <td>
                    <!-- <a href="{{ url('edit/'.$data->id) }}" class="btn btn-success">Edit</a> -->
                    <a href="{{ route('edit',$data->id) }}" class="btn btn-success">Edit</a>
                    <a href="{{ url('delete/'.$data->id) }}" class="btn btn-danger">Delete</a>
                    <!-- <a href="#" class="btn btn-primary">View</a> -->
                </td>
            </tr>
            @endforeach
        </table>
                </div>
            </div>
    </div>
</body>
</html>