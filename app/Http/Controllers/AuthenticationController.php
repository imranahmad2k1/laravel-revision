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
use Exception;

class AuthenticationController extends Controller
{
    public function index(){
         return view('welcome');
    }

    // Retrieving all Users from the Database
    public function getAllUsers(){
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
        try{
            $validator = Validator::make($request->all(),[
                'profile_picture' => 'required|mimes:png,jpg',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
                'country' => ['required', Rule::in(Helper::getCountries())],
                'city' => 'required',
                'phone_no' => 'required',
                'address' => 'required',
            ]);
    
            if ($validator->fails()){
                parent::setResponse(false,"Invalid inputs!", $validator->errors());
            }
            else{
                // Saving File Locally and Getting File Path to Store in Database
                $file_path = Helper::pictureUpload($request->file('profile_picture'));
        
                // Making a new User in database and copying Request's data into it
                $user = new User();
                $form_collect = $request->all();
                $form_collect['file_path'] = $file_path;
                $user= $user->addUser($form_collect);
                
                if(isset($user->id)){
                    parent::setResponse(true, 'Successfully saved user', $user);
                }
                else{
                    parent::setResponse(false, "Couldn't save user, something went wrong!");
    
                }
            }
    
        }
        catch(Exception $e){
            parent::setResponse(false, $e->getMessage());
        }

        return parent::getResponse(); 
    }

    public function getUser(String $id){
        $user=User::find($id);
        if($user){
            parent::setResponse(true, 'Successfully retrieved User', $user);
        }
        else{
            parent::setResponse(false, "Couldn't get user, something went wrong!");
        }
        return parent::getResponse();
    }

    // Updating record of a user in database
    public function updateRecord(Request $request, String $id){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($id)], // Ignore the current user's email],
            'country' => ['required', Rule::in(Helper::getCountries())],
            'city' => 'required',
            'phone_no' => 'required',
            'address' => 'required',
        ]);
        // Applying validation on profile_picture only when it is available in the request 
        $validator->sometimes('profile_picture', 'mimes:png,jpg', function ($input) {
            return $input->hasFile('profile_picture');
        });

        if ($validator->fails()){
            parent::setResponse(false, 'Invalid inputs!', $validator->errors());
        }
        else{
            $user = User::find($id);
            if($user){
                // Only when request has profile picture, uploading it to local storage
                if($request->hasFile('profile_picture')){
                    $file_path = Helper::pictureUpload($request->file('profile_picture'));

                    // Setting profile_path in database
                    $user->profile_path = $file_path;
                }

                // profile_path for profile_picture already set above
                $user->update($request->except('profile_picture'));
                parent::setResponse(true, 'Record has been updated');
            }
            else{
                parent::setResponse(false, "Couldn't find user in the Database");
            }
        }
      
        return parent::getResponse();
    }

    // Deleting a record of user from database
    public function deleteRecord(String $id)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
            parent::setResponse(true, 'User has been deleted successfully');
        }
        else{
            parent::setResponse(false, "Couldn't delete user, something went wrong!");
        }
        return parent::getResponse();
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