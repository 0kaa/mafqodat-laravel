<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorageRequest;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\StorageResource;
use App\Models\Log;
use App\Models\Storage;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    use ApiResponse;

    public function getAllStorages(Request $request)
    {
        if (isset($request->all) && $request->all == 'true') {
            return $this->apiResponse('', StorageResource::collection(Storage::get()), 200);
        }

        $storages = Storage::paginate(8);

        $storages->transform(function ($storage) {
            return new StorageResource($storage);
        });

        return $this->apiResponse('', new PaginationResource($storages), 200);
    }

    public function getStorage($id)
    {
        $storage = Storage::find($id);

        return $this->apiResponse('', new StorageResource($storage), 200);
    }

    public function createStorage(StorageRequest $request)
    {
        $user = auth()->user();

        $data = $request->all();

        $storage = Storage::create($data);

        Log::create([
            'user_id' => $user->id,
            'message_ar' => 'لقد قمت بإضافة مخزن جديد',
            'message_en' => 'I added a new storage',
            'date' => Carbon::now(),
        ]);

        return $this->apiResponse('', new StorageResource($storage), 201);
    }

    public function updateStorage(StorageRequest $request, $id)
    {
        $user = auth()->user();

        $storage = Storage::find($id);

        if ($storage) {

            $data = $request->all();

            $storage->update($data);

            Log::create([
                'user_id' => $user->id,
                'message_ar' => 'لقد قمت بتعديل مخزن ' . $storage->name_ar,
                'message_en' => 'I have updated the storage ' . $storage->name_en,
                'date' => Carbon::now(),
            ]);

            return $this->apiResponse('', new StorageResource($storage), 200);
        } else {
            return $this->apiResponse(__('storage_not_found'), [], 404);
        }
    }

    public function deleteStorage($id)
    {
        $user = auth()->user();

        $storage = Storage::find($id);

        if ($storage) {

            $storage->delete();

            Log::create([
                'user_id' => $user->id,
                'message_ar' => 'لقد قمت بحذف مخزن ' . $storage->name_ar,
                'message_en' => 'I have deleted the storage ' . $storage->name_en,
                'date' => Carbon::now(),
            ]);

            return $this->apiResponse(__('deleted_successfully'), [], 200);
        } else {
            return $this->apiResponse(__('storage_not_found'), [], 404);
        }
    }
}
