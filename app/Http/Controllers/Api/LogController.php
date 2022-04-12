<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LogResource;
use App\Http\Resources\PaginationResource;
use App\Models\Log;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class LogController extends Controller
{
    use ApiResponse;

    public function getAllLogs()
    {
        $logs = Log::paginate(8);

        $logs->transform(function ($log) {
            return new LogResource($log);
        });

        if ($logs->isNotEmpty()) {
            return $this->apiResponse('', new PaginationResource($logs), 200);
        } else {
            return $this->apiResponse('', [], 200);
        }
    }
}
