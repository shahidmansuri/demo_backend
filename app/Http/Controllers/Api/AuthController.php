<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Register User
     * Required Params: email, password, name
     * Note: Email should be unique
     */
    public function register(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'name' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return ResponseHelper::error('error', $validator->errors());
        }
        $user = User::create([
            'email'    => $request->email,
            'password' => $request->password,
            'name'     => $request->name
         ]);
        if($user){
            $token = auth('api')->login($user);
            return ResponseHelper::success($this->respondWithToken($token), 'Login Successful');
        }
        else{
            return ResponseHelper::error('error', 'Not able to create user');
        }
        return ResponseHelper::error('error', 'Not able to create user');
    }

    /**
     * Login User
     * Required Params: email, password
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = JWTAuth::attempt($credentials)) {
            return ResponseHelper::error($token, 'Unauthorized');
        }
        return ResponseHelper::success($this->respondWithToken($token), 'Login Successful');
    }

    /**
     * Logout User
     * User token from Auth header
     */
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Response helper to setup token
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60
        ]);
    }

    
}
