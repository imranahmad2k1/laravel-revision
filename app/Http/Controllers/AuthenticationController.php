<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Helpers\PhoneNumbers;

class AuthenticationController extends Controller
{

    // Retrieving all Users from the Database
    public function getAllUsers(){
        $users = User::all();
        return view('welcome', ['users' => $users]);
    }

    // Registering a New User and storing in Database
    public function createUser(Request $request) {
        $validated = $request->validate([
            'profile_picture' => 'required|mimes:png,jpg',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'country' => 'required',
            'city' => 'required',
            'phone_no' => 'required|digits:11',
            'address' => 'required',
        ]);

        // Saving File Locally and Getting File Path to Store in Database
        $file = $request->file('profile_picture');
        $filename = "pfp".uniqid().'.'.$file->getClientOriginalExtension();
        $directory = "profile_pictures";
        $file_path = $file->storeAs($directory, $filename, 'public');

        // Making a new User in database and copying Request's data into it
        $user = new User();

        $first_name = $request["first_name"];
        $last_name = $request["last_name"];
        $email = $request["email"];
        $password = $request["password"];
        $country = $request["country"];

        // Masking Phone Number before Saving to Database
        $phone_no = PhoneNumbers::formatPhoneNumber($request["phone_no"]);

        $address = $request["address"];
        $city = $request["city"];

        $user->profile_path = $file_path; //File path to the local saved file stored
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->password = $password;
        $user->country = $country;
        $user->phone_no = $phone_no;
        $user->address = $address;
        $user->city = $city;

        $response = $user->save();

        \Session::flash('new_user', "Added New User");
        return $response;     
    }

    public function getUser(String $id){
        $user=User::find($id);
        if($user){
            $response = ["status"=>true, "message"=>"Successfully retrieved User", "data" => $user];
        }
        else{
            $response = ["status"=>false, "message"=>"Something went wrong!"];
        }
        return $response;
    }

    // Updating record of a user in database
    public function updateRecord(Request $request, String $id){
        $validated = $request->validate([
            'profile_picture' => 'required|mimes:png,jpg',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'country' => 'required',
            'city' => 'required',
            'phone_no' => 'required|digits:11',
            'address' => 'required',
        ]);

        $user = User::find($id);
        if($user){
            $user->update($request->all());
            $response = ["status"=>true, "message"=>"Record has been updated"];
        }
        else{
            $response = ["status"=>false, "message"=>"Something went wrong!"];
        }
        return $response;
    }

    // Deleting a record of user from database
    public function deleteRecord(String $id)
    {
        $user = User::find($id);
        if($user){
            \Session::flash('delete_success','Successfully deleted '.$user->first_name);
            $user->delete();
            return redirect('/');
        }
        else{
            \Session::flash('delete_fail', "Error: Couldn't find the user in database");
            return redirect('/');
        }
    }

    // ---------------------IRRELEVANT TO CRUD------------------

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