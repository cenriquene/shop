<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
        Register Api
    */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|unique:users|max:255',
            'password'  => 'required|string|min:6|confirmed'
        ]);

        if ( $validator->fails() ) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->all());

        $token = $user->createToken("There is a snake in my boot")->accessToken;

        return response(['token' => $token], 200);
    }

    /*
        Login Api
    */
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ( $user ) {
            $is_valid_password = Hash::check($request->password, $user->password);
            if ( $is_valid_password ) {
                $token = $user->createToken("There is a snake in my boot")->accessToken;

                return response(['token' => $token], 200);
            } else {
                return response('Invalid user or password', 200);
            }
        }
    }

    /*
        Logout and revoke user token
    */
    public function logout() {
        $token = $request->user()->token();
        $token->revoke();

        return response('Logout successfully', 200);
    }
}
