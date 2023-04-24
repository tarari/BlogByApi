<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'string|required|min:6',
                'password' => 'required|string|confirmed',
                'email' => 'email|required|unique:users'
            ]);
            $user = new User([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user->save();
            return response()->json([
                'success' => true,
                'data' => 'Successful user created'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    /**
     * login function
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        try {
            $validated = Validator::make($request->all(), [
                'email'=>'required|email',
                'password'=>'required'
            ]);
            if($validated->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>'validation error',
                    'errors'=>$validated->errors()
                ],401);
            }
            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status'=>false,
                    'message'=>'Email & password does not match',

                ],401);
            }
            $user=User::where('email',$request->email)->first();

            return response()->json([
                'status'=>true,
                'message'=>'user validated correctly',
                'token'=>$user->createToken('PIO TOKEN')
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
