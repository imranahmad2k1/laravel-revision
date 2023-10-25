<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthenticationController extends Controller
{

    // Retrieving all Users from the Database
    public function getUsers(){
        $users = User::all();
        return view('welcome', ['users' => $users]);
    }

    // Registering a New User and storing in Database
    public function store(Request $request) {
        
        // dd($request);
        $validated = $request->validate([
            'profile_picture' => 'required|mimes:png,jpg',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'country' => 'required',
            'city' => 'required',
            'phone_no' => 'required',
            'address' => 'required',
        ]);

        $file = $request->file('profile_picture');
        $filename = "pfp".uniqid().'.'.$file->getClientOriginalExtension();
        $directory = "profile_pictures";
        $file_path = $file->storeAs($directory, $filename, 'public');


        $user = new User();

        $first_name = $request["first_name"];
        $last_name = $request["last_name"];
        $email = $request["email"];
        $password = $request["password"];
        $country = $request["country"];
        $phone_no = $request["phone_no"];
        $address = $request["address"];
        $city = $request["city"];

        $user->profile_path = $file_path;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->password = $password;
        $user->country = $country;
        $user->phone_no = $phone_no;
        $user->address = $address;
        $user->city = $city;

        $user->save();

        // return redirect('/');        
    }


    // Updating record of a user in database
    public function saveRecord(Request $request, User $user){
        $user->update($request->all());

        return redirect('/');
    }

    // Deleting a record of user from database
    public function deleteRecord(User $user){
        \Session::flash('flash_message','Successfully deleted '.$user->first_name);
        $user->delete();
        return redirect('/');
    }

    // Authenticating a user and Redirecting to Homepage
    public function authenticate(Request $request) {

        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];

        if(Auth::attempt($credentials)) {
            return view('homepage');       
        }

        return 'Failure'; 
    }

}