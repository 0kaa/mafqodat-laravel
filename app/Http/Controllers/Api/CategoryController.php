<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PaginationResource;
use App\Models\Category;
use App\Models\Log;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    use ApiResponse;

    public function getAllCategories()
    {
        $categories = Category::paginate(8);

        $categories->transform(function ($category) {
            return new CategoryResource($category);
        });

        if ($categories->isNotEmpty()) {
            return $this->apiResponse('', new PaginationResource($categories), 200);
        } else {
            return $this->apiResponse('', [], 200);
        }
    }

    public function createCategory(CategoryRequest $request)
    {
        $user = auth()->user();

        $data = $request->all();

        if ($request->has('image')) {
            $data['image'] = $request->file('image')->store('categories');
        }

        $category = Category::create($data);

        Log::create([
            'user_id' => $user->id,
            'message_ar' => 'لقد قمت بإضافة قسم جديد',
            'message_en' => 'I added a new section',
            'date' => Carbon::now(),
        ]);

        if ($category) {
            return $this->apiResponse(__('created_successfully'), new CategoryResource($category), 201);
        }
    }

    public function updateCategory(CategoryRequest $request, $id)
    {
        $user = auth()->user();

        $category = Category::find($id);

        if ($category) {

            $data = $request->except('image');

            if ($request->has('image')) {

                Storage::delete($category->image);

                $data['image'] = $request->file('image')->store('categories');

            } else {

                $data['image'] = $category->image;

            }

            $category->update($data);

            Log::create([
                'user_id' => $user->id,
                'message_ar' => 'لقد قمت بتعديل قسم ' . $category->name_ar,
                'message_en' => 'I have updated the category ' . $category->name_en,
                'date' => Carbon::now(),
            ]);

            return $this->apiResponse(__('updated_successfully'), new CategoryResource($category), 200);

        } else {
            return $this->apiResponse(__('category_not_found'), [], 404);
        }
    }

    public function deleteCategory($id)
    {
        $user = auth()->user();

        $category = Category::find($id);

        if ($category) {

            if ($category->image != null) {
                Storage::delete($category->image);
            }

            $category->delete();

            Log::create([
                'user_id' => $user->id,
                'message_ar' => 'لقد قمت بحذف قسم ' . $category->name_ar,
                'message_en' => 'I have deleted the category ' . $category->name_en,
                'date' => Carbon::now(),
            ]);

            return $this->apiResponse(__('deleted_successfully'), [], 200);

        } else {
            return $this->apiResponse(__('category_not_found'), [], 404);
        }

    }
}
