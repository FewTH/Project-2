<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เปลี่ยนรหัสผ่าน</title>
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="icon" href="{{ asset('admin/img/Logo.png') }}">
</head>
<body>
<!-- ชื่อผู้ใช้งาน -->
<div class="btn-user-wrapper-1">
    <a href="{{ url('admin/profile') }}" class="btn-user">
        <img src="{{ asset('admin/img/user.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
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
        <div class=arrow-2>
        <a href="{{ url('admin/profile') }}" class="arrow-1">←</a>
        </div>
        <img src="{{ asset('admin/img/รูปเปลี่ยนรหัสผ่าน.png') }}" alt="รูปเปลี่ยนรหัสผ่าน" class="img-change-password-1">
        <h1 class="sectionchangepassword">เปลี่ยนรหัสผ่าน</h1>
        <p class="messagchangepassword">เปลี่ยนรหัสผ่านใหม่ของคุณได้ที่นี่</p>
        <div class="savesuccesschangepassword" id="save_successchangepassword">
            <p class="savesuccess-changepassword"> ✓ บันทึกรหัสผ่านสำเร็จแล้ว </p>
        </div>
        <div class="passwordcurrent">
            <label class="type-passwordcurrent-1" for="Type_passwordcurrent_1">รหัสผ่านปัจจุบัน</label> <br>
            <div class="img-eye-password">
            <input type="password" class="input-passwordcurrent-1" id="Type_passwordcurrent_1" value="12345678" >
            <button class="img-eye" id="img_eye">👁</button>
            </div>
            <p class="pleasepassword" id="please_password">กรุณาใส่รหัสผ่านให้ถูกต้อง เช่น 12345678</p>
        </div>
        <div class="passwordlasttime">
            <label class="type-password-lasttime-1" for="Type_password-lasttime_1">เปลี่ยนรหัสผ่านครั้งล่าสุด</label> <br>
            <input type="text" class="input-password-lasttime-1" id="Type_password-lasttime_1" value="01/01/2026" disabled>
        </div>
        <div class="save-password-btn-cancel">
            <div class="save-password-1" id="save-password-1">
        <button class="save-password-2">บันทึกรหัสผ่าน</button>
            </div>
        <div class="btn-cancel-password" id="btn_cancel_password">
            <button class="btn-cancel-password-1">ยกเลิก</button>
        </div>
        </div>
    </div>
</div>
<script src="{{ asset('admin/js/JavaScriptAdmin.js') }}"></script>
</body>
</html>