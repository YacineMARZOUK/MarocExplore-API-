<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name'  => 'required',
            'email' =>  'required|unique:users|email',
            'password' =>'required|confirmed'
        ]);

        $createUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $createUser->createToken('apptoken')->plainTextToken;
        if($createUser){
            return response()->json([
                'message' => 'The user has been created successfully !',
                'token'   => $token
            ], 200);
        }else{
            return response()->json([
                'message' => 'ther emust be an error creating the user, check again.'
            ], 500);
        }
    }    
}
