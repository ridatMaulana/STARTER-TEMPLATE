<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Login(Request $req)
    {
        $user = User::where('email', $req->email)->first();

        if (!$user || !Hash::check($req->password, $user->password)) {
            return response()->json([
                'message' => "Unauthorized",
            ],401);
        }

        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json([
            'message' => "Success",
            'user' => $user,
            'token' => $token
        ],200);
    }
}
