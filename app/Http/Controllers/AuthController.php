<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use App\Http\Controllers\Controller;



class AuthController extends Controller 
{
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
   public function getAllUsers(){
       $allUsers = User::get();
       return response()->json($allUsers,200);
   } 
  

    public function process_signin(Request $request)
    {
        

        $validationResult = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);

        $user = User::where('email',$request->email)->first();

        if (auth()->attempt($credentials)) {

            return response()->json([
                'success'=>'true'
            ],200);

        }else{
            return response()->json([
                'failed'=>'true'
            ],401);
        }
    }


    public function process_signup(Request $request)
    {   
        error_log('HITTING THE PROCESS_SIGNUP API');
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
 
        $user = User::create([
            'first_name' => trim($request->input('first_name')),
            'last_name' => trim($request->input('last_name')),
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),
        ]);

        // session()->flash('message', 'Your account is created');
       
        return response()->json($user,200);
    }
    
}

