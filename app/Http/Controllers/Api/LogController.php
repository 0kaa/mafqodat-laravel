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

    public function getAllLogs(Request $request)
    {
        $user = auth()->user();

        if (isset($request->all) && $request->all == 'true') {
            return $this->apiResponse('', LogResource::collection($user->logs()->get()), 200);
        }

        $logs = $user->logs()->paginate(8);

        $logs->transform(function ($log) {
            return new LogResource($log);
        });

        return $this->apiResponse('', new PaginationResource($logs), 200);
    }
}
