<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\UserResource;
use App\Models\Log;
use App\Models\User;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Validator;

class EmployeeController extends Controller
{
    use ApiResponse;

    public function getAllEmployees()
    {
        $employees = User::whereDoesntHave('roles')->paginate(10);

        $employees->transform(function ($employee) {
            return new UserResource($employee);
        });

        if ($employees->isNotEmpty()) {
            return $this->apiResponse('', new PaginationResource($employees), 200);
        } else {
            return $this->apiResponse('', [], 200);
        }
    }


    public function showEmployee($id)
    {
        $employee = User::whereDoesntHave('roles')->find($id);

        if ($employee) {
            return $this->apiResponse('', new UserResource($employee), 200);
        } else {
            return $this->apiResponse(__('employee_not_found'), [], 404);
        }
    }

    public function permissionList()
    {
        $permissions = Permission::get();

        if ($permissions->isNotEmpty()) {
            return $this->apiResponse('', PermissionResource::collection($permissions), 200);
        }
    }

    public function createEmployee(Request $request)
    {
        $user = auth()->user();

        $data = $request->all();

        $validator = Validator::make($data, [
            'first_name'     => 'required|min:3',
            'family_name'    => 'required|min:3',
            'email'          => 'required|unique:users,email',
            'password'       => 'required|min:6',
            'address'        => 'required|min:3',
            'second_address' => 'nullable|min:3',
            'phone'          => 'required|min:8|max:12',
            'mobile'         => 'required|min:8|max:12',
            'country_id'     => 'required',
            'city_id'        => 'required',
        ], [
            'first_name.required'  => __('first_name_required'),
            'first_name.min'       => __('first_name_min'),
            'family_name.required' => __('family_name_required'),
            'family_name.min'      => __('family_name_min'),
            'email.required'       => __('email_required'),
            'email.unique'         => __('email_unique'),
            'password.required'    => __('password_required'),
            'password.min'         => __('password_min'),
            'phone.required'       => __('phone_required'),
            'address.required'     => __('address_required'),
            'address.min'          => __('address_min'),
            'phone.required'       => __('phone_required'),
            'phone.min'            => __('phone_min'),
            'phone.max'            => __('phone_max'),
            'mobile.required'      => __('mobile_required'),
            'mobile.min'           => __('mobile_min'),
            'mobile.max'           => __('mobile_max'),
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

        $employee->givePermissionTo($request->permissions);

        Log::create([
            'image' => $user->image ? $user->image : null,
            'message_ar' => 'بإضافة موظف جديد ' . $user->first_name . ' ' . $user->family_name . ' قام الموظف ',
            'message_en' => 'The employee ' . $user->first_name . ' ' . $user->family_name . ' added a new employee',
            'date' => Carbon::now(),
        ]);

        if ($employee) {
            return $this->apiResponse(__('created_successfully'), new UserResource($employee), 201);
        }
    }

    public function updateEmployee(Request $request, $id)
    {

        $user = auth()->user();

        $employee = User::whereDoesntHave('roles')->find($id);

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

            $employee->syncPermissions($request->permissions);

            Log::create([
                'image' => $user->image ? $user->image : null,
                'message_ar' => $employee->first_name . ' ' .  $employee->family_name . ' بتعديل الموظف ' . $user->first_name . ' ' . $user->family_name . ' قام الموظف ',
                'message_en' => 'The employee ' . $user->first_name . ' ' . $user->family_name . ' updated employee' . $employee->first_name . ' ' .  $employee->family_name,
                'date' => Carbon::now(),
            ]);

            return $this->apiResponse(__('updated_successfully'), new UserResource($employee), 200);
        } else {
            return $this->apiResponse(__('employee_not_found'), [], 404);
        }
    }

    public function deleteEmployee($id)
    {
        $user = auth()->user();

        $employee = User::find($id);

        if ($employee) {

            if ($employee->image !== null) {

                if (Storage::exists($employee->image)) {

                    Storage::delete($employee->image);
                }
            }

            $employee->delete();

            Log::create([
                'image' => $user->image ? $user->image : null,
                'message_ar' => $employee->first_name . ' ' .  $employee->family_name . ' بحذف الموظف ' . $user->first_name . ' ' . $user->family_name . ' قام الموظف ',
                'message_en' => 'The employee ' . $user->first_name . ' ' . $user->family_name . ' deleted employee' . $employee->first_name . ' ' .  $employee->family_name,
                'date' => Carbon::now(),
            ]);

            return $this->apiResponse(__('deleted_successfully'), [], 200);
        } else {
            return $this->apiResponse(__('employee_not_found'), [], 404);
        }
    }
}
