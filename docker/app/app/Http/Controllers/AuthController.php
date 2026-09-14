<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{   
    // ดึงฟอร์มloginมา
    public function showLoginForm()
    {
        return view('user.loginuser');
    }
    // เอาข้อมูลที่กรอกจากฟอร์มมาตรวจ
    public function login(Request $request)
    {
        $request->validate([
            'username'=>'required|string',
            'password'=>'required|string',
        ]);

        $credentials=[
            'username'=> $request->username,
            'password'=> $request->password,
        ];

        $remember = $request->has('remember');

        if(Auth::attempt($credentials,$remember)){
            $request -> session() -> regenerate();
            $user=Auth::user();
            
            // เช็คว่าบัญชีถูกปิดหรือป่าว
            if(!$user->is_active){
                Auth::logout();
                return back()->withErrors(['username'=>'บัญถูกปิดใช้งาน โปรดติดต่อเข้าหน้าที่']);
            }
            // เมื่อloginแล้วจะแยกไปตามrole
            return match($user->role){
                'admin' => redirect()->route('admin.dashboard'),
                'manager' => redicrect()->route('manager.profile'),
                'user' => redirect()->route('user.home'),
                default => redirect('/'),
            };
        }
        return back()->withErrors([
            'username'=>'ชื่อผู้ใช้ไม่ถูกต้อง',
        ])->onlyInput('username');
    }
    // ไว้ออกจากระบบ
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
