<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ItemRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ItemResource;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\StationResource;
use App\Http\Resources\StorageResource;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemMedia;
use App\Models\Log;
use App\Models\Media;
use App\Models\Station;
use App\Models\Storage as AppStorage;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class ItemController extends Controller
{
    use ApiResponse;

    public function getAllItems(Request $request)
    {
        if (isset($request->all) && $request->all == 'true') {
            return $this->apiResponse('', ItemResource::collection(Item::get()), 200);
        }

        $items = Item::paginate(8);

        $items->transform(function ($item) {
            return new ItemResource($item);
        });

        return $this->apiResponse('', new PaginationResource($items), 200);
    }

    public function showItem($id)
    {
        $item = Item::find($id);

        if ($item) {
            return $this->apiResponse('', new ItemResource($item), 200);
        } else {
            return $this->apiResponse(__('item_not_found'), [], 404);
        }
    }

    public function createItem(ItemRequest $request)
    {
        $user = auth()->user();

        $data = $request->all();
        if ($request->report_type == 'found') {
            $data['storage_id'] = null;
            $data['informer_name'] = $request->informer_name;
            $data['informer_phone'] = $request->informer_phone;
        } else {
            $data['storage_id'] = $request->storage_id;
            $data['informer_name'] = null;
            $data['informer_phone'] = null;
        }

        $itemCountLost = count(Item::where('report_type', 'lost')->get());
        $itemCountFound = count(Item::where('report_type', 'found')->get());

        $start_report_number = 1;

        if ($request->report_type == 'lost') {
            if ($itemCountLost > 0) {
                $last_item = Item::withTrashed()->where('report_type', 'lost')->orderBy('id', 'desc')->first();
                $reportNumber = \str_replace('L', '', $last_item->report_number);

                $reportNumberInt = (int) $reportNumber;

                $start_report_number = $reportNumberInt + 1;

                $item_report_number = 'L' . $start_report_number;

                $data['report_number'] = $item_report_number;
            } else {
                $item_report_number = str_pad($start_report_number, 7, 'L22000', STR_PAD_LEFT);

                $data['report_number'] = $item_report_number;
            }
        } else {
            if ($itemCountFound > 0) {
                $last_item = Item::withTrashed()->where('report_type', 'found')->orderBy('id', 'desc')->first();
                $reportNumber = \str_replace('F', '', $last_item->report_number);

                $reportNumberInt = (int) $reportNumber;

                $start_report_number = $reportNumberInt + 1;

                $item_report_number = 'F' . $start_report_number;


                $data['report_number'] = $item_report_number;
            } else {
                $item_report_number = str_pad($start_report_number, 7, 'F33000', STR_PAD_LEFT);

                $data['report_number'] = $item_report_number;
            }
        }

        // $data['report_number'] = random_int(00000, 99999);

        $data['user_id'] = $user->id;

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

        Log::create([
            'user_id' => $user->id,
            'message_ar' => 'لقد قمت بإضافة مفقود جديد',
            'message_en' => 'Added new item',
            'item_id'   => $item->id,
            'date' => Carbon::now(),
        ]);

        if ($item) {
            return $this->apiResponse(__('item_created'), new ItemResource($item), 201);
        }
    }

    public function updateItem(Request $request, $id)
    {
        $user = auth()->user();

        $item = Item::find($id);

        if ($item) {

            $data = $request->all();

            $validator = Validator::make($data, [
                /* items data */
                'report_type'    => 'required',
                'informer_name'  => 'required_if:report_type,found',
                'informer_phone' => 'required_if:report_type,found',
                'details'        => 'required',
                'category_id'    => 'required',
                'station_id'     => 'required',
                // 'storage_id'     => 'required',
                'date'           => 'required',
                'time'           => 'required',
                'is_delivered'   => 'sometimes',
                'report_type'    => 'required',
                'informer_name'  => 'required_if:report_type,found',
                'informer_phone' => 'required_if:report_type,found',

                /* User data */
                'full_name'     => 'nullable',
                'phone'         => 'nullable',
                'delivery_date' => 'nullable',

            ], [
                'details.required'           => __('details_required'),
                'category_id.required'       => __('category_id_required'),
                'station_id.required'        => __('station_id_required'),
                // 'storage_id.required'        => __('storage_required'),
                'date.required'              => __('date_required'),
                'time.required'              => __('time_required'),
                'report_type.required'       => __('report_type_required'),
                'informer_name.required_if'  => __('informer_name_required'),
                'informer_phone.required_if' => __('informer_phone_required'),
            ]);

            if ($validator->stopOnFirstFailure()->fails()) {
                return $this->apiResponse($validator->errors()->all()[0], [], 422);
            }

            if ($request->is_delivered == 1) {

                $data['is_delivered'] = $request->is_delivered;
                $data['full_name'] = $request->full_name;
                $data['phone'] = $request->phone;
                $data['delivery_date'] = $request->delivery_date;
            } else {
                $data['full_name'] = null;
                $data['phone'] = null;
                $data['delivery_date'] = null;
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
                $data['storage_id'] = null;
                $data['informer_name'] = $request->informer_name;
                $data['informer_phone'] = $request->informer_phone;
            } else {
                $data['storage_id'] = $request->storage_id;
                $data['informer_name'] = null;
                $data['informer_phone'] = null;
            }


            $item->update($data);

            if ($item->is_delivered == 1) {

                Log::create([
                    'user_id' => $user->id,
                    'message_ar' => 'لقد قمت بتسليم المفقود',
                    'message_en' => 'Delivered item',
                    'item_id' => $item->id,
                    'date' => Carbon::now(),
                ]);
            } else {

                Log::create([
                    'user_id' => $user->id,
                    'message_ar' => 'لقد قمت بتعديل بيانات المفقود',
                    'message_en' => 'Updated item',
                    'item_id' => $item->id,
                    'date' => Carbon::now(),
                ]);
            }



            return $this->apiResponse(__('updated_successfully'), new ItemResource($item), 200);
        } else {
            return $this->apiResponse(__('item_not_found'), [], 404);
        }
    }

    public function deleteItem($id)
    {
        $user = auth()->user();

        $item = Item::find($id);

        if ($item) {

            if ($item->image !== null) {
                if (Storage::exists($item->image)) {
                    Storage::delete($item->image);
                }
            }

            $item->delete();

            Log::create([
                'user_id' => $user->id,
                'message_ar' => 'لقد قمت بحذف المفقود',
                'message_en' => 'Deleted item',
                'item_id' => $item->id,
                'date' => Carbon::now(),
            ]);

            return $this->apiResponse(__('deleted_successfully'), [], 200);
        } else {
            return $this->apiResponse(__('item_not_found'), [], 404);
        }
    }

    public function categoryList()
    {
        $categories = Category::all();

        return $this->apiResponse('', CategoryResource::collection($categories), 200);
    }

    public function stationList()
    {
        $stations = Station::all();

        return $this->apiResponse('', StationResource::collection($stations), 200);
    }

    public function storageList(Request $request)
    {
        $storages = Category::find($request->category_id)->storage()->get();

        return $this->apiResponse('', StorageResource::collection($storages), 200);
    }

    public function deleteImage(Request $request)
    {

        // dd($request->all());

        $itemMedia = ItemMedia::find($request->image_id);

        try {
            Storage::delete($itemMedia->media->image);

            Media::destroy($itemMedia->media->id);

            $itemMedia->delete();

            return \response()->json([
                'message' => __('image_deleted_successfully'),
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json([
                'message' => __('image_not_found'),
            ]);
        }
    }
}
