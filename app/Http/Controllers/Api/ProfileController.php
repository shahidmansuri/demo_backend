<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProfileController extends Controller
{
    /**
     * Get User Data
     * User token from header to get user data
     */
    public function user(){
        $user = JWTAuth::parseToken()->authenticate();
        if($user){
            return ResponseHelper::success($user);
        }
        return ResponseHelper::error('Not found');
    }
}
