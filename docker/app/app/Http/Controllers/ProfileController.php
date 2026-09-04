<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //เอาไว้ดึงข้อมูลuserมาใช้งานซ้ำ
    private function getUser()
    {
        return Auth::user() ?? User::find(1);
    }


    //ส่วนของ user
    //แสดงข้อมูลโปรไฟล์ของผู้ใช้ของ user
    public function userProfile()
    {
        return view('user.profile', ['user' => $this->getUser()]);
    }

    public function userEditForm()
    {
        return view('user.edit_information', ['user' => $this->getUser()]);
    }

    public function userchangePassword()
    {
        return view('user.change_password', ['user' => $this->getUser()]);
    }


    //ส่วนของ admin
    public function adminProfile()
    {
        return view('admin.profile', ['user' => $this->getUser()]);
    }

    public function adminEditForm()
    {

        return view('admin.edit_information', ['user' => $this->getUser()]);
    }

    public function adminchangePassword()
    {
        return view('admin.change_password', ['user' => $this->getUser()]);
    }

    //ส่วนของ manager
    public function managerProfile()
    {
        return view('manager.profile',['user' => $this->getUser()]);
    }

    public function managerEditForm()
    {
        return view('manager.edit_information', ['user' => $this->getUser()]);
    }

    public function managerchangePassword()
    {
        return view('manager.change_password', ['user' => $this->getUser()]);
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
        $user = $this->getUser();
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
        $user = $this->getUser();
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

    // บันทึกการเปลี่ยนรูปโปรไฟล์
    public function uploadimg(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,webp|max:5120',
        ],[
            'profile_image.required' => 'กรุณาเลือกรูปภาพ',
            'profile_image.image' => 'ต้องเป็นรูปภาพเท่านั้น',
            'profile_image.mimes' => 'ต้องเป็นไฟล์ jpeg, png, webp เท่านั้น',
            'profile_image.max' => 'ไฟล์รูปต้องมีขนาดไม่เกิน 5 MB',
        ]);

        $user = $this->getUser();

        // เอาไว้ลบรูปภาพเก่าทิ้งก่อนไม่งั้นภาพเก่ามันจะค้างอยู่ในdatabaseเรื่อยๆ
        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)){
            Storage::disk('public')->delete($user->profile_image);
        }

        $savenewphoto = $request->file('profile_image')->store('profile_images', 'public');

        $user->update(['profile_image' => $savenewphoto] );

        return back()->with('success', '✓ เปลี่ยนรูปภาพใหม่สำเร็จแล้ว')
                     ->with('open_popup', true);

    }


}
