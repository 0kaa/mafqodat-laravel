<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\EmployeeRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Auth::user();

        $employees = User::where('id', '!=', $admin->id)->get();

        return view('dashboard.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();

        return view('dashboard.employees.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $data = $request->except('_token');

        if ($request->password) {
            $data['password'] = \bcrypt($request->password);
        }

        $employee = User::create($data);

        if ($employee) {
            return \redirect()->route('admin.employees.index')->with('success', __('created_successfully'));
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
        $employee = User::find($id);

        $countries = Country::get();

        $cities = City::where('country_id', $employee->country_id)->get();

        if ($employee) {
            return view('dashboard.employees.edit', compact('employee', 'countries', 'cities'));
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
    public function update(EmployeeRequest $request, $id)
    {
        $employee = User::find($id);

        $data = $request->except('_token', '_method');

        if ($request->password) {
            $data['password'] = \bcrypt($request->password);
        } else {
            $data['password'] = $employee->password;
        }

        if ($employee) {

            $employee->update($data);

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
        User::find($id)->delete();

        return response()->json([
            'success' => __('deleted_successfully'),
        ]);
    }

    public function getCities(Request $request)
    {
        $cities = City::where('country_id', $request->country_id)->get();

        $cities = CityResource::collection($cities);

        return response()->json([
            'cities' => $cities
        ]);
    }
}
