<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Http\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
use HttpResponses; 

public function register(RegisterRequest $request){

    $request->validated($request->all());
    


    $user=User::create([

        "name"=> $request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'username'=>$request->username,
        'is_admin'=> 0
        
    ]);

    return $this->success([
'user'=>$user,
'token'=> $user->createToken("API Token of ". $user->name)->plainTextToken

    ],"You've been registered",200);
    
    }

    public function login(LoginController $request){
$request->validated($request->all());
//Verifying whether the user exists in DB if it is,let  him pass if not, ban him from logging in 
if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
    return $this->error('',"The Credentials didn't match");
}

$user=User::where('email','=',$request->email)->first();

return $this->success([
'user'=> $user,
'token'=> $user->createToken('API Token of'. $user->name)->plainTextToken

],'You have logged in successfully',200);






    }

public function logout(Request $request){




Auth::user()->CurrentAccessToken()->delete();
return $this->success('','you have logged out');


}


}
