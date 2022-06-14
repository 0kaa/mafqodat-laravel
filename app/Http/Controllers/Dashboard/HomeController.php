<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemMedia;
use App\Models\Station;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {

        $items = Item::count();

        $latest_items = Item::orderBy('created_at', 'desc')->take(5)->get();

        $delivered_items = Item::where('is_delivered', '1')->count();

        $stations_count = Station::count();

        $employees = User::whereDoesntHave('roles')->count();

        $itemMedia = ItemMedia::get();

        $lost_items = [];

        for ($i = 1; $i <= 12; $i++) {
            $query = Item::select(DB::raw('count(id) as `data`'), DB::raw('YEAR(date) year, MONTH(date) month'))->groupby('year', 'month')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', $i)->first();
            $lost_items[] = $query ? $query->data : 0;
        }

        return view('dashboard.home', compact('items', 'latest_items', 'delivered_items', 'stations_count', 'employees', 'itemMedia', 'lost_items'));
    }

   /*  public function reports()
    {

        $items = Item::count();

        $latest_items = Item::orderBy('created_at', 'desc')->take(5)->get();

        $delivered_items = Item::where('is_delivered', '1')->count();

        $stations_count = Station::count();

        $employees = User::whereDoesntHave('roles')->count();

        $itemMedia = ItemMedia::get();

        // $lost_items = Item::select(
        //     DB::raw('YEAR(created_at) as year'),
        //     DB::raw('MONTH(created_at) as month')
        // )->get()->groupBy('month');

        $lost_items = [];

        for ($i = 1; $i <= 12; $i++) {
            $query = Item::select(DB::raw('count(id) as `data`'), DB::raw('YEAR(date) year, MONTH(date) month'))->groupby('year', 'month')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', $i)->first();
            $lost_items[] = $query ? $query->data : 0;
        }

        return view('dashboard.reports', compact('items', 'delivered_items', 'employees', 'lost_items', 'latest_items', 'stations_count', 'itemMedia'));
    } */
}
