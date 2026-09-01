<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //ส่วนของ user
    //แสดงข้อมูลโปรไฟล์ของผู้ใช้ของ user
    public function userProfile()
    {
        $user = User::find(1);
        return view('user.profile', ['user' => $user]);
    }

    public function userEditForm()
    {
        $user = User::find(1);
        return view('user.edit_information', ['user' => $user]);
    }

    public function userchangePassword()
    {
        $user = User::find(1);
        return view('user.change_password', ['user' => $user]);
    }


    //ส่วนของ admin
    public function adminProfile()
    {
        $user = User::find(1);
        return view('admin.profile', ['user' => $user]);
    }

    public function adminEditForm()
    {
        $user = User::find(1);
        return view('admin.edit_information', ['user' => $user]);
    }

    public function adminchangePassword()
    {
        $user = User::find(1);
        return view('admin.change_password', ['user' => $user]);
    }

    // ส่วนของ user admin ใช่ร่วมกัน
    // บันทึกข้อมูลที่แก้ไข
    public function editinformation(Request $request) 
    {   
        // เอาไว้ลบขีดออกก่อนเพื่อมีคนใส่มาเดียวค่ามันเพี้ยน
        if ($request->filled('phone')){
            $cleandash = str_replace(['-', ' '], '', $request['phone']);
            $request->merge(['phone' => $cleandash]);
        }

        $data = $request->validate([
            'username' => 'required|string|max:100',
            'full_name' => 'required|string|max:200',
            'email' => 'required|email|max:200',
            'phone' => 'nullable|digits:10',
        ],[
                'username.required' => 'กรุณากรอกชื่อผู้ใช้ด้วย',
                'full_name.required' => 'กรุณากรอกชื่อ-นามสกุลด้วย',
                'email.required' => 'กรุณากรอกอีเมลด้วย',
                'email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
                'phone.digits' => 'เบอร์โทรต้องมีความยาว 10 ตัวอักษร',
        ]);

      
        //หาuser ที่จะแก้ไขแล้วให้มันอัพเดทข้อมูลใน database แล้วส่ง return กลับมา
        $user = User::find(1);
        $user->update($data);
        return back()->with('success', '✓ บันทึกข้อมูลสำเร็จแล้ว');
    }

    // บันทึกการเปลี่ยนรหัสผ่าน
    public function changePassword(Request $request) 
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
        ],[
            'current_password.required' => 'กรุณากรอกรหัสผ่านปัจจุบันด้วย',
            'new_password.required' => 'กรุณากรอกรหัสผ่านใหม่ด้วย',
            'new_password.min' => 'รหัสผ่านใหม่ต้องมีความยาวอย่างน้อย 8 ตัวอักษร',
        ]);

        //หาuser ที่จะแก้ไข
        $user = User::find(1);
        $checkpassword = Hash::check($request->current_password, $user->password_hash);

        if (!$checkpassword) {
            return back()->withErrors(['current_password' => 'รหัสผ่านปัจจุบันไม่ถูกต้อง']);
        }

        // ถ้าถูกต้อง ให้บันทึกรหัสผ่านใหม่
        $user->password_hash = $request->new_password;
        $user->password_changed_at = now();
        $user->save();

        return back()->with('success', '✓ เปลี่ยนรหัสผ่านสำเร็จแล้ว');
    }
}
