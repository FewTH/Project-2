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
            'password'  => 'required|string|min:8',
            'role'      => ['required', Rule::in(self::ROLES)],
            // 'role'      => 'required|string',
        ]);

        $attrs = [
            'username'  => $data['username'],
            'full_name' => $data['full_name'],
            'email'     => $data['email'] ?? null,
            'role'      => $data['role'],
            'is_active' => true,
        ];
        // ใส่ password_hash เฉพาะเมื่อกรอกมา (cast 'hashed' ของ Model จะ hash ให้เอง)
        if (!empty($data['password'])) {
            $attrs['password_hash'] = $data['password'];
        }
        User::create($attrs);
        // บันทึกลงฐานข้อมูล
        // User::create([
        //     'username'      => $request->username,
        //     'full_name'     => $request->full_name,
        //     'email'         => $request->email,
        //     'password_hash' => $request->password,
        //     'role'          => $request->role,
        //     'is_active'     => true,
        // ]);

        // ส่งผู้ใช้กลับไปยังหน้าจัดการ พร้อมข้อความแจ้งเตือนสำเร็จ
        return redirect()->route('admin.manageuser')
                         ->with('success', 'เพิ่มผู้ใช้งานสำเร็จ');
    }
    // 
    public function index()
    {
        // เอาผู้ใช้ที่เพิ่งสร้างกลับไปแสดงที่หน้าmanageuserของแอดมินกำหนดแสดงแค่10คน
        $users = User::latest()->paginate(5);
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

        if ($user->user_id === auth()->id()) {
            return back()->withErrors(['delete' => 'ไม่สามารถลบบัญชีที่กำลังใช้งานอยู่ได้']);
        }

        $user->delete();

        return redirect()->route('admin.manageuser')->with('success', 'ลบผู้ใช้งานเรียบร้อยแล้ว');
    }
    // public function destroy($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->delete();

    //     return redirect()->route('admin.manageuser')->with('success', 'ลบผู้ใช้งานเรียบร้อยแล้ว');
    // }
    // แก้ไขผู้ใช้
    public function edit($id)
    {
        $editUser = User::findOrFail($id);
        return view('admin.edituser', compact('editUser'));
    }
    public function update(Request $request, $id)
    {
    $user = User::findOrFail($id);
    $isApiUser = $user->auth_source === 'api';

    $rules = [
        'email'     => 'nullable|email|unique:users,email,' . $id . ',user_id',
        'role'      => ['required', Rule::in(self::ROLES)],
        'is_active' => 'nullable|boolean',
    ];

    // ผู้ใช้ local แก้ username ได้
    if (!$isApiUser) {
        $request->merge(['username' => $this->normalizeUsername($request->username)]);
        $rules['username']  = 'required|string|max:255|unique:users,username,' . $id . ',user_id';
        $rules['full_name'] = 'required|string|max:255';
    }

    $data = $request->validate($rules);

    if ($user->user_id === auth()->id() && $data['role'] !== $user->role) {
        return back()->withErrors(['role' => 'ไม่สามารถเปลี่ยนสิทธิ์ของบัญชีที่กำลังใช้งานอยู่ได้']);
    }

    $update = [
        'email'     => $data['email'] ?? null,
        'role'      => $data['role'],
        'is_active' => $request->boolean('is_active', $user->is_active),
    ];

    if (!$isApiUser) {
        $update['username']  = $data['username'];
        $update['full_name'] = $data['full_name'];
    }

    $user->update($update);

    return redirect()->route('admin.manageuser')->with('success', 'แก้ไขข้อมูลผู้ใช้งานสำเร็จ');
    }
    //  public function update(Request $request, $id)
    // {
    //     $user = User::findOrFail($id);

    //     $data = $request->validate([
    //         'email'     => 'nullable|email|unique:users,email,' . $id . ',user_id',
    //         'role'      => ['required', Rule::in(self::ROLES)],
    //         'is_active' => 'nullable|boolean',
    //     ]);

    //     // กันแอดมินลดสิทธิ์ตัวเอง
    //     if ($user->user_id === auth()->id() && $data['role'] !== $user->role) {
    //         return back()->withErrors(['role' => 'ไม่สามารถเปลี่ยนสิทธิ์ของบัญชีที่กำลังใช้งานอยู่ได้']);
    //     }

    //     $user->update([
    //         'email'     => $data['email'] ?? null,
    //         'role'      => $data['role'],
    //         'is_active' => $request->boolean('is_active', $user->is_active),
    //     ]);
    //     // ไม่แก้ username และ full_name: ชื่อมาจาก API และจะอัปเดตเองตอนล็อกอิน

    //     return redirect()->route('admin.manageuser')->with('success', 'แก้ไขข้อมูลผู้ใช้งานสำเร็จ');
    // }
    // รับข้อมูลที่แก้ไขแล้ว มาบันทึกทับของเดิม
    // public function update(Request $request, $id)
    // {
    //     $user = User::findOrFail($id);

    //     $request->validate([
    //         'username'  => 'required|string|max:255|unique:users,username,' . $id . ',user_id',
    //         // 'full_name' => 'required|string|max:255',
    //         'email'     => 'required|email|unique:users,email,' . $id . ',user_id',
    //         'role'      => 'required|string',
    //     ]);

    //     $user->update([
    //         'username'  => $request->username,
    //         // 'full_name' => $request->full_name,
    //         'email'     => $request->email,
    //         'role'      => $request->role,
    //     ]);

    //     return redirect()->route('admin.manageuser') ->with('success', 'แก้ไขข้อมูลผู้ใช้งานสำเร็จ');
    // }
}
