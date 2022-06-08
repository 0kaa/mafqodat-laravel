<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Models\Station;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    use ApiResponse;

    public function getAllReports()
    {
        $user = auth()->user();
        $itemsCount = Item::where('user_id', $user->id)->count();

        $delivered_items = Item::where('is_delivered', 1)->where('user_id', $user->id)->count();

        $stations = Station::count();

        $metro_stations = Station::where('type', 'metro')->count();

        $bus_stations = Station::where('type', 'bus')->count();

        $employees = User::doesntHave('roles')->count();

        $latestFiveItems = Item::where('user_id', $user->id)->take(9)->orderBy('created_at', 'desc')->get();

        $itemsList = [];

        for ($i = 1; $i <= 12; $i++) {
            $query = Item::select(DB::raw('count(id) as `data`'), DB::raw('YEAR(date) year, MONTH(date) month'))->groupby('year', 'month')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', $i)->where('user_id', $user->id)->first();
            $itemsList[] = $query ? $query->data : 0;
        }

        return $this->apiResponse('', [
            'items'     => ItemResource::collection($latestFiveItems),
            'statistics' => [
                'items' => $itemsCount,
                'delivered_items' => $delivered_items,
                'stations' => $stations,
                'employees' => $employees,
                'metro_stations' => $metro_stations,
                'bus_stations' => $bus_stations
            ],
            'counts' => $itemsList
        ], 200);
    }
}
