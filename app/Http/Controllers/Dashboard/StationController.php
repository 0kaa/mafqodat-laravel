<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StationRequest;
use App\Models\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::get();

        return view('dashboard.stations.index', compact('stations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.stations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StationRequest $request)
    {
        $data = $request->except('_token');

        $station = Station::create($data);

        if ($station) {
            return redirect()->route('admin.stations.index')->with('success', __('created_successfully'));
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
        $station = Station::find($id);

        if ($station) {
            return view('dashboard.stations.edit', compact('station'));
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
    public function update(StationRequest $request, $id)
    {
        $data = $request->except('_token', '_method');

        $station = Station::find($id);

        if ($station) {

            $station->update($data);

            return redirect()->back()->with('success', __('updated_successfully'));

        }  else {
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
        Station::find($id)->delete();

        return response()->json([
            'success' => __('deleted_successfully')
        ]);
    }
}
