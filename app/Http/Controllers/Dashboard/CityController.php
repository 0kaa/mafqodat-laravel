<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CityRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::get();

        return view('dashboard.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();

        return view('dashboard.cities.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $data = $request->except('_token');

        $city = City::create($data);

        if ($city) {
            return \redirect()->route('admin.cities.index')->with('success', __('created_successfully'));
        } else {
            return redirect()->back('error', __('something_went_wrong'));
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
        $city = City::find($id);

        $countries = Country::get();

        if ($city) {

            return view('dashboard.cities.edit', compact('city', 'countries'));

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
    public function update(Request $request, $id)
    {
        $city = City::find($id);

        $data = $request->except('_token', '_method');

        if ($city) {

            $city->update($data);

            return redirect()->back()->with('success', __('updated_successfully'));

        } else {

            return redirect()->back('error', __('something_went_wrong'));

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
        City::find($id)->delete();

        return \response()->json([
            'success' => __('deleted_successfully'),
        ]);
    }
}
