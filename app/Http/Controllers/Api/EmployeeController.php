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
        $user = auth()->user();
        $employees = User::where('id', '!=', $user->id)->whereDoesntHave('roles')->paginate(8);

        $employees->transform(function ($employee) {
            return new UserResource($employee);
        });

        return $this->apiResponse('', new PaginationResource($employees), 200);
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
            'name'     => 'required|min:3',
            'email'    => 'required|unique:users,email',
            'password' => 'required|min:6',
            'phone'    => 'required|min:8|max:12',
            'job_number' => 'required',
            'working_period' => 'required|in:morning,evening,night',
            'date_of_hiring' => 'required',
        ], [
            'name.required'     => __('name_required'),
            'name.min'          => __('name_min'),
            'email.required'    => __('email_required'),
            'email.unique'      => __('email_unique'),
            'password.required' => __('password_required'),
            'password.min'      => __('password_min'),
            'phone.required'    => __('phone_required'),
            'phone.min'         => __('phone_min'),
            'phone.max'         => __('phone_max'),
            'job_number.required' => __('job_number_required'),
            'working_period.required' => __('working_period_required'),
            'working_period.in' => __('working_period_in'),
            'date_of_hiring.required' => __('date_of_hiring_required'),

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
            'user_id' => $user->id,
            'message_ar' => 'لقد قمت بإضافة موظف جديد',
            'message_en' => 'I have added a new employee',
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
                'name'           => 'required|min:3',
                'email'          => 'required|unique:users,email,' . $id,
                'password'       => 'required|min:6',
                'phone'          => 'required|min:8|max:12',
                'job_number'     => 'required',
                'working_period' => 'required|in:morning,evening,night',
                'date_of_hiring' => 'required',
            ], [
                'name.required'     => __('name_required'),
                'name.min'          => __('name_min'),
                'email.required'    => __('email_required'),
                'email.unique'      => __('email_unique'),
                'password.required' => __('password_required'),
                'password.min'      => __('password_min'),
                'phone.required'    => __('phone_required'),
                'phone.min'         => __('phone_min'),
                'phone.max'         => __('phone_max'),
                'job_number.required' => __('job_number_required'),
                'working_period.required' => __('working_period_required'),
                'working_period.in' => __('working_period_in'),
                'date_of_hiring.required' => __('date_of_hiring_required'),

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

            if (!preg_match('/[^A-Za-z0-9]/', $employee->name)) {
                $message_ar = $employee->name . ' لقد قمت بتعديل بيانات الموظف';
            } else {
                $message_ar = 'لقد قمت بتعديل بيانات الموظف ' . $employee->name;
            }
            Log::create([
                'user_id' => $user->id,
                'message_ar' => $message_ar,
                'message_en' => 'I have updated the employee ' . $employee->name,
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
                'user_id' => $user->id,
                'message_ar' => $employee->name . ' لقد قمت بحذف الموظف',
                'message_en' => 'I have deleted the employee ' . $employee->name,
                'date' => Carbon::now(),
            ]);

            return $this->apiResponse(__('deleted_successfully'), [], 200);
        } else {
            return $this->apiResponse(__('employee_not_found'), [], 404);
        }
    }
}
