<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    /**
     * authorizing the user
     */

     public function login(Request $request)
     {
        // asking username&password

        // validate input
        $data = $request->validate([
            'email'=> 'required|email',
            'password'=>'required|string'
        ]);        
        // cross check with existing table
        $user = User::where('email', $data['email'])->first();

        if($user && Hash::check($data['password'],$user->password)){
        // generate token
                $token = $user->createToken('API Token')->plainTextToken;
                return response()->json([
                    'message'=>'Login Success',
                    'data'=>[
                        'token'=>$token,
                        'user'=>$user
                    ]
                    ]);
            }
        
        abort(404,'User not registered.');
        // return token to user

     }

     public function logout()
     {
        // delete toke from DB=>cannot cross check=>invalid token
        Auth::user()->tokens->last()->delete();
        return "success logout";
     }
}
