<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // ตรวจสอบความถูกต้องของข้อมูล
        $request->validate([
            'username'  => 'required|string|max:255|unique:users,username',
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:6',
            'role'      => 'required|string',
        ]);

        // บันทึกลงฐานข้อมูล
        User::create([
            'username'      => $request->username,
            'full_name'     => $request->full_name,
            'email'         => $request->email,
            'password_hash' => Hash::make($request->password),
            'role'          => $request->role,
            'is_active'     => true,
        ]);

        // ส่งผู้ใช้กลับไปยังหน้าจัดการ พร้อมข้อความแจ้งเตือนสำเร็จ
        return redirect()->route('admin.manageuser')
                         ->with('success', 'เพิ่มผู้ใช้งานสำเร็จ');
    }
    // 
    public function index()
    {
        // เอาผู้ใช้ที่เพิ่งสร้างกลับไปแสดงที่หน้าmanageuserของแอดมิน
        $users = User::latest()->get();
        // ส่งตัวแปร users ไปให้หน้า manageuser
        return view('admin.manageuser', compact('users'));
    }
    // ดึงหน้าฟอร์มที่เพิ่มผู้ใช้มาไม่มีก็แตก
    public function create()
    {
        return view('admin.adduser');
    }
    // ฟังก์ชันที่ลบผู้ใช้งาน
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.manageuser')->with('success', 'ลบผู้ใช้งานเรียบร้อยแล้ว');
    }
    // แก้ไขผู้ใช้
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edituser', compact('user'));
    }

    // รับข้อมูลที่แก้ไขแล้ว มาบันทึกทับของเดิม
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username'  => 'required|string|max:255|unique:users,username,' . $id . ',user_id',
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $id . ',user_id',
            'role'      => 'required|string',
        ]);

        $user->update([
            'username'  => $request->username,
            'full_name' => $request->full_name,
            'email'     => $request->email,
            'role'      => $request->role,
        ]);

        return redirect()->route('admin.manageuser') ->with('success', 'แก้ไขข้อมูลผู้ใช้งานสำเร็จ');
    }
}
