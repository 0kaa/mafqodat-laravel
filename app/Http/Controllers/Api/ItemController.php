<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class ItemController extends Controller
{
    use ApiResponse;

    public function getAllItems()
    {
        $items = Item::get();

        if($items->isNotEmpty()) {
            return $this->apiResponse('', ItemResource::collection($items), 200);
        } else {
            return $this->apiResponse('', [], 404);
        }
    }

    public function createItem(ItemRequest $request)
    {
        $data = $request->all();

        if($request->has('image')) {
            $data['image'] = $request->file('image')->store('items');
        }

        $item = Item::create($data);

        if($item) {
            return $this->apiResponse('', new ItemResource($item), 201);
        }
    }

    public function updateItem(Request $request, $id)
    {
        $item = Item::find($id);

        if($item) {

            $data = $request->all();

            $validator = Validator::make($data, [
                /* items data */
                'details'          => 'required',
                'category_id'      => 'required',
                'station_id'       => 'required',
                'storage'          => 'required',
                'date'             => 'required',
                'time'             => 'required',
                'primary_colour'   => 'required',
                'secondary_colour' => 'sometimes',
                'tertiary_colour'  => 'sometimes',
                'description'      => 'sometimes',
                'image'            => 'sometimes',
                'is_delivered'     => 'sometimes',

                /* User data */
                'first_name'        => 'required_if:is_delivered,1|min:3',
                'surname'           => 'required_if:is_delivered,1|min:3',
                'address'           => 'required_if:is_delivered,1|min:3',
                'secondary_address' => 'nullable|min:3',
                'city'              => 'required_if:is_delivered,1|min:3',
                'postcode'          => 'required_if:is_delivered,1|min:3',
                'phone'             => 'required_if:is_delivered,1|min:8|max:12',
                'mobile'            => 'required_if:is_delivered,1|min:8|max:12',
                'email'             => 'required_if:is_delivered,1|email',
            ], [
                'details.required'        => __('details_required'),
                'category_id.required'    => __('category_id_required'),
                'station_id.required'     => __('station_id_required'),
                'storage.required'        => __('storage_required'),
                'date.required'           => __('date_required'),
                'time.required'           => __('time_required'),
                'primary_colour.required' => __('primary_colour_required'),
                'first_name.required_if'  => __('first_name_required'),
                'first_name.min'          => __('first_name_min'),
                'surname.required_if'     => __('family_name_required'),
                'surname.min'             => __('family_name_min'),
                'email.required_if'       => __('email_required'),
                'email.email'             => __('must_be_email'),
                'address.required_if'     => __('address_required'),
                'address.min'             => __('address_min'),
                'secondary_address.min'   => __('secondary_address_min'),
                'postcode.required_if'    => __('postcode_required'),
                'city.required_if'        => __('city_required'),
                'phone.required_if'       => __('phone_required'),
                'phone.min'               => __('phone_min'),
                'phone.max'               => __('phone_max'),
                'mobile.required_if'      => __('mobile_required'),
                'mobile.min'              => __('mobile_min'),
                'mobile.max'              => __('mobile_max'),
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
                $data['city'] = $request->city;
                $data['mobile'] = $request->mobile;
            } else {
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

            if($request->has('image')) {

                if ($item->image !== null) {
                    if (Storage::exists($item->image)) {
                        Storage::delete($item->image);
                    }
                }

                $data['image'] = $request->file('image')->store('items');
            } else {
                $data['image'] = $item->image;
            }

            $item->update($data);

            return $this->apiResponse(__('updated_successfully'), new ItemResource($item), 200);
        } else {
            return $this->apiResponse(__('item_not_found'), [], 404);
        }
    }

    public function deleteItem($id)
    {
        $item = Item::find($id);

        if($item) {

            if ($item->image !== null) {
                if (Storage::exists($item->image)) {
                    Storage::delete($item->image);
                }
            }

            $item->delete();

            return $this->apiResponse(__('deleted_successfully'), [], 200);
        } else {
            return $this->apiResponse(__('item_not_found'), [], 404);
        }
    }
}