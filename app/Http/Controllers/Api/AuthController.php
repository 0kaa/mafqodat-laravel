<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Request;

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

    public function profile()
    {
        $user = auth()->user();

        return $this->apiResponse(__('login_successfully'), ['token' => $user->createToken('tokens')->plainTextToken, 'user' => new UserResource($user)], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->apiResponse(__('logout_successfully'));
    }
}
