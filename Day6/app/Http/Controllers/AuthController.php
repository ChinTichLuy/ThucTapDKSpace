<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6', //'confirmed' Laravel mặc định sẽ tìm thêm một trường có hậu tố là "..._confirmation" trong form request để so sánh.
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Tự đăng nhập sau khi đăng ký
        Auth::login($user); // Laravel lưu session đăng nhập cho user

        return redirect('/dashboard');
    }

    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Lấy duy nhất 2 trường email và password từ request
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Regenerate lại session ID để bảo mật (chống session fixation)
            // session()->regenerate() rất quan trọng: giúp ngăn việc kẻ tấn công giữ session cũ sau khi đăng nhập thành công.
            return redirect('/dashboard')->with('success', 'Chào mừng đến với Dashboard!');
        }
        /*
        Auth::attempt() sẽ:
        - Tự động tìm user theo email
        - So sánh password bằng cách dùng Hash::check() với hash lưu trong DB
        */

        return back()->withErrors([
            'error' => 'Email hoặc mật khẩu không đúng.',
        ])->withInput(); //Giữ lại các input đã nhập
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất người dùng hiện tại (xóa thông tin user khỏi Auth)
        $request->session()->invalidate(); //Hủy toàn bộ session hiện tại (đảm bảo user không thể tiếp tục dùng session cũ)
        $request->session()->regenerateToken(); //Tạo lại CSRF token mới (chống tấn công giả mạo sau logout)

        return redirect('/login')->with('success', 'Đăng xuất thành công!');
    }

    // Hiển thị form yêu cầu reset
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // Gửi email reset
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Kiểm tra trạng thái gửi
        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Gửi email thành công!')
            : back()->withErrors(['error' => 'Email không tồn tại!']);

        //Password::RESET_LINK_SENT: là hằng số chứa chuỗi 'passwords.sent'
        // Laravel dùng để so sánh với $status trả về từ Password::sendResetLink().
    }

    // Hiển thị form reset từ email
    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    // Xử lý reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect('/login')->with('success', 'Đổi mật khẩu thành công! Vui lòng đăng nhập lại')
            : back()->withErrors(['error' => ['Đổi mật khẩu Thất bại']]);
    }
}
