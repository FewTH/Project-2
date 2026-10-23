<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ApiLib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // ดึงฟอร์ม login มา
    public function showLoginForm()
    {
        return view('user.loginuser');
    }

    // เอาข้อมูลที่กรอกจากฟอร์มมาตรวจ
    public function login(Request $request, ApiLib $apiLib)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // ถ้าผู้ใช้พิมพ์ชื่อพร้อม @buu.ac.th ให้ตัดส่วนหลังออก
        $username = Str::before(trim($request->username), '@');
        $remember = $request->has('remember');

        $user = User::where('username', $username)->first();
        $fail = fn() => back()->withErrors([
            'username' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
        ])->onlyInput('username');

        // ไม่มีบัญชีในระบบเรา = เข้าไม่ได้ (ApiLib ยืนยันตัวตนอย่างเดียว ไม่ได้ให้สิทธิ์)
        if (!$user) {
            return $fail();
        }

        // เช็กว่าบัญชีถูกปิดหรือเปล่า (ก่อนตรวจรหัสผ่าน)
        if (!$user->is_active) {
            return back()->withErrors(['username' => 'บัญชีถูกปิดใช้งาน โปรดติดต่อเจ้าหน้าที่'])
                ->onlyInput('username');
        }

        if (!empty($user->password_hash)) {
            // บัญชีที่มีรหัสผ่านในระบบเรา: ตรวจ bcrypt ตามเดิม
            if (!Auth::attempt(['username' => $username, 'password' => $request->password], $remember)) {
                return $fail();
            }
        } else {
            // บัญชีที่ไม่มีรหัสผ่าน: ตรวจกับบัญชีมหาวิทยาลัยผ่าน ApiLib
            if (!$apiLib->login($username, $request->password)) {
                return $fail();
            }
            Auth::login($user, $remember);
        }

        $request->session()->regenerate();

        // เมื่อ login แล้วจะแยกไปตาม role
        return match ($user->role) {
            'admin'   => redirect()->route('admin.dashboard'),
            'manager' => redirect()->route('manager.profile'),
            'user'    => redirect()->route('user.home'),
            default   => redirect('/'),
        };
    }

    // ออกจากระบบ
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}