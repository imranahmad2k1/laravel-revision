<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update a User | TestApp</title>
</head>
<body>
    <h1>Update User</h1>
    <form action="{{ route('edit',$user->id) }}" method="post">
    @csrf
        @method('PUT')
        <label for="first_name"><b>First Name</b></label>
        <input type="text" placeholder="Enter your First Name" name="first_name" value="{{$user->first_name}}", value="{{$user->first_name}}">

        <br><br>

        <label for="last_name"><b>Last Name</b></label>
        <input type="text" placeholder="Enter your Last Name" name="last_name" value="{{$user->last_name}}">

        <br><br>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter your Email" name="email" value="{{$user->email}}">

        <br><br>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" value="{{$user->password}}">

        <br><br>

        <label for="country"><b>Country</b></label>
        <input type="text" placeholder="Enter your Country" name="country" value="{{$user->country}}">

        <br><br>

        <label for="phone_no"><b>Phone Number</b></label>
        <input type="text" placeholder="Enter your Phone Number" name="phone_no" value="{{$user->phone_no}}">

        <br><br>

        <label for="address"><b>Address</b></label>
        <input type="text" placeholder="Enter your Address" name="address" value="{{$user->address}}">

        <br><br>

        <label for="city"><b>City</b></label>
        <input type="text" placeholder="Enter your City" name="city" value="{{$user->city}}">

        <br><br>

        <button type="submit">Update Record</button>
    </form>
</body>
</html>