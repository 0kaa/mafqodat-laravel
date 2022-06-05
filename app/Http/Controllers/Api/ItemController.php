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

    public function getAllItems()
    {
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

        if($request->report_type == 'found') {
            $data['informer_name'] = $request->informer_name;
            $data['informer_phone'] = $request->informer_phone;
        } else {
            $data['informer_name'] = null;
            $data['informer_phone'] = null;
        }

        $data['report_number'] = random_int(00000, 99999);

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
            'message_en' => 'I added a new lost item',
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
                'storage_id'     => 'required',
                'date'           => 'required',
                'time'           => 'required',
                'is_delivered'   => 'sometimes',
                'report_type'    => 'required',
                'informer_name'  => 'required_if:report_type,found',
                'informer_phone' => 'required_if:report_type,found',

                /* User data */
                'first_name'        => 'nullable',
                'surname'           => 'nullable',
                'address'           => 'nullable',
                'secondary_address' => 'nullable',
                'city'              => 'nullable',
                'postcode'          => 'nullable',
                'phone'             => 'nullable',
                'mobile'            => 'nullable',
                'email'             => 'nullable',
            ], [
                'details.required'           => __('details_required'),
                'category_id.required'       => __('category_id_required'),
                'station_id.required'        => __('station_id_required'),
                'storage_id.required'        => __('storage_required'),
                'date.required'              => __('date_required'),
                'time.required'              => __('time_required'),
                'report_type.required'       => __('report_type_required'),
                'informer_name.required_if'  => __('informer_name_required'),
                'informer_phone.required_if' => __('informer_phone_required'),
                'first_name.required_if'     => __('first_name_required'),
                'first_name.min'             => __('first_name_min'),
                'surname.required_if'        => __('family_name_required'),
                'surname.min'                => __('family_name_min'),
                'email.required_if'          => __('email_required'),
                'email.email'                => __('must_be_email'),
                'address.required_if'        => __('address_required'),
                'address.min'                => __('address_min'),
                'secondary_address.min'      => __('secondary_address_min'),
                'postcode.required_if'       => __('postcode_required'),
                'city.required_if'           => __('city_required'),
                'phone.required_if'          => __('phone_required'),
                'phone.min'                  => __('phone_min'),
                'phone.max'                  => __('phone_max'),
                'mobile.required_if'         => __('mobile_required'),
                'mobile.min'                 => __('mobile_min'),
                'mobile.max'                 => __('mobile_max'),
            ]);

            if ($validator->stopOnFirstFailure()->fails()) {
                return $this->apiResponse($validator->errors()->all()[0], [], 422);
            }

            if ($request->is_delivered == 1) {

                $data['is_delivered'] = $request->is_delivered;
                $data['first_name'] = $request->first_name;
                $data['surname'] = $request->surname;
                $data['email'] = $request->email;
                $data['phone'] = $request->phone;
                $data['address'] = $request->address;
                $data['second_address'] = $request->second_address;
                $data['postcode'] = $request->postcode;
                $data['city_id'] = $request->city_id;
                $data['mobile'] = $request->mobile;
            } else {
                $data['first_name'] = null;
                $data['surname'] = null;
                $data['email'] = null;
                $data['phone'] = null;
                $data['address'] = null;
                $data['second_address'] = null;
                $data['postcode'] = null;
                $data['city_id'] = null;
                $data['mobile'] = null;
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


            $item->update($data);

            if ($item->is_delivered == 1) {

                Log::create([
                    'user_id' => $user->id,
                    'message_ar' => 'لقد قمت بتسليم المفقود #' . $item->id,
                    'message_en' => 'I delivered the lost item #' . $item->id,
                    'date' => Carbon::now(),
                ]);
            } else {

                Log::create([
                    'user_id' => $user->id,
                    'message_ar' => 'لقد قمت بتعديل بيانات المفقود #' . $item->id,
                    'message_en' => 'I updated the lost item #' . $item->id,
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
                'message_ar' => 'لقد قمت بحذف المفقود #' . $item->id,
                'message_en' => 'I deleted the lost item #' . $item->id,
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

}
