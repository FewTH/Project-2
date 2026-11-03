<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private const ROLES = ['admin', 'manager', 'user'];

    // ทำ username ให้เหมือนกับตอน login (ตัด @buu.ac.th และตัวพิมพ์เล็ก)
    private function normalizeUsername(?string $username): string
    {
        return strtolower(trim(explode('@', (string) $username)[0]));
    }

    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('admin.manageuser', compact('users'));
    }

    public function create()
    {
        return view('admin.adduser');
    }

    public function store(Request $request)
    {
        $request->merge(['username' => $this->normalizeUsername($request->username)]);

        $data = $request->validate([
            'username'  => 'required|string|max:100|unique:users,username',
            'full_name' => 'required|string|max:200',
            'email'     => 'nullable|email|unique:users,email',
            'password'  => 'nullable|string|min:8',
            'role'      => ['required', Rule::in(self::ROLES)],
        ]);

        $hasPassword = !empty($data['password']);
        
        User::create([
            'username'      => $data['username'],
            'full_name'     => $data['full_name'],
            'email'         => $data['email'] ?? null,
            'password_hash' => $hasPassword ? $data['password'] : null,   // cast 'hashed' ของ Model จะ hash ให้เอง
            'role'          => $data['role'],
            'auth_source'   => $hasPassword ? 'local' : 'api',
            'is_active'     => true,
        ]);

        return redirect()->route('admin.manageuser')
                         ->with('success', 'เพิ่มผู้ใช้งานสำเร็จ');
    }

    public function edit($id)
    {
        $editUser = User::findOrFail($id);
        return view('admin.edituser', compact('editUser'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'email' => 'nullable|email|unique:users,email,' . $id . ',user_id',
            'role'  => ['required', Rule::in(self::ROLES)],
        ];

        // บัญชี local แก้ username และชื่อได้ บัญชี api แก้ไม่ได้
        if (!$user->isApiUser()) {
            $request->merge(['username' => $this->normalizeUsername($request->username)]);
            $rules['username']  = 'required|string|max:100|unique:users,username,' . $id . ',user_id';
            $rules['full_name'] = 'required|string|max:200';
        }

        $data = $request->validate($rules);

        // กันแอดมินลดสิทธิ์ตัวเอง
        if ($user->user_id === auth()->id() && $data['role'] !== $user->role) {
            return back()->withErrors(['role' => 'ไม่สามารถเปลี่ยนสิทธิ์ของบัญชีที่กำลังใช้งานอยู่ได้']);
        }

        $update = [
            'email' => $data['email'] ?? null,
            'role'  => $data['role'],
        ];

        if (!$user->isApiUser()) {
            $update['username']  = $data['username'];
            $update['full_name'] = $data['full_name'];
        }

        $user->update($update);

        return redirect()->route('admin.manageuser')
                         ->with('success', 'แก้ไขข้อมูลผู้ใช้งานสำเร็จ');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // กันแอดมินลบบัญชีตัวเอง
        if ($user->user_id === auth()->id()) {
            return back()->withErrors(['delete' => 'ไม่สามารถลบบัญชีที่กำลังใช้งานอยู่ได้']);
        }

        $user->delete();

        return redirect()->route('admin.manageuser')
                         ->with('success', 'ลบผู้ใช้งานเรียบร้อยแล้ว');
    }
}