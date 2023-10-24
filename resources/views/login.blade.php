<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | TestApp</title>
</head>
<body>
    <h1>Login a User</h1>
    <form action="{{ route('authenticate') }}" method="post">
        @csrf
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Username" name="email" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <button type="submit">Login</button>
    </form>
</body>
</html>