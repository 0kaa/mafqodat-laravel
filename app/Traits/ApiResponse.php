<?php

namespace App\Traits;

trait ApiResponse
{
    public function apiResponse($message, $data = [], $status = 200)
    {
        return response([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }
}
