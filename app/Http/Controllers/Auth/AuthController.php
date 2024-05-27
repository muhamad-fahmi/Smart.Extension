<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifikasiAkun;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showlogin()
    {
        return view('auth.login');
    }
    public function showregist()
    {
        return view('auth.register');
    }
    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|max:40',
                'password' => 'required|string|max:25'
            ]
        );

        $user = User::where('email', $request->email)->first();
        if (!isset($user)) {
            return redirect(route('login'))->with('error', 'Account not found!');
        } else {
           if ($user->email_verified_at != null) {
                Auth::attempt(
                    [
                        'email' => $request->email,
                        'password' => $request->password
                    ]
                );

                if (Auth::check()) {
                    if (auth()->user()->role_id == 1) {
                        return redirect(route('admin.dashboard'));
                    } else {
                        return redirect(route('customer.dashboard'));
                    }
                } else {
                    return redirect(route('login'))->with('error', 'username or password invalid !');
                }
           } else {
                return redirect(route('login'))->with('error', 'Your email not verified yet. check your email to verify your account !');
           }
        }
    }
    public function register(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|max:50',
                'whatsapp' => 'integer|required|min:10',
                'password' => 'required|string',
                'name' => 'required|string|max:30'
            ]
        );
        $user = User::where('email', $request->email)->orWhere('whatsapp', $request->whatsapp)->first();
        if (isset($user)) {
            return redirect()->back()->with('error', 'Email or Phone Number has been taken, enter other email !');
        } else {
            if ($request->email == env('MAIL_ADMIN')) {
                
                try {
                    Mail::to($request->email)->send(new VerifikasiAkun($request->email, $request->name, route('verifikasi', $request->email)));
                } catch (Exception $e) {
                    return redirect()->back()->with('error', 'Failed to register. Something error with smtp server, please contact web administrator !');
                }

                User::create(
                    [
                        'name' => $request->name,
                        'email' => $request->email,
                        'whatsapp' => $request->whatsapp,
                        'password' => Hash::make($request->password),
                        'role_id' => 1
                    ]
                );

                
                return redirect(route('login'))->with('success', 'Check your email to verify !');
            } else {
                try {
                    Mail::to($request->email)->send(new VerifikasiAkun($request->email, $request->name, route('verifikasi', $request->email)));
                } catch (Exception $e) {
                    return redirect()->back()->with('error', 'Failed to register. Something error with smtp server, please contact web administrator !');
                }

                User::create(
                    [
                        'name' => $request->name,
                        'email' => $request->email,
                        'whatsapp' => $request->whatsapp,
                        'password' => Hash::make($request->password),
                        'role_id' => 2
                    ]
                );
                
                return redirect(route('login'))->with('success', 'Check your email to verify !');
            }
        }
    }
    public function verify($email)
    {

        date_default_timezone_set("Asia/Bangkok");
        $user = User::where('email', $email)->first();
        if (isset($user)) {
            if (!isset($user->email_verified_at)) {
                User::where('email', $email)->update(
                    [
                        'email_verified_at' => date('Y-m-d H:i:s')
                    ]
                );
                return redirect(route('login'))->with('success', 'Your account has been activated !');
            } else {
                return redirect(route('login'))->with('error', 'Your account is active !');
            }
        } else {
            return redirect(route('login'))->with('error', 'Email is invalid!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
