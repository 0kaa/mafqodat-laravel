<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LogResource;
use App\Models\Log;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class LogController extends Controller
{
    use ApiResponse;

    public function getAllLogs()
    {
        $logs = Log::get();

        if ($logs->isNotEmpty()) {
            return $this->apiResponse('', LogResource::collection($logs), 200);
        }
    }
}
