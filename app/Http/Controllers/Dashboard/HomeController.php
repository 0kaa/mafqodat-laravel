<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Station;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {

        $items = Item::get()->count();

        $delivered_items = Item::where('is_delivered', '1')->get()->count();

        $stations = Station::get()->count();

        $employees = User::whereDoesntHave('roles')->get()->count();

        return view('dashboard.home', compact('items', 'delivered_items', 'stations', 'employees'));
    }
}
