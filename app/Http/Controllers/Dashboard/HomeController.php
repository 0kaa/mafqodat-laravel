<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Station;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {

        $items = Item::get()->count();

        $latest_items = Item::orderBy('created_at', 'desc')->take(3)->get();

        $delivered_items = Item::where('is_delivered', '1')->get()->count();

        $stations = Station::get()->count();

        $employees = User::whereDoesntHave('roles')->get()->count();

        $lost_items = Item::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month')
        )->get()->groupBy('month');

        return view('dashboard.home', compact('items', 'delivered_items', 'stations', 'employees', 'lost_items', 'latest_items'));
    }
}
