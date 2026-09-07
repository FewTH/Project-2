<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เปลี่ยนรหัสผ่าน</title>
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="icon" href="{{ asset('admin/img/Logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<!-- ชื่อผู้ใช้งาน -->
<div class="btn-user-wrapper-1">
    <a href="{{ url('admin/profile') }}" class="btn-user">
        @if($user->profile_image)
        <img src="{{ asset('storage/'.$user->profile_image) }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @else
        <img src="{{ asset('admin/img/รูปuser.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @endif
        <span>Admin</span>
    </a>
</div>
<div class="container-1">
    <!-- โลโกมหาลัย -->
    <div class="img-Logo">
       <img src="{{ asset('admin/img/Logo.png') }}" alt="รูปโลโกมหาลัย" class="Logo-img">
    </div>
    <!-- ปุ่มเมนู -->
    <div class="btn-Sidebar">
        <a href="{{ url('admin/dashboard') }}" class="btn-Dashboard-1">
            <img src="{{ asset('admin/img/แดชบอร์ด.png') }}" alt="รูปแดชบอร์ด" class="btn-Dashboard-img-1">
            <span>แดชบอร์ด</span>
        </a>
        <a href="{{ url('admin/managereward') }}" class="btn-Manage_Rewards-1">
            <img src="{{ asset('admin/img/รูปจัดการรางวัล.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Manage_Rewards-img-1">
            <span>จัดการรางวัล</span>
        </a>
        <a href="{{ url('admin/manageuser') }}" class="btn-Manage_users-1">
            <img src="{{ asset('admin/img/รูปจัดการผู้ใช้.png') }}" alt="รูปติดต่อเรา" class="btn-Manage_users-img-1">
            <span>จัดการผู้ใช้</span>
        </a>
        <a href="{{ url('admin/managespin') }}" class="btn-Managewheel-1">
            <img src="{{ asset('admin/img/รูปจัดการวงล้อสุ่ม.png') }}" alt="รูปติดต่อเรา" class="btn-Managewheel-img-1">
            <span>จัดการวงล้อสุ่ม</span>
        </a>
        <a href="{{ url('admin/assessment') }}" class="btn-Assessment-1">
            <img src="{{ asset('admin/img/รูปแบบประเมินกิจกรรม.png') }}" alt="รูปติดต่อเรา" class="btn-Assessment-img-1">
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
<!--เอาไว้ควบคุมส่วนกลางของเว็บปิดล่างสุด-->
<div class="main-content-change-password">
    <!--กรอบเปลี่ยนรหัสผ่าน-->
    <div class="framechangepassword">
            <img src="{{ asset('admin/img/รูปเปลี่ยนรหัสผ่าน.png') }}" alt="รูปเปลี่ยนรหัสผ่าน" class="img-change-password-1">
            <h1 class="sectionchangepassword">เปลี่ยนรหัสผ่าน</h1>
            <p class="messagchangepassword">เปลี่ยนรหัสผ่านใหม่ของคุณได้ที่นี่</p>

        <form id="savesuccesschangepassword_1" action="{{ url('admin/change_password') }}" method="POST">
        @csrf
        @if (session('success'))
        <div class="savesuccesschangepassword" id="save_successchangepassword">
            <p class="savesuccess-changepassword"> {{ session('success') }} </p>
        </div>
        @endif
        <input type="text" name="username" value="{{ $user->username }}" autocomplete="username" class="usernamechangepassword">
        <div class="passwordcurrent-1">
            <label class="type-passwordcurrent-1" for="Type_Current_password_1">รหัสผ่านปัจจุบัน</label> <br>
            <div class="img-eye-password">
            <input type="password" class="input-passwordcurrent-1" id="Type_Current_password_1" name="current_password"  autocomplete="current-password">
            <button type="button" class="img-eye" id="img_eye_1">
                <i class="fa-regular fa-eye" id="icon_eye_1"></i>
            </button>
        </div>
            @error('current_password')
                <p class="savesuccesschangepassword-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="passwordcurrent">
            <label class="type-passwordcurrent-1" for="Type_passwordcurrent_1">เปลี่ยนรห้สผ่านใหม่</label> <br>
            <div class="img-eye-password">
            <input type="password" class="input-passwordcurrent-1" id="Type_passwordcurrent_1" name="new_password"  autocomplete="new-password">
            <button type="button" class="img-eye" id="img_eye_2">
                <i class="fa-regular fa-eye" id="icon_eye_2"></i>
            </button>
        </div>
            @error('new_password')
                <p class="savesuccesschangepassword-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="passwordlasttime">
            <label class="type-password-lasttime-1" for="Type_password-lasttime_1">เปลี่ยนรหัสผ่านครั้งล่าสุด</label> <br>
            <input type="text" class="input-password-lasttime-1" id="Type_password-lasttime_1" value="{{ $user->password_changed_at }}" disabled>
        </div>
        <div class="save-password-btn-cancel">
            <div class="save-password-1" id="save-password-1">
                <button type="submit" class="save-password-2">บันทึกรหัสผ่าน</button>
            </div>
        <div class="btn-cancel-password" id="btn_cancel_password">
            <button type="reset" class="btn-cancel-password-1">ยกเลิก</button>
        </div>
        </div>
        </form>
    </div>
</div>
<script src="{{ asset('admin/js/JavaScriptAdmin.js') }}"></script>
</body>
</html>