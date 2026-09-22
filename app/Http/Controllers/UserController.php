<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /* ================= REGISTER ================= */
    public function showRegisterForm()
    {
        return view('users.register');
    }

    public function register(Request $request)
    {
        $input = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $input['password'] = Hash::make($input['password']);
        $input['role'] = 'CUSTOMER';

        User::create($input);

        return redirect()->route('login.form')
            ->with('success', 'Đăng ký thành công, vui lòng đăng nhập.');
    }

    /* ================= LOGIN ================= */
    public function showLoginForm()
    {
        return view('users.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->with('error', 'Email hoặc mật khẩu không đúng.');
        }

        $user = Auth::user();

        /* ===== ADMIN ===== */
        if ($user->role === 'ADMIN') {
            return redirect('/admin/products')
                ->with('success', 'Chào mừng Admin!');
        }

        /* ===== STAFF ===== */
        if ($user->role === 'STAFF') {

            // Nhân viên bếp
            if ($user->staff_type === 'KITCHEN') {
                return redirect('/kitchen')
                    ->with('success', 'Chào mừng nhân viên bếp!');
            }

            // Nhân viên phục vụ
            if ($user->staff_type === 'WAITER') {
                return redirect('/waiter')
                    ->with('success', 'Chào mừng nhân viên phục vụ!');
            }
        }

        /* ===== CUSTOMER ===== */
        return redirect('/trangchu')
            ->with('success', 'Đăng nhập thành công!');
    }

    /* ================= LOGOUT ================= */
    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect('/trangchu');
    }

    /* ================= PROFILE ================= */
    public function profile()
    {
        return view('users.profile', ['user' => Auth::user()]);
    }

    /* ================= CHANGE PASSWORD ================= */
    public function changePasswordForm()
    {
        return view('users.change_password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->with('error', 'Mật khẩu hiện tại không đúng.');
        }

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile')
            ->with('success', 'Đổi mật khẩu thành công!');
    }
}
