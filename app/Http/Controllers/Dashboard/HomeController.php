<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Station;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {

        $categories = Category::take(4)->get();

        $latest_items = Item::latest()->take(3)->get();

        $stations = Station::get();

        return view('dashboard.home', compact('categories', 'stations', 'latest_items'));
    }

    public function reports()
    {

        $items = Item::count();

        $latest_items = Item::orderBy('created_at', 'desc')->take(3)->get();

        $delivered_items = Item::where('is_delivered', '1')->count();

        $stations_count = Station::count();

        $employees = User::whereDoesntHave('roles')->count();

        $lost_items = Item::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month')
        )->get()->groupBy('month');

        return view('dashboard.reports', compact('items', 'delivered_items', 'employees', 'lost_items', 'latest_items', 'stations_count'));
    }
}
