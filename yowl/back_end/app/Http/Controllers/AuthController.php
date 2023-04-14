<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\AccessToken;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
session_start();

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $user = user::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([ 'message' => 'Invalid credential' ]);
            }

            $check = Hash::check($request->password, $user->password);
            if (!$check) {
                return response()->json([ 'message' => 'Invalid credential' ]);
            }
            if($user)
            {
            $accessToken =Str::random(255);
            $user->token=$accessToken;        
            $user->save();
            return response()->json([ 'access_token' =>  $accessToken,'isAdmin'=>$user->isAdmin]);
        }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function logout($token)
    {
        try {
            $accessToken = user::where('token', $token)->first();
            if ($accessToken) {
                session_destroy();
                session_unset();
                $accessToken->delete();
                return response()->json([ 'success' => true ]);
            }
            
            return response()->json([ 'success' => false ]); 
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
