<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    use ApiResponse;

    public function getAllCategories()
    {
        $categories = Category::get();

        if ($categories->isNotEmpty()) {
            return $this->apiResponse('', CategoryResource::collection($categories), 200);
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

        if ($category) {
            return $this->apiResponse(__('created_successfully'), new CategoryResource($category), 201);
        }
    }

    public function updateCategory(CategoryRequest $request, $id)
    {
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

            return $this->apiResponse(__('updated_successfully'), new CategoryResource($category), 200);

        } else {
            return $this->apiResponse(__('category_not_found'), [], 404);
        }
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);

        if ($category) {

            if ($category->image != null) {
                Storage::delete($category->image);
            }

            $category->delete();

            return $this->apiResponse(__('deleted_successfully'), [], 200);

        } else {
            return $this->apiResponse(__('category_not_found'), [], 404);
        }

    }
}
