<?php

namespace App\Helpers;

class ResponseHelper
{   
    /**
     * @param array $data
     * @param string $message
     * @param integer $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data = null, $message = 'Success', $statusCode = 200)
    {
        return response()->json([
            'data'    => $data,
            'message' => $message,
            'success' => true
        ], $statusCode);
    }  

    /**
     * @param array $data
     * @param string $message
     * @param integer $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function failure($data = null, $message = 'Error', $statusCode = 400)
    {
        return response()->json([
            'data'    => $data,
            'error'   => [
                'message'   => $message,
                'success' => false
            ]
        ], $statusCode);
    }

}