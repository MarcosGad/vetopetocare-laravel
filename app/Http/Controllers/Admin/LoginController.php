<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function  getLogin(){
        return view('admin.auth.login');
    }

    public function superAdmin(){
        $admin = new App\Models\Admin();
        $admin->name ="Super Admin";
        $admin->email ="superadmin@admin.com";
        $admin->password = bcrypt("123123123");
        $admin->type = 1; // 1 -> super admin
        $admin->save();
    }

    public function admin(){
        $admin = new App\Models\Admin();
        $admin->name ="Admin";
        $admin->email ="admin@admin.com";
        $admin->password = bcrypt("123123123");
        $admin->type = 2; // 2 -> admin
        $admin->save();
    }

    public function login(LoginRequest $request){

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
           // notify()->success('تم الدخول بنجاح  ');
            return redirect() -> route('admin.dashboard');
        }
       // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
    }

    public function logout() {
        Auth::logout();
        return redirect('admin/login');
    }
}
