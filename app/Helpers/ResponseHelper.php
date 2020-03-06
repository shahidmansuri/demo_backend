<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class ResponseHelper
{
    /**
     * Return success response for API
     * Params: $data, $message
     * Note: $data can be array or string, $message should be string
     */
    public static function success($data, $message = 'success'){
        return [
            'status' => 200,
            'data'   => $data,
            'message' => $message
        ];
    }

    /**
     * Return error response for API
     * Params: $data, $message
     * Note: $data can be array or string, $message should be string
     */
    public static function error($message = 'error'){
        return [
            'status' => 401,
            'message' => $message
        ];
    }
}