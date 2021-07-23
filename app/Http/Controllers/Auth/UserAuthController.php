<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        // validate the registration request
        $user_data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        // hash the user's password
        $user_data['password'] = bcrypt($request->password);

        // create the new user
        $user = User::create($user_data);

        // generate an API token for the user
        $token = $user->createToken('API Token')->accessToken;

        return response()->json([ 'user' => $user, 'token' => $token ]);
    }

    public function login(Request $request)
    {
        // validate the login request
        $login_data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        // attempt to log in
        $logged_in = auth()->attempt($login_data);

        // handle failed login attempt
        if (!$logged_in) {
            return response()->json([ 'message' => 'Incorrect Login.' ], 401);
        }

        // generate a new API token for the user
        $token = auth()->user()->createToken('API Token')->accessToken;

        return response()->json([ 'user' => auth()->user(), 'token' => $token ]);
    }
}
