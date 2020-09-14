<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;


class ResponseHelper
{   

    public static function Encapsulate($data, $message, $statusCode, $success)
    {
        return response()->json([
            'data'            => $data,
            'message'         => $message,
            'success'         => $success,
            'isAuthenticated' => Auth::guard('api')->user() ? true : false,//Auth::user() ? true : false,
            'isAdmin'         => false
        ], $statusCode);
    }

    /**
     * @param array $data
     * @param string $message
     * @param integer $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data = null, $message = 'Success', $statusCode = 200)
    {
        return self::Encapsulate($data, $message, $statusCode, true);
        // response()->json([
        //     'data'            => $data,
        //     'message'         => $message,
        //     'success'         => true
        // ], $statusCode);
    }  

    /**
     * @param array $data
     * @param string $message
     * @param integer $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function failure($data = null, $message = 'Error', $statusCode = 400)
    {
        
        return self::Encapsulate($data, $message, $statusCode, false);
        // return response()->json([
        //     'data'    => $data,
        //     'error'   => [
        //         'message'   => $message,
        //         'success' => false
        //     ]
        // ], $statusCode);
    }

}