<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StorageRequest;
use App\Models\Category;
use App\Models\Storage;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storages = Storage::all();

        return view('dashboard.storages.index', compact('storages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.storages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorageRequest $request)
    {
        $attributes = $request->all();

        $storage = Storage::create($attributes);

        if ($storage) {
            return \redirect()->route('admin.storages.index')->with('success', __('created_successfully'));
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
        $storage = Storage::find($id);

        return view('dashboard.storages.edit', compact('storage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorageRequest $request, $id)
    {
        $storage = Storage::find($id);

        $attributes = $request->except('_token', '_method');

        if ($storage) {

            $storage->update($attributes);

            return \redirect()->back()->with('success', __('updated_successfully'));
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
        Storage::find($id)->delete();

        return response()->json([
            'success' => __('deleted_successfully')
        ]);
    }
}
