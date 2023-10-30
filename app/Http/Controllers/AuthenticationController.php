<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Helpers\PhoneNumbers;
use App\Helpers\Countries;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DataTables;

class AuthenticationController extends Controller
{
    public function index(){
         return view('welcome');
    }

    // Retrieving all Users from the Database
    public function getAllUsers(){
        // $users = User::all();
        // if($users){
        //     $response = ["status"=>true, "message"=>"Successfully retrieved all users", "data"=>$users];
        // }
        // else{
        //     $response = ["status"=>false, "message"=>"Couldn't retrieve users, something went wrong"];
        // }
        // return $response;


        $data = User::latest()->get();
        return Datatables::of($data)
                ->addColumn('action', function($user){     
                    return view('components.useractions', compact('user'))->render();                
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    // Registering a New User and storing in Database
    public function createUser(Request $request) {

        // Phone number cleaning before 11 digits validation
        $phone_no = $request->input('phone_no');
        $cleanedPhoneNo = preg_replace('/\D/', '', $phone_no);

        $validator = Validator::make([
            'phone_no' => $cleanedPhoneNo,
            'profile_picture' => $request->file('profile_picture'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
        ], [
            'profile_picture' => 'required|mimes:png,jpg',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'country' => ['required', Rule::in(Helper::getCountries())],
            'city' => 'required',
            'phone_no' => 'required|digits:11',
            'address' => 'required',
        ]);

        if ($validator->fails()){
            return $response = ["status"=>false, "message"=>"Invalid inputs!", "data" => $validator->errors()];
        }

        // Saving File Locally and Getting File Path to Store in Database
        $file_path = Helper::pictureUpload($request->file('profile_picture'));

        // Making a new User in database and copying Request's data into it
        $user = new User();

        $first_name = $request["first_name"];
        $last_name = $request["last_name"];
        $email = $request["email"];
        $password = $request["password"];
        $country = $request["country"];
        $phone_no = $request["phone_no"];
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

        $user->save();

        if(isset($user->id)){
            \Session::flash('new_user', "Added New User");
            $response = ["status"=>true, "message"=>"Successfully saved user", "data" => $user];
        }
        else{
            $response = ["status"=>false, "message"=>"Couldn't save user, something went wrong!"];
        }
        return $response; 
    }

    public function getUser(String $id){
        $user=User::find($id);
        if($user){
            $response = ["status"=>true, "message"=>"Successfully retrieved User", "data" => $user];
        }
        else{
            $response = ["status"=>false, "message"=>"Couldn't get user, something went wrong!"];
        }
        return $response;
    }

    // Updating record of a user in database
    public function updateRecord(Request $request, String $id){
        // Phone number cleaning before 11 digits validation
        $phone_no = $request->input('phone_no');
        $cleanedPhoneNo = preg_replace('/\D/', '', $phone_no);

        $validator = Validator::make([
            'phone_no' => $cleanedPhoneNo,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
        ], [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'country' => ['required', Rule::in(Helper::getCountries())],
            'city' => 'required',
            'phone_no' => 'required|digits:11',
            'address' => 'required',
        ]);

        if ($request->hasFile('profile_picture')) {
            $validator->sometimes('profile_picture', 'mimes:png,jpg', function ($input) {
                return $input->hasFile('profile_picture');
            });
        }

        if ($validator->fails()){
            return $response = ["status"=>false, "message"=>"Invalid inputs!", "data" => $validator->errors()];
        }
        
        $user = User::find($id);
        
        if($user){
            if($request->hasFile('profile_picture')){
                $file_path = Helper::pictureUpload($request->file('profile_picture'));
                $user->profile_path = $file_path;
            }
            $user->update($request->except('profile_picture'));
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
            $response = ["status"=>true, "message"=>"User has been deleted successfully"];
        }
        else{
            \Session::flash('delete_fail', "Error: Couldn't find the user in database");
            $response = ["status"=>false, "message"=>"Couldn't delete user, something went wrong!"];
        }
        return $response;
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