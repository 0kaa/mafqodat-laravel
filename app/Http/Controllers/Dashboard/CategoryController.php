<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->except('_token');

        if ($request->has('image')) {
            $data['image'] = $request->file('image')->store('categories');
        }

        $category = Category::create($data);

        if ($category) {
            return \redirect()->route('admin.categories.index')->with('success', __('created_successfully'));
        } else {
            return redirect()->back()->with('error', __('something_went_wrong'));        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        if ($category) {
            return view('dashboard.categories.edit', compact('category'));
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
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);

        $data = $request->except('_token', '_method', 'imgae');

        if ($request->has('image')) {

            if ($category->image !== null) {

                if (Storage::exists($category->image)) {

                    Storage::delete($category->image);

                }
            }


            $data['image'] = $request->file('image')->store('categories');
        } else {
            $data['image'] = $category->image;
        }

        if ($category) {

            $category->update($data);

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
        Category::find($id)->delete();

        return response()->json([
            'success' => __('deleted_successfully')
        ]);
    }
}
