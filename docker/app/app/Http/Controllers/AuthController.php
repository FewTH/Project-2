<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ApiLib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // บทบาทเริ่มต้นของบุคลากรห้องสมุดที่เข้าสู่ระบบครั้งแรก (ผู้ดูแลระบบเปลี่ยนได้ที่หน้าจัดการผู้ใช้)
    private const NEW_STAFF_ROLE = 'user';

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

        // ตัด @buu.ac.th หรือ @go.buu.ac.th ออก ApiLib ต้องการแค่ชื่อผู้ใช้ส่วนหน้า
        $username = strtolower(Str::before(trim($request->username), '@'));
        $remember = $request->has('remember');

        $user = User::where('username', $username)->first();
        $fail = fn() => back()->withErrors([
            'username' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
        ])->onlyInput('username');
        $apiDown = fn() => back()->withErrors([
            'username' => 'ระบบห้องสมุดไม่พร้อมใช้งานชั่วคราว ลองใหม่อีกครั้ง',
        ])->onlyInput('username');

        // ยังไม่มีบัญชีในระบบ: สร้างให้อัตโนมัติ เฉพาะบุคลากรห้องสมุดเท่านั้น (statusauth = library)
        if (!$user) {
            try {
                $info = $apiLib->login($username, $request->password, 'library');
            } catch (\RuntimeException $e) {
                return $apiDown();
            }

            // รหัสผ่านผิด หรือไม่ใช่บุคลากรห้องสมุด ใช้ข้อความเดียวกันเพื่อไม่บอกใบ้ว่าผิดตรงไหน
            if ($info === null) {
                return $fail();
            }

            $user = User::firstOrCreate(
                ['username' => $username],
                [
                    'full_name'     => ($info['fullname'] ?? '') ?: $username,
                    'email'         => ($info['email'] ?? '') ?: null,
                    'password_hash' => null,          // เข้าสู่ระบบผ่าน ApiLib ไม่เก็บรหัสผ่าน
                    'role'          => self::NEW_STAFF_ROLE,
                    'auth_source'   => 'api',
                    'is_active'     => true,
                ]
            );

            Auth::login($user, $remember);
            $request->session()->regenerate();

            return $this->redirectByRole($user);
        }

        if (!$user->is_active) {
            return back()->withErrors(['username' => 'บัญชีถูกปิดใช้งาน โปรดติดต่อเจ้าหน้าที่'])
                ->onlyInput('username');
        }

        if ($user->isApiUser()) {
            // บัญชีมหาวิทยาลัยที่มีอยู่แล้ว: ตรวจกับ ApiLib
            try {
                $info = $apiLib->login($username, $request->password);
            } catch (\RuntimeException $e) {
                return $apiDown();
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

        return $this->redirectByRole($user);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // พาไปหน้าแรกตามบทบาท
    private function redirectByRole(User $user)
    {
        return match ($user->role) {
            'admin'   => redirect()->route('admin.dashboard'),
            'manager' => redirect()->route('manager.profile'),
            'user'    => redirect()->route('user.home'),
            default   => redirect('/'),
        };
    }
}