<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ItemRequest;
use App\Http\Resources\StorageResource;
use App\Models\Category;
use App\Models\Item;
use App\Models\Station;
use App\Models\City;
use App\Models\Storage;
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

        if($request->report_type == 'found') {
            $data['informer_name'] = $request->informer_name;
            $data['informer_phone'] = $request->informer_phone;
        } else {
            $data['informer_name'] = null;
            $data['informer_phone'] = null;
        }

        $data['report_number'] = random_int(00000, 99999);

        $data['user_id'] = auth()->user()->id;

        $item = Item::create($data);

        if ($item) {

            $qr_Code = QrCode::size(100)->generate(url('/admin/items') . '/' . $item->id);

            session()->put('qr_code', $qr_Code);
            session()->put('item_name', $item->details);
            session()->put('category_name', $item->category->name);
            session()->put('station_name', $item->station->name);
            session()->put('station_location', $item->station->location);

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

        $cities = City::get();

        $storages = Storage::where('category_id' , $item->category_id)->get();

        if ($item) {
            return view('dashboard.items.edit', compact('item', 'categories', 'stations', 'cities', 'storages'));
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

        $slug = Category::where('id', $request->category_id)->first()->slug;

        $data = $request->except('_token', '_method', 'image', 'first_name', 'surname', 'is_delivered', 'email', 'phone', 'address', 'second_address', 'postcode', 'city_id', 'mobile');

        $date = Carbon::create($request->date);
        $time = Carbon::create($request->time);

        $data['date'] = $date->toDateTimeString();

        $data['time'] = $time->toDateTimeString();

        if ($slug == 'other') {

            if ($request->type != null && $request->details != null) {

                $data['type'] = $request->type;
                $data['details'] = $request->details;
                $data['cost'] = null;
            } else {
                return redirect()->back()->withInput()->with('error', __('please_enter_type_and_details'));
            }

        } elseif ($slug == 'money') {

            if ($request->cost != null) {

                $data['type'] = null;
                $data['details'] = null;
                $data['cost'] = $request->cost;
            } else {
                return redirect()->back()->withInput()->with('error', __('please_enter_cost'));
            }

        } else {

            if ($request->details != null) {

                $data['type'] = null;
                $data['details'] = $request->details;
                $data['cost'] = null;
            } else {
                return redirect()->back()->withInput()->with('error', __('please_enter_details'));
            }

        }

        if (isset($request->is_delivered)) {

            $data['is_delivered'] = $request->is_delivered;
            $data['first_name'] = $request->first_name;
            $data['surname'] = $request->surname;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['address'] = $request->address;
            $data['second_address'] = $request->second_address;
            $data['postcode'] = $request->postcode;
            $data['country_id'] = $request->country_id;
            $data['city_id'] = $request->city_id;
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
            $data['country_id'] = null;
            $data['city_id'] = null;
            $data['mobile'] = null;
        }

        if ($request->has('image')) {
            $data['image'] = $request->file('image')->store('items');
        } else {
            $data['image'] = $item->image;
        }

        if($request->report_type == 'found') {
            $data['informer_name'] = $request->informer_name;
            $data['informer_phone'] = $request->informer_phone;
        } else {
            $data['informer_name'] = null;
            $data['informer_phone'] = null;
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

    public function getStorages(Request $request)
    {
        $storages = Storage::where('category_id', $request->category_id)->get();

        $storages = StorageResource::collection($storages);

        return response()->json([
            'storages' => $storages
        ]);
    }

    public function removeSession()
    {
        session()->forget('qr_code');
        session()->forget('item_name');
        session()->forget('category_name');
        session()->forget('station_name');
        session()->forget('station_location');
        return response()->json([
            'success' => "Session Removed"
        ]);
    }
}
