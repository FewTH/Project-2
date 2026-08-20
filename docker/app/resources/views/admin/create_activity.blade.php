<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สร้างกิจกรรม</title>
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="icon" href="{{ asset('admin/img/Logo.png') }}">
</head>
<body>
   <!-- ชื่อผู้ใช้งาน -->
<div class="btn-user-wrapper">
    <a href="{{ url('admin/profile') }}" class="btn-user">
        <img src="{{ asset('admin/img/user.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        <span>Admin</span>
    </a>
</div>
<!--กรอบของเมนูปิดแท็กตรงออกจากระบบ-->
<div class="container-assessment">
    <!-- โลโกมหาลัย -->
    <div class="img-Logo">
        <img src="{{ asset('admin/img/Logo.png') }}" alt="รูปโลโกมหาลัย" class="Logo-img">
</div>
<!-- ปุ่มเมนู -->
<div class="btn-Sidebar-assessment">
    <a href="{{ url('admin/dashboard') }}" class="btn-Dashboard-assessment">
        <img src="{{ asset('admin/img/แดชบอร์ด.png') }}" alt="รูปแดชบอร์ด" class="btn-Dashboard-img-assessment">
        <span>แดชบอร์ด</span>
    </a>
    <a href="{{ url('admin/managereward') }}" class="btn-Manage_Rewards-assess">
        <img src="{{ asset('admin/img/รูปจัดการรางวัล.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Manage_Rewards-img-assess">
        <span>จัดการรางวัล</span>
    </a>
    <a href="{{ url('admin/manageuser') }}" class="btn-Manage_users">
        <img src="{{ asset('admin/img/รูปจัดการผู้ใช้.png') }}" alt="รูปติดต่อเรา" class="btn-Manage_users-img">
        <span>จัดการผู้ใช้</span>
    </a>
    <a href="{{ url('admin/managespin') }}" class="btn-Managewheel">
        <img src="{{ asset('admin/img/รูปจัดการวงล้อสุ่ม.png') }}" alt="รูปติดต่อเรา" class="btn-Managewheel-img">
        <span>จัดการวงล้อสุ่ม</span>
    </a>
    <a href="{{ url('admin/assessment') }}" class="btn-Assessment-assess">
        <img src="{{ asset('admin/img/รุปแบบประเมินกิจกรรมสีดำ.png') }}" alt="รูปติดต่อเรา" class="btn-Assessment-img-assess">
        <span>แบบประเมิน/กิจกรรม</span>
    </a>
</div>
<!-- ปุ่มกดออกจากระบบ -->
<div class="btn-logout-wrapper">
    <a href="{{ url('user/loginuser') }}" class="btn-logout">
        <img src="{{ asset('admin/img/รูปปุ่มกดออก.png') }}" alt="รูปออกจากระบบ" class="btn-logout-img">
        <span>ออกจากระบบ</span>
    </a>
    </div>
</div> 
<div class="main-content">
    <div>
        <h1></h1>
    </div>
</div>

</body>
</html>