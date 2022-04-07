<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;
use Validator;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(AuthRequest $request)
    {
        $data = $request->all();

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user = User::create($data);

        if ($user) {
            return $this->apiResponse(
                __('registered_successfully'),
                [
                    'user' => new UserResource($user),
                    'token' => $user->createToken('tokens')->plainTextToken
                ],
                201
            );
        }
    }


    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return $this->apiResponse(__('login_successfully'), ['token' => $user->createToken('tokens')->plainTextToken, 'user' => new UserResource($user)], 200);
        } else {
            return $this->apiResponse(__('wrong_credentials'), [], 404);
        }
    }

    public function forgetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        $code = rand(1000, 9999);

        if ($user) {
            $user->code = $code;
            $user->save();
            return $this->apiResponse(__('code_sent'), ['code' => $code], 200);
        } else {
            return $this->apiResponse(__('user_not_found'), [], 404);
        }
    }
    public function verifyOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && $user->code == $request->code) {
            $token = $user->createToken('tokens')->plainTextToken;
            return $this->apiResponse(__('code_verified'), ['token' => $token], 200);
        } else {
            return $this->apiResponse(__('code_not_verified'), [], 404);
        }
    }

    public function setNewPassword(Request $request)
    {
        $user = auth()->user();
        if ($user) {

            $request->validate(
                [
                    'password' => 'required|confirmed|min:6',
                ],
                [
                    'password.required' => __('password_required'),
                    'password.confirmed' => __('password_confirmed'),
                    'password.min' => __('password_min'),
                ]
            );


            $user->password = bcrypt($request->password);
            $user->code = null;
            $user->save();
            return $this->apiResponse(__('password_changed'), [], 200);
        } else {
            return $this->apiResponse(__('user_not_found'), [], 404);
        }
    }

    public function profile()
    {
        $user = auth()->user();

        return $this->apiResponse(__('login_successfully'), ['token' => $user->createToken('tokens')->plainTextToken, 'user' => new UserResource($user)], 200);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        if ($user) {

            $data = $request->all();

            $validator = Validator::make($data, [
                'first_name'  => 'required',
                'family_name' => 'required',
                'email'       => 'required|unique:users,email,'.$user->id,
                'address'     => 'required',
                'phone'       => 'required',
                'mobile'      => 'required',
                'country_id'  => 'required',
                'city_id'     => 'required',
            ], [
                'first_name.required'  => __('first_name_required'),
                'family_name.required' => __('family_name_required'),
                'email.required'       => __('email_required'),
                'email.unique'         => __('email_unique'),
                'phone.required'       => __('phone_required'),
                'address.required'     => __('address_required'),
                'phone.required'       => __('phone_required'),
                'mobile.required'      => __('mobile_required'),
                'country_id.required'  => __('country_required'),
                'city_id.required'     => __('city_required'),
            ]);

            if ($validator->stopOnFirstFailure()->fails()) {
                return $this->apiResponse($validator->errors()->all()[0], [], 422);
            }

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

            $user->update($data);

            return $this->apiResponse(__('updated_successfully'), new UserResource($user), 200);
        }
    }


    public function changePassword(Request $request)
    {
        $user = auth()->user();

        if (Hash::check($request->old_password, $user->password)) {

            $data = $request->except('old_password');

            $validator = Validator::make($data, [
                'password' => 'required|min:6',
            ], [
                'password.required' => __('password_required'),
                'password.min'      => __('password_min'),
            ]);

            if ($validator->stopOnFirstFailure()->fails()) {
                return $this->apiResponse($validator->errors()->all()[0], [], 422);
            }

            if ($request->has('password')) {
                $data['password'] = \bcrypt($request->password);
            } else {
                $data['password'] = $user->password;
            }

            $user->update($data);

            return $this->apiResponse(__('password_changed'), [], 200);
        } else {
            return $this->apiResponse(__('old_password_wrong'), [], 422);
        }
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->apiResponse(__('logout_successfully'));
    }
}
