<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

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
}
