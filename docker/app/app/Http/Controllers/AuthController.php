<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ApiLib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('user.loginuser');
    }

    public function login(Request $request, ApiLib $apiLib)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = strtolower(Str::before(trim($request->username), '@'));
        $remember = $request->has('remember');

        $user = User::where('username', $username)->first();
        $fail = fn() => back()->withErrors([
            'username' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
        ])->onlyInput('username');

        // ไม่มีบัญชีในระบบเรา = เข้าไม่ได้ (ApiLib ยืนยันตัวตนอย่างเดียว ไม่ได้ให้สิทธิ์)
        if (!$user) {
            return $fail();
        }

        if (!$user->is_active) {
            return back()->withErrors(['username' => 'บัญชีถูกปิดใช้งาน โปรดติดต่อเจ้าหน้าที่'])
                ->onlyInput('username');
        }

        if ($user->isApiUser()) {
            // บัญชีมหาวิทยาลัย: ตรวจกับ ApiLib
            try {
                $info = $apiLib->login($username, $request->password);
            } catch (\RuntimeException $e) {
                return back()->withErrors([
                    'username' => 'ระบบห้องสมุดไม่พร้อมใช้งานชั่วคราว ลองใหม่อีกครั้ง',
                ])->onlyInput('username');
            }

            if ($info === null) {
                return $fail();
            }

            // อัปเดตชื่อจาก API ให้ตรงเสมอ (ไม่แตะ role)
            if (!empty($info['fullname']) && $user->full_name !== $info['fullname']) {
                $user->update(['full_name' => $info['fullname']]);
            }

            Auth::login($user, $remember);
        } else {
            // บัญชีที่สร้างเองในระบบ (local): ตรวจ bcrypt ตามเดิม
            if (!Auth::attempt(['username' => $username, 'password' => $request->password], $remember)) {
                return $fail();
            }
        }

        $request->session()->regenerate();

        return match ($user->role) {
            'admin'   => redirect()->route('admin.dashboard'),
            'manager' => redirect()->route('manager.profile'),
            'user'    => redirect()->route('user.home'),
            default   => redirect('/'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}