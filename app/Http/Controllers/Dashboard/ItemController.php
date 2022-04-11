<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ItemRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\Station;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

            $qr_Code = QrCode::size(100)->generate('http://localhost:8000/items/' . $item->id);

            session()->put('qr_code', $qr_Code);
            session()->put('item_name', $item->details);
            session()->put('category_name', $item->category->name);
            session()->put('station_name', $item->station->name);
            return redirect()->back()->with(['success' => __('created_successfully')]);

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
        $item = Item::find($id);

        if ($item) {
            return view('dashboard.items.show', compact('item'));
        } else {
            return redirect()->back()->with('error', __('item_not_found'));
        }
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

        $data = $request->except('_token', '_method', 'image', 'first_name', 'surname', 'is_delivered', 'email', 'phone', 'address', 'second_address', 'postcode', 'city', 'mobile');

        $date = Carbon::create($request->date);
        $time = Carbon::create($request->time);

        $data['date'] = $date->toDateTimeString();

        $data['time'] = $time->toDateTimeString();

        if (isset($request->is_delivered)) {

            $data['is_delivered'] = $request->is_delivered;
            $data['first_name'] = $request->first_name;
            $data['surname'] = $request->surname;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['address'] = $request->address;
            $data['second_address'] = $request->second_address;
            $data['postcode'] = $request->postcode;
            $data['city'] = $request->city;
            $data['mobile'] = $request->mobile;
        } else {
            $data['is_delivered'] = 0;
            $data['first_name'] = null;
            $data['surname'] = null;
            $data['email'] = null;
            $data['phone'] = null;
            $data['address'] = null;
            $data['second_address'] = null;
            $data['postcode'] = null;
            $data['city'] = null;
            $data['mobile'] = null;
        }

        // dd($data, $request->all());

        if ($request->has('image')) {
            $data['image'] = $request->file('image')->store('items');
        } else {
            $data['image'] = $item->image;
        }

        if ($item) {

            $item->update($data);

            return redirect()->back()->with('success', __('updated_successfully'));
        } else {
            return redirect()->back()->with('error', __('something_went_wrong'));
        }
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

    public function removeSession()
    {
        session()->forget('qr_code');
        session()->forget('item_name');
        session()->forget('category_name');
        session()->forget('station_name');
        return response()->json([
            'success' => __('session_removed')
        ]);
    }
}
