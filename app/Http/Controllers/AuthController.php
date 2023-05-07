<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(){

         return "Login";
    }

    function logout(){

        return "Logout";

    }

    function register(){

        return "Register";

    }

    function registerUser(Request $request){

        $request->validate([   
            'username' =>'required',
            'email' =>'required|email|unique:users',
          'password' => [
            'required',
            'string',
            'min:10',             // must be at least 10 characters in length
            'regex:/[a-z]/',      // must contain at least one lowercase letter
            'regex:/[A-Z]/',      // must contain at least one uppercase letter
            'regex:/[0-9]/',      // must contain at least one digit
            'regex:/[@$!%*#?&]/', // must contain a special character
        ],
        'cpassword' =>'required|same:password',

        
        ]);

        $Customer = new Customer();
        $Customer->username = $request['username'];
        $Customer->fname = $request['fname'];
        $Customer->lname = $request['lname'];
        $Customer->password =Hash::make( $request['password']);
        $Customer->email = $request['email'];
        $res=$Customer->save();

       if($res){
            return "User Registered";
        }else{
            return "User Not Registered";
        }
        
       }
     

       
    function loginUser(Request $request){

        $request->validate([   
            'email' =>'required|email',
            'password' =>'required'
        ]);

   
        $user =User::where('email','=',$request['email'])->first();
      

       if($user){
        if(Hash::check($request->password,$user->password)){
            return "login successful" ;
        }else{
         return "password not matches";
        }
        }else{
            return "User Not Registered";
        }
        
       }
     

}
