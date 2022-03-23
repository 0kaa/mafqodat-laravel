<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getProfile()
    {
        $user = Auth::user();

        $countries = Country::get();

        $cities = City::where('country_id', $user->country_id)->get();

        return view('dashboard.profile', compact('user', 'countries', 'cities'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->except('_token');

        if ($request->password) {
            $data['password'] = \bcrypt($request->password);
        } else {
            $data['password'] = $user->password;
        }

        $user->update($data);

        return redirect()->back()->with('success', __('updated_successfully'));
    }
}
