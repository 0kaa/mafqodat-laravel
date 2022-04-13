<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Http\Resources\StationResource;
use App\Models\Item;
use App\Models\Station;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ApiResponse;

    public function latestItems()
    {
        $latest_items = Item::latest()->take(3)->get();

        if($latest_items->isNotEmpty()) {
            return $this->apiResponse('', ItemResource::collection($latest_items), 200);
        } else {
            return $this->apiResponse('', [], 404);
        }
    }

    public function locations()
    {
        $locations = Station::select('lat', 'lng')->get();

        if($locations->isNotEmpty()) {
            return $this->apiResponse('', StationResource::collection($locations), 200);
        } else {
            return $this->apiResponse('', [], 404);
        }
    }
}
