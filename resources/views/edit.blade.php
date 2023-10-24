<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update a User | TestApp</title>
</head>
<body>
    <h1>Update User</h1>
    <form action="{{ route('edit',$data->id) }}" method="post">
        @csrf
        @method('PUT')
        <label for="first_name"><b>First Name</b></label>
        <input type="text" placeholder="Enter your First Name" name="first_name" value="{{$data->first_name}}", value="{{$data->first_name}}" required>

        <br><br>

        <label for="last_name"><b>Last Name</b></label>
        <input type="text" placeholder="Enter your Last Name" name="last_name" value="{{$data->last_name}}" required>

        <br><br>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter your Email" name="email" value="{{$data->email}}" required>

        <br><br>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" value="{{$data->password}}" required>

        <br><br>

        <label for="country"><b>Country</b></label>
        <input type="text" placeholder="Enter your Country" name="country" value="{{$data->country}}" required>

        <br><br>

        <label for="phone_no"><b>Phone Number</b></label>
        <input type="text" placeholder="Enter your Phone Number" name="phone_no" value="{{$data->phone_no}}" required>

        <br><br>

        <label for="address"><b>Address</b></label>
        <input type="text" placeholder="Enter your Address" name="address" value="{{$data->address}}" required>

        <br><br>

        <label for="city"><b>City</b></label>
        <input type="text" placeholder="Enter your City" name="city" value="{{$data->city}}" required>

        <br><br>

        <button type="submit">Update Record</button>
    </form>
</body>
</html>