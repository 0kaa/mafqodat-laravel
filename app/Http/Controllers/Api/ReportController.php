<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Models\Station;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    use ApiResponse;

    // public function getCount()
    // {
    //     $items = Item::count();

    //     $delivered_items = Item::where('is_delivered', 1)->count();

    //     $stations = Station::count();

    //     $metro_stations = Station::where('type', 'metro')->count();

    //     $bus_stations = Station::where('type', 'bus')->count();

    //     $employees = User::whereDoesntHave('roles')->count();
    // }

    public function latestItems()
    {
        $latest_items = Item::latest()->take(3)->get();

        if($latest_items->isNotEmpty()) {
            return $this->apiResponse('', ItemResource::collection($latest_items), 200);
        } else {
            return $this->apiResponse('', [], 404);
        }

    }
}
