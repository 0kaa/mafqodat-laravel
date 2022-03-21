<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AuthRequest;
use App\Http\Requests\Dashboard\ResetRequest;
use App\Mail\SendMessage;
use App\Models\User;
use App\Repositories\Contract\UserRepositoryInterface;
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
            return \redirect()->intended(\route('admin.home'))->with('success', 'تم تسجيل الدخول بنجاح');
        }

        return redirect()->back()->withInput($request->only('email','remember'))->with('error', 'البريد الالكترونى او كلمة المرور غير صحيحة');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
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

            // Mail::to($user->email)->send(new SendMessage($data));

            return redirect()->back()->with('success' , 'تم ارسال رابط اعادة كلمة المرور الي البريد الالكتروني الخاص بك ');

        } else
        {

            return redirect()->back()->with('error' , 'البريد الالكتروني غير موجود');

        }

    }

    public function changePassword($code)
    {

        $user = $this->userRepository->getWhere(['code' => $code])->first();

        if ($user) {
            return view('dashboard.auth.changePassword' , \compact('code'));
        } else {
            return \view('dashboard.auth.error');
        }

    }

    public function updatePassword(ResetRequest $request)
    {

        $user = $this->userRepository->getWhere(['code' => $request->code])->first();

        if ($user->isVerified == 1) {

            $newPassword = $user->update(['password' => bcrypt($request->password)]);

        }

        if ($newPassword) {

            Auth::login($user);

            return \redirect(\route('admin.dashboard'))->with('success', 'تم تغيير كلمة المرور بنجاح');

        } else {
            return redirect()->back()->with('error', 'يوجد مشكله اثناء اعاده كلمة المرور  الخاصه  بك برجاء المحاولة مره اخري');
        }
    }

}
