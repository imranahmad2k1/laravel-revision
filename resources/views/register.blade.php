<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | TestApp</title>
</head>
<body>
    <h1>Register a User</h1>
    <form action="{{ route('store') }}" method="post">
        @csrf
        <label for="first_name"><b>First Name</b></label>
        <input type="text" placeholder="Enter your First Name" name="first_name" required>

        <br><br>

        <label for="last_name"><b>Last Name</b></label>
        <input type="text" placeholder="Enter your Last Name" name="last_name" required>

        <br><br>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter your Email" name="email" required>

        <br><br>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <br><br>

        <label for="country"><b>Country</b></label>
        <input type="text" placeholder="Enter your Country" name="country" required>

        <br><br>

        <label for="phone_no"><b>Phone Number</b></label>
        <input type="text" placeholder="Enter your Phone Number" name="phone_no" required>

        <br><br>

        <label for="address"><b>Address</b></label>
        <input type="text" placeholder="Enter your Address" name="address" required>

        <br><br>

        <label for="city"><b>City</b></label>
        <input type="text" placeholder="Enter your City" name="city" required>

        <br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>