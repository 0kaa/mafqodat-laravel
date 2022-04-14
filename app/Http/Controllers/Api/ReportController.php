<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Station;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    use ApiResponse;

    public function dataCount()
    {
        $items = Item::count();

        $delivered_items = Item::where('is_delivered', 1)->count();

        $stations = Station::count();

        $metro_stations = Station::where('type', 'metro')->count();

        $bus_stations = Station::where('type', 'bus')->count();

        $employees = User::count();

        return $this->apiResponse('', [
            'items' => $items,
            'delivered_items' => $delivered_items,
            'stations' => $stations,
            'employees' => $employees,
            'metro_stations' => $metro_stations,
            'bus_stations' => $bus_stations
        ], 200);
    }

    public function itemsStatistics()
    {
        $items = Item::select(DB::raw('count(id) as `data`'), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->groupby('year', 'month')
            ->get();

        if ($items->isNotEmpty()) {
            return $this->apiResponse('', $items, 200);
        } else {
            return $this->apiResponse('', [], 404);
        }
    }
}
