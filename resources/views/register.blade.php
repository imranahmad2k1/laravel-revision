<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | TestApp</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style>
    .error{
        color: red;
    }
</style>
</head>
<body>
    <h1>Register a User</h1>
    <div class="col-md-12">
        <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="profile_picture"><b>Profile picture</b></label>
                <input type="file" name="profile_picture">
                @error('profile_picture')
                    <br><em class="error">{{ $message }}</em>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="first_name"><b>First Name</b></label>
                <input type="text" placeholder="Enter your First Name" name="first_name">
                @error('first_name')
                    <br><em class="error">{{ $message }}</em>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="last_name"><b>Last Name</b></label>
                <input type="text" placeholder="Enter your Last Name" name="last_name">
                @error('last_name')
                    <br><em class="error">{{ $message }}</em>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter your Email" name="email">
                @error('email')
                    <br><em class="error">{{ $message }}</em>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password">
                @error('password')
                    <br><em class="error">{{ $message }}</em>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="country"><b>Country</b></label>
                <input type="text" placeholder="Enter your Country" name="country">
                @error('country')
                    <br><em class="error">{{ $message }}</em>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="phone_no"><b>Phone Number</b></label>
                <input type="text" placeholder="Enter your Phone Number" name="phone_no">
                @error('phone_no')
                    <br><em class="error">{{ $message }}</em>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="address"><b>Address</b></label>
                <input type="text" placeholder="Enter your Address" name="address">
                @error('address')
                    <br><em class="error">{{ $message }}</em>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="city"><b>City</b></label>
                <input type="text" placeholder="Enter your City" name="city">
                @error('city')
                    <br><em class="error">{{ $message }}</em>
                @enderror
            </div>
    
            <button class="btn btn-primary" type="submit">Register</button>
        </form>
    </div>
</body>
</html>