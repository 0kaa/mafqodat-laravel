<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProfileRequest;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    public function getProfile()
    {
        $user = Auth::user();

        $cities = City::all();

        return view('dashboard.profile', compact('user', 'cities'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $user = Auth::user();

        $data = $request->except('_token', 'image');

        if ($request->has('image')) {

            if ($user->image !== null) {

                if (Storage::exists($user->image)) {

                    Storage::delete($user->image);

                }
            }
            $data['image'] = $request->file('image')->store('users');
        } else {
            $data['image'] = $user->image;
        }

        if ($request->password) {
            $data['password'] = \bcrypt($request->password);
        } else {
            $data['password'] = $user->password;
        }

        $user->update($data);

        return redirect()->back()->with('success', __('updated_successfully'));
    }
}
