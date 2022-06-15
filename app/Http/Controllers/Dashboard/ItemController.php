<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ItemRequest;
use App\Http\Resources\StorageResource;
use App\Models\Category;
use App\Models\Item;
use App\Models\Station;
use App\Models\City;
use App\Models\ItemMedia;
use App\Models\Log;
use App\Models\Media;
use App\Models\Storage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as IlluminateStorage;
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

        $itemMedia = ItemMedia::get();

        $stations = Station::get();

        return view('dashboard.items.index', compact('items', 'itemMedia', 'stations'));
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

        $today = Carbon::now();

        if($date->isAfter($today)) {
            return redirect()->back()->withInput()->with('error', __('date_after_today_error'));
        } else {
            $data['date'] = $date->toDateTimeString();

            $data['time'] = $time->toDateTimeString();
        }



        if ($request->report_type == 'found') {
            $data['informer_name'] = $request->informer_name;
            $data['informer_phone'] = $request->informer_phone;
        } else {
            $data['informer_name'] = null;
            $data['informer_phone'] = null;
        }

        $itemCountLost = count(Item::where('report_type', 'lost')->get());
        $itemCountFound = count(Item::where('report_type', 'found')->get());

        $start_report_number = 1;

        if ($request->report_type == 'lost') {
            if ($itemCountLost > 0) {
                $last_item = Item::withTrashed()->where('report_type', 'lost')->orderBy('id', 'desc')->first();
                $start_report_number = $last_item->report_number + 1;

                $item_report_number = str_pad($start_report_number, 6, '22000', STR_PAD_LEFT);

                $data['report_number'] = $item_report_number;

            } else {
                $item_report_number = str_pad($start_report_number, 6, '22000', STR_PAD_LEFT);

                $data['report_number'] = $item_report_number;

            }
        } else {
            if ($itemCountFound > 0) {
                $last_item = Item::withTrashed()->where('report_type', 'found')->orderBy('id', 'desc')->first();
                $start_report_number = $last_item->report_number + 1;

                $item_report_number = str_pad($start_report_number, 6, '33000', STR_PAD_LEFT);


                $data['report_number'] = $item_report_number;

            } else {
                $item_report_number = str_pad($start_report_number, 6, '33000', STR_PAD_LEFT);

                $data['report_number'] = $item_report_number;

            }
        }

        // $data['report_number'] = random_int(00000, 99999);

        $data['user_id'] = auth()->user()->id;

        $item = Item::create($data);

        if ($request->has('images')) {

            $files = $request->file('images');

            foreach ($files as $file) {

                $image = $file->store('items');

                $image = Media::create([

                    'image' => $image

                ]); // end of create

                ItemMedia::create([
                    'item_id' => $item->id,
                    'media_id' => $image->id,
                ]);
            } // end of foreach


        } // end of has images


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

        $itemMedia = ItemMedia::where('item_id', $id)->get();

        if ($item) {
            return view('dashboard.items.show', compact('item', 'itemMedia'));
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

        $storages = Storage::where('id', $item->storage_id)->get();

        $itemMedia = ItemMedia::where('item_id', $item->id)->get();

        if ($item) {
            return view('dashboard.items.edit', compact('item', 'categories', 'stations', 'cities', 'storages', 'itemMedia'));
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
        // dd($request->all());

        $item = Item::find($id);

        $data = $request->except('_token', '_method', 'image', 'full_name', 'phone', 'is_delivered');

        $date = Carbon::create($request->date);
        $time = Carbon::create($request->time);

        $data['date'] = $date->toDateTimeString();

        $data['time'] = $time->toDateTimeString();

        if ($request->is_delivered == 1 && $request->full_name != null && $request->phone != null) {

            $data['is_delivered'] = 1;
            $data['full_name'] = $request->full_name;
            $data['phone'] = $request->phone;
            $data['delivery_date'] = Carbon::now();

        } elseif ($request->is_delivered == 0) {
            $data['is_delivered'] = 0;
            $data['full_name'] = null;
            $data['phone'] = null;
            $data['delivery_date'] = null;

        } else {
            return redirect()->back()->with('error', __('full_name_and_phone_required'));
        }

        if ($request->has('images')) {

            $files = $request->file('images');

            foreach ($files as $file) {

                $image = $file->store('items');

                $image = Media::create([

                    'image' => $image

                ]); // end of create

                ItemMedia::create([
                    'item_id' => $item->id,
                    'media_id' => $image->id,
                ]);
            } // end of foreach

        } // end of has images

        if ($request->report_type == 'found') {
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
        $storages = Category::find($request->category_id)->storage()->get();

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

    public function removeImage(Request $request)
    {

        $itemMedia = ItemMedia::find($request->id);

        IlluminateStorage::delete($itemMedia->media->image);

        Media::destroy($itemMedia->media->id);

        $itemMedia->delete();

        return \response()->json([
            'message' => 'تم حذف الصورة بنجاح',
        ]);
    }
}
