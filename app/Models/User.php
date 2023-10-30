<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'country',
        'phone_no',
        'address',
        'city',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function addUser($obj){
        return \DB::transaction(function () use($obj){
            $user = new User();
        
            $user->first_name = $obj["first_name"];
            $user->last_name = $obj["last_name"];
            $user->email = $obj["email"];
            $user->password = $obj["password"];
            $user->country = $obj["country"];
            $user->phone_no = $obj["phone_no"];
            $user->address = $obj["address"];
            $user->city = $obj["city"];
    
            $user->profile_path = $obj['file_path'];
    
            $user->save();
    
            return with($user);
            
        });
    }

    // public function updateUser($obj, $user){
    //     return \DB::transaction(function () use($obj, $user){
    //         $user->first_name = $obj["first_name"];
    //         $user->last_name = $obj["last_name"];
    //         $user->email = $obj["email"];
    //         $user->password = $obj["password"];
    //         $user->country = $obj["country"];
    //         $user->phone_no = $obj["phone_no"];
    //         $user->address = $obj["address"];
    //         $user->city = $obj["city"];
    
    //         if(array_key_exists('file_path', $obj)){
    //             $user->profile_path = $obj['file_path'];
    //         }
    
    //         $user->save();
    
    //         return with($user);
            
    //     });
    // }
}
