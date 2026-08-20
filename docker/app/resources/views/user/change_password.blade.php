<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เปลี่ยนรหัสผ่าน</title>
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="icon" href="{{ asset('user/img/Logo.png') }}">
</head>
<body>
        <!-- ชื่อผู้ใช้งาน -->
<div class="btn-user-wrapper-1">
    <a href="{{ url('user/profile') }}" class="btn-user">
        <img src="{{ asset('user/img/user.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        <span>User</span>
   </a>
</div>
<!--กล่องครอบเมนูปิดแท็กตรงปุ่มออกจากระบบ-->
<div class="Top_frame">
    <div class="container-1">
   <!-- โลโกมหาลัย -->
   <div class="img-Logo">
        <img src="{{ asset('user/img/Logo.png') }}" alt="รูปโลโกมหาลัย" class="Logo-img">
   </div>
   <!-- ปุ่มเมนู -->
   <div class="btn-Sidebar">
        <a href="{{ url('user/home') }}" class="btn-Home-1">
            <img src="{{ asset('user/img/Home.png') }}" alt="รูปบ้าน" class="btn-Home-img-1">
            <span>หน้าหลัก</span>
        </a>
        <a href="{{ url('user/spin') }}" class="btn-Random-1">
            <img src="{{ asset('user/img/Random.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Random-img-1">
            <span>สุ่มของรางวัล</span>
        </a>
        <a href="{{ url('user/contact') }}" class="btn-Contact-1">
            <img src="{{ asset('user/img/Contact.png') }}" alt="รูปติดต่อเรา" class="btn-Contact-img-1">
            <span>ติดต่อเรา</span>
        </a>
    </div>
        <!-- ปุ่มกดออกจากระบบ -->
        <div class="btn-logout-wrapper">
            <a href="{{ url('user/loginuser') }}" class="btn-logout">
                <img src="{{ asset('user/img/รูปปุ่มกดออก.png') }}" alt="รูปออกจากระบบ" class="btn-logout-img">
                <span>ออกจากระบบ </span>
            </a>
        </div>
    </div>
</div> 
<!--เอาไว้ควบคุมส่วนกลางของเว็บปิดล่างสุด-->
<div class="main-content-change-password">
    <!--กรอบเปลี่ยนรหัสผ่าน-->
    <div class="framechangepassword">
        <div class=arrow-2>
        <a href="{{ url('user/profile') }}" class="arrow-1">←</a>
        </div>
        <img src="{{ asset('user/img/รูปเปลี่ยนรหัสผ่าน.png') }}" alt="รูปเปลี่ยนรหัสผ่าน" class="img-change-password-1">
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
<script src="{{ asset('user/js/JavaScript.js') }}"></script>
</body>
</html>