<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{
    public function response($user){

        $token = $user->createToken( str()->random(40) )->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'token_type'=>'Bearer'
        ]);
    }

    public function login(Request $request){

        $cred = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        if (!Auth::attempt( $cred)) {
            return response()->json([
                'message' => 'Unauthorized.'
            ]);
        }

        return $this->response(Auth::user());
    }
}
