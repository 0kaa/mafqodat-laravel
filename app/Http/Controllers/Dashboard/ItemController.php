<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ItemRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\Station;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::get();

        return view('dashboard.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();

        $stations = Station::get();

        return view('dashboard.items.create', compact('categories', 'stations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {

        $data = $request->except('_token');

        $date = Carbon::create($request->date);
        $time = Carbon::create($request->time);

        $data['date'] = $date->toDateTimeString();

        $data['time'] = $time->toDateTimeString();

        if ($request->has('image')) {
            $data['image'] = $request->file('image')->store('items');
        }

        $item = Item::create($data);

        if ($item) {
            return redirect()->route('admin.items.index')->with('success', __('created_successfully'));
        } else {
            return redirect()->back()->with('error', __('something_went_wrong'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);

        $categories = Category::get();

        $stations = Station::get();

        if ($item) {
            return view('dashboard.items.edit', compact('item', 'categories', 'stations'));
        } else {
            return view('dashboard.error');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, $id)
    {
        $item = Item::find($id);

        $data = $request->except('_token', '_method', 'image');

        $date = Carbon::create($request->date);
        $time = Carbon::create($request->time);

        $data['date'] = $date->toDateTimeString();

        $data['time'] = $time->toDateTimeString();

        if ($request->has('image')) {
            $data['image'] = $request->file('image')->store('items');
        } else {
            $data['image'] = $item->image;
        }

        if ($item) {

            $item->update($data);

            return redirect()->back()->with('success', __('updated_successfully'));

        }  else {
            return redirect()->back()->with('error', __('something_went_wrong'));        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::find($id)->delete();

        return response()->json([
            'success' => __('deleted_successfully')
        ]);
    }

    public function getStations(Request $request)
    {
        $station = Station::find($request->id);

        return view('dashboard.ajax.stations', compact('station'))->render();
    }
}
