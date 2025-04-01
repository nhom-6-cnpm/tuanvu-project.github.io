<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Slider;

class LoginController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        // Kiểm tra xem email có tồn tại và có phải là admin không
        $user = User::where('email', $request->input('email'))
                   ->where('role', 'admin')
                   ->first();

        if (!$user) {
            Session::flash('error', 'Tài khoản admin không tồn tại');
            return redirect()->back();
        }

        if (Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'role' => 'admin' // Thêm điều kiện role = admin
            ], $request->input('remember'))) {

            return redirect()->route('admin');
        }

        Session::flash('error', 'Email hoặc Password không đúng');
        return redirect()->back();
    }

    public function createAccount(Request $request)
    {
        $this->validate($request, [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'regex:/^[\p{L}\s]+$/u'
            ],
            'email' => [
                'required',
                'string',
                'email:filter',
                'max:255',
                'unique:users',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'max:32',
                'confirmed',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/'
            ]
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
            'name.min' => 'Họ tên phải có ít nhất 3 ký tự',
            'name.regex' => 'Họ tên chỉ được chứa chữ cái và khoảng trắng',

            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được sử dụng',
            'email.regex' => 'Email không hợp lệ',

            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu không được quá 32 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
            'password.regex' => 'Mật khẩu phải chứa ít nhất 1 chữ cái và 1 số'
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user'
            ]);

            Session::flash('success', 'Đăng ký tài khoản thành công');
            return redirect()->route('user.login');
        } catch (\Exception $err) {
            Session::flash('error', 'Đăng ký tài khoản thất bại. Vui lòng thử lại!');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }

    public function adminLogout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function userLogin()
    {
        $sliders = Slider::where('active', 1)->orderByDesc('sort_by')->get();
        return view('users.login', [
            'title' => 'Đăng Nhập',
            'sliders' => $sliders
        ]);
    }

    public function userRegister()
    {
        $sliders = Slider::where('active', 1)->orderByDesc('sort_by')->get();
        return view('users.register', [
            'title' => 'Đăng Ký Tài Khoản',
            'sliders' => $sliders
        ]);
    }

    public function userStore(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        // Thực hiện đăng nhập không cần kiểm tra role trước
        if (Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ], $request->input('remember'))) {

            // Sau khi đăng nhập thành công, kiểm tra role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin');
            }
            return redirect('/');
        }

        Session::flash('error', 'Email hoặc Password không đúng');
        return redirect()->back();
    }
}