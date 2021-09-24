<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

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
        $user_data['password'] = Hash::make($request->password);

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
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // attempt to log in
        $logged_in = auth('web')->attempt($login_data);

        // handle failed login attempt
        if (!$logged_in) {
            return response()->json([ 'message' => 'Incorrect Login.' ], 401);
        }

        // generate a new API token for the user
        $token = auth('web')->user()->createToken('API Token')->accessToken;

        return response()->json([ 'user' => auth('web')->user(), 'token' => $token ]);
    }

    public function forgotPassword(Request $request) 
    {
        // validate the forgot password request
        $request->validate([
            'email' => 'required|email'
        ]);

        // generate and send forgot password email
        $reset_status = Password::sendResetLink(
            $request->only('email')
        );

        // catch all errors
        if ($reset_status !== Password::RESET_LINK_SENT) {
            return response()->json([ 'message' => 'Error: ' . __($reset_status) ], 404);
        }

        return response()->json([ 'message' => "Password reset email sent." ]);
    }

    public function resetPassword(Request $request)
    {
        // validate the reset password request
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed'
        ]);

        // attempt to save the new password
        $reset_status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'), 
            function($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        // catch all errors
        if ($reset_status !== Password::PASSWORD_RESET) {
            return response()->json([ 'message' => 'Error: ' . __($reset_status) ], 400);
        }

        return response()->json([ 'message' => 'Password reset successful.' ]);
    }
}
