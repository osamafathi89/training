<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if ($user->save()) {
            $tokenResult = $user->createToken("my Token");
            $token = $tokenResult->plainTextToken;
            return response()->json([
                'message' => 'Registered',
                'token' => $token,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Sit here',

            ], 404);
        }
    }
    function userLogin(Request $request)
    {

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;
        $user['token'] = $token;
        return response()->json($user);
    }
    function userLogout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'logged Out'
        ]);
    }
    function userData(Request $request)
    {
        $user=$request->user();
        return response()->json($user);
    }
}
