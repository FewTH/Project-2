<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <title>เพิ่มผู้ใช้</title>
</head>
<body>
    <!-- ชื่อผู้ใช้งาน -->
<div class="btn-user-wrapper">
    <a href="{{ url('admin/profile') }}" class="btn-user">
        @if($user->profile_image)
        <img src="{{ asset('storage/'.$user->profile_image) }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @else
        <img src="{{ asset('admin/img/รูปuser.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @endif
        <span>Admin</span>
    </a>
</div>

    <!-- ตัวฟอร์มให้ใส่รายละเอียดรางวัล -->
    <div class="add-box-main">
        <h1 class="Topic-adduser">เพิ่มผู้ใช้งาน</h1>
    <form id="add-usr-form" action="{{ route('admin.user.store') }}" method="POST">
    @csrf

    <!-- ช่องกรอกข้อมูลของรางวัล -->
    <div class="name-usr-box">
        <label class="name-usr01" for="name-usr-in">ชื่อผู้ใช้ (Username)</label> <br>
        <input type="text" class="name-usr-in" id="username" name="username" value="{{ old('username') }}" placeholder="กรอกชื่อของคุณ" required>
    </div>
    <div class="last-usr-box">
        <label class="last-name01" for="last-name-in">ชื่อ-นามสกุล</label> <br>
        <input type="text" class="last-name-in" id="full-name" name="full_name" value="{{ old('full_name') }}" placeholder="กรอกชื่อ-นามสกุลของคุณ" required>
    </div>
    <div class="emaill-usr-box">
        <label class="emaill-usr01" for="email">อีเมล</label> <br>
        <input type="email" class="emaill-usr-in" id="email" name="email" value="{{ old('email') }}" placeholder="กรอกอีเมลของคุณ" required>
    </div>
    <div class="role-usr-box">
        <label class="role-usr01" for="role-usr-in">บทบาท</label> <br>
        <select  class="role_list_01" id="role" name="role" required>
            <option value=""> --เลือกบทบาทของคุณ-- </option>
            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : ''}}>Admin</option>
            <option value="Manager" {{old('role')== 'Manager' ? 'selected' : ''}}>Manager</option>
            <option value="User" {{old('role')== 'User' ? 'selected' : ''}}>User</option>
        </select>     
    </div>
    <div class="passwd-addusr">
        <label class="passwd-usr-la" for="passwd-addusr-in">รหัสผ่าน</label> <br>
        <input type="password" class="passwd-addusr-in" id="passwd-addusr-in" name="password" placeholder="กรอกรหัสผ่านของคุณอย่างน้อย 8 ตัว" required>
    </div>
     {{-- ปุ่มบันทึกกับปุ่มยกเลิก --}}
    <div class="addusr-botton">
        <button type="submit" class="addusr-btn1">
            <span>บันทึกข้อมูล</span>
        </button>
        <a href="{{ url('admin/manageuser') }}" class="cancle-btn-addusr">
            <span>ยกเลิก</span>
        </a>
    </div>
</form>
</div>
    
<!-- ส่วนเมนูsidebar -->
    <div class="container2">
    <!-- โลโกมหาลัย -->
    <div class="img-Logo2">
        <img src="{{ asset('admin/img/Logo.png') }}" alt="รูปโลโกมหาลัย" class="Logo-img">
    </div>
    <!-- ปุ่มเมนู -->
    <div class="btn-Sidebar">
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
        <a href="{{ url('admin/managespin') }}" class="btn-Managewheel">
            <img src="{{ asset('admin/img/รูปจัดการวงล้อสุ่ม.png') }}" alt="รูปติดต่อเรา" class="btn-Managewheel-img">
            <span>จัดการวงล้อสุ่ม</span>
        </a>
        <a href="{{ url('admin/assessment') }}" class="btn-Assessment">
            <img src="{{ asset('admin/img/รูปแบบประเมินกิจกรรม.png') }}" alt="รูปติดต่อเรา" class="btn-Assessment-img">
            <span>แบบประเมิน/กิจกรรม</span>
        </a>
    </div>
    <!-- ปุ่มกดออกจากระบบ -->
    <div class="btn-logout-wrapper">
        <a href="{{ url('user/loginuser') }}" class="btn-logout2">
            <img src="{{ asset('admin/img/รูปปุ่มกดออก.png') }}" alt="รูปออกจากระบบ" class="btn-logout-img2">
            <span>ออกจากระบบ </span>
        </a>
    </div>
</div>
</body>
</html>