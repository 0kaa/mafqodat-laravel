<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AuthRequest;
use App\Http\Requests\Dashboard\ResetRequest;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return \view('dashboard.auth.login');
    }

    public function login(AuthRequest $request)
    {
        //attempt to log admin
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return \redirect()->intended(\route('admin.home'))->with('success', __('login_successfully'));
        }

        return redirect()->back()->withInput($request->only('email','remember'))->with('error', __('wrong_credentials'));

    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function reset()
    {
        return view('dashboard.auth.reset');
    }

    public function sendLink(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {

            $code = \rand(1111, 9999);

            $user->update(['code' => $code]);

            $data = [
                'link' => route('admin.changePassword' , $code)
            ];

            Mail::to($user->email)->send(new ResetPassword($data));

            return redirect()->back()->with('success' , __('link_sent'));

        } else
        {

            return redirect()->back()->with('error' , __('email_not_found'));

        }

    }

    public function changePassword($code)
    {

        $user = User::where('code', $code)->first();

        if ($user) {
            return view('dashboard.auth.changePassword' , \compact('code'));
        } else {
            return \view('dashboard.auth.error');
        }

    }

    public function updatePassword(ResetRequest $request)
    {

        // dd($request->all());

        $user = User::where('code', $request->code)->first();

        $newPassword = $user->update(['password' => bcrypt($request->password)]);

        if ($newPassword) {

            $user->update(['code' => null]);

            return \redirect(\route('admin.login'))->with('success', __('password_changed'));

        } else {
            return redirect()->back()->with('error', __('password_not_changed'));
        }
    }

    public function notAuthorized()
    {
        return view('dashboard.authorize');
    }
}
