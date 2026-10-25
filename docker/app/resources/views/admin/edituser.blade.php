<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <title>แก้ไขผู้ใช้งาน</title>
</head>
<body>
    <!-- ชื่อผู้ใช้งาน -->
<div class="btn-user-wrapper">
    <a href="{{ url('admin/profile') }}" class="btn-user">
        @if($user?->profile_image)
        <img src="{{ asset('storage/'.$user->profile_image) }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @else
        <img src="{{ asset('admin/img/รูปuser.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @endif
        <span>Admin</span>
    </a>
</div>

    <div class="edit-box-main">
        <h1 class="edit-usr-title">แก้ไขผู้ใช้งาน</h1>
        {{-- เพิ่ม method --}}
    <form action="{{ route('admin.user.update', $editUser->user_id) }}" method="POST" id="edit-usr-form" autocomplete="off">
    @csrf
    @method('PUT') 

    {{-- ชื่อผู้ใช้ --}}
    <div class="name-usr-box">
        <label class="name-usr01" for="username">ชื่อผู้ใช้ (Username)</label> <br>
        <input type="text" class="name-usr-in" id="username" name="username" value="{{ old('username', $editUser->username) }}" placeholder="กรอกชื่อของคุณ" autocomplete="off" required>
        {{-- <input type="text"  class="name-usr-in" id="username" name="username"
       value="{{ old('username', $user->username) }}"
       autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" required> --}}
    </div>

    {{-- email --}}
    <div class="emaill-usr-box">
        <label class="emaill-usr01" for="email">อีเมล</label> <br>
        <input type="email" class="emaill-usr-in" id="email" name="email" value="{{ old('email', $editUser->email) }}" placeholder="กรอกอีเมลของคุณ" autocomplete="off" required>
        {{-- <input type="email" class="emaill-usr-in" id="email" name="email"
       value="{{ old('email', $user->email) }}"
       autocomplete="new-password" required> --}}
    </div>
    {{-- บทบาท --}}
    <div class="role-usr-box">
        <label class="role-usr01" for="role-usr-in">บทบาท</label> <br>
        <select  class="role_list_01" id="role" name="role" required>
            <option value=""> --เลือกบทบาทของคุณ-- </option>
            <option value="admin" {{ old('role', $editUser->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="manager" {{ old('role', $editUser->role) == 'manager' ? 'selected' : '' }}>Manager</option>
            <option value="user" {{ old('role', $editUser->role) == 'user' ? 'selected' : '' }}>User</option>
        </select>     
        </div>
        {{-- ปุ่มบันทีกกับยกเลิก --}}
        <div class="btn-sub_cln">
        <button type="submit" class="submit-btn-edtusr">
            <span>บันทึก</span>
            </button>

            <a href="{{url ('admin/manageuser')}}" class="cancle-btn-editusr">
                <span>ยกเลิก</span>
            </a>
        </div>
        </form>
        @if($errors->any())
            <div class="alert-error">{{ $errors->first() }}</div>
        @endif
        </div>
    

<!-- ส่วนเมนูsidebar -->
    <div class="container3">
    <!-- โลโกมหาลัย -->
    <div class="img-Logo3">
        <img src="{{ asset('admin/img/Logo.png') }}" alt="รูปโลโกมหาลัย" class="Logo-img3">
    </div>
    <!-- ปุ่มเมนู -->
    <div class="btn-Sidebar3">
        <a href="{{ url('admin/dashboard') }}" class="btn-Dashboard3">
            <img src="{{ asset('admin/img/แดชบอร์ด.png') }}" alt="รูปแดชบอร์ดสีดำ" class="btn-Dashboard-img3">
            <span>แดชบอร์ด</span>
        </a>
        <a href="{{ url('admin/managereward') }}" class="btn-Manage_Rewards3">
            <img src="{{ asset('admin/img/รูปจัดการรางวัล.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Manage_Rewards-img3">
            <span>จัดการรางวัล</span>
        </a>
        <a href="{{ url('admin/manageuser') }}" class="btn-Manage_users3">
            <img src="{{ asset('admin/img/รูปจัดการผู้ใช้สีดำ.png') }}" alt="รูปจัดการผู้ใช้" class="btn-Manage_users-img3">
            <span>จัดการผู้ใช้</span>
        </a>
        <a href="{{ url('admin/managespin') }}" class="btn-Managewheel3">
            <img src="{{ asset('admin/img/รูปจัดการวงล้อสุ่ม.png') }}" alt="รูปติดต่อเรา" class="btn-Managewheel-img3">
            <span>จัดการวงล้อสุ่ม</span>
        </a>
        <a href="{{ url('admin/assessment') }}" class="btn-Assessment3">
            <img src="{{ asset('admin/img/รูปแบบประเมินกิจกรรม.png') }}" alt="รูปติดต่อเรา" class="btn-Assessment-img3">
            <span>แบบประเมิน/กิจกรรม</span>
        </a>
    </div>
    <!-- ปุ่มกดออกจากระบบ -->
    <div class="btn-logout-wrapper">
        <a href="{{ url('user/loginuser') }}" class="btn-logout">
            <img src="{{ asset('admin/img/รูปปุ่มกดออก.png') }}" alt="รูปออกจากระบบ" class="btn-logout-img">
            <span>ออกจากระบบ </span>
        </a>
    </div>
</div>
</body>
</html>