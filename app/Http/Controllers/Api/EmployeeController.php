<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    use ApiResponse;

    public function getAllEmployees()
    {
        $employees = User::whereDoesntHave('roles')->get();

        if ($employees->isNotEmpty()) {
            return $this->apiResponse('', UserResource::collection($employees), 200);
        }
    }

    public function createEmployee(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'first_name'  => 'required',
            'family_name' => 'required',
            'email'       => 'required|unique:users,email',
            'password'    => 'required|min:6',
            'phone'       => 'required',
            'mobile'      => 'required',
            'country_id'  => 'required',
            'city_id'     => 'required',
        ], [
            'first_name.required'  => __('first_name_required'),
            'family_name.required' => __('family_name_required'),
            'email.required'       => __('email_required'),
            'email.unique'         => __('email_unique'),
            'password.required'    => __('password_required'),
            'password.min'         => __('password_min'),
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

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->has('image')) {
            $data['image'] = $request->file('image')->store('users');
        }

        $employee = User::create($data);

        if ($employee) {
            return $this->apiResponse(__('created_successfully'), new UserResource($employee), 201);
        }
    }

    public function updateEmployee(Request $request, $id)
    {
        $employee = User::find($id);

        if ($employee) {

            $data = $request->all();

            $validator = Validator::make($data, [
                'first_name'  => 'required',
                'family_name' => 'required',
                'email'       => 'required|unique:users,email,' . $id,
                'password'    => 'required|min:6',
                'phone'       => 'required',
                'mobile'      => 'required',
                'country_id'  => 'required',
                'city_id'     => 'required',
            ], [
                'first_name.required'  => __('first_name_required'),
                'family_name.required' => __('family_name_required'),
                'email.required'       => __('email_required'),
                'email.unique'         => __('email_unique'),
                'password.required'    => __('password_required'),
                'password.min'         => __('password_min'),
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

            if ($request->password) {
                $data['password'] = bcrypt($request->password);
            } else {
                $data['password'] = $employee->password;
            }

            if ($request->has('image')) {

                if ($employee->image !== null) {

                    if (Storage::exists($employee->image)) {

                        Storage::delete($employee->image);
                    }
                }

                $data['image'] = $request->file('image')->store('users');
            } else {
                $data['image'] = $employee->image;
            }


            $employee->update($data);

            return $this->apiResponse(__('updated_successfully'), new UserResource($employee), 200);
        } else {
            return $this->apiResponse(__('employee_not_found'), [], 404);
        }
    }

    public function deleteEmployee($id)
    {
        $employee = User::find($id);

        if ($employee) {

            if ($employee->image !== null) {

                if (Storage::exists($employee->image)) {

                    Storage::delete($employee->image);
                }
            }

            $employee->delete();

            return $this->apiResponse(__('deleted_successfully'), [], 200);
        } else {
            return $this->apiResponse(__('employee_not_found'), [], 404);
        }
    }
}
