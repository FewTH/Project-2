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
        <img src="{{ asset('admin/img/user.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        <span>Admin</span>
    </a>
</div>
    
    <!-- ตัวฟอร์มให้ใส่รายละเอียดรางวัล -->
<div class="add-box-main">
    <h1 class="Topic-adduser">เพิ่มผู้ใช้งาน</h1>
    <!-- ช่องกรอกข้อมูลของรางวัล -->
    <div class="name-usr-box">
        <label class="name-usr01" for="name-usr">ชื่อ</label> <br>
        <input type="text" class="name-usr-in" id="name-usr-in">
    </div>
    <div class="last-usr-box">
        <label class="last-name01" for="last-name">นามสกุล</label> <br>
        <input type="text" class="last-name-in" id="last-name-in">
    </div>
    <div class="role-usr-box">
        <label class="role-usr01" for="role-usr">บทบาท</label> <br>
        <input type="text" class="role-usr-in" id="role-usr-in" list="role_list" placeholder="กรุณากรอกหรือเลือกหมวดหมู่">
    <datalist  class="role_list_01" id="role_list">
            <option value="Admin">
            <option value="User">
            <option value="Manager">
    </datalist>     
    </div>   
    <div class="ad-botton">
        <a href="{{ url('admin/manageuser') }}" class="addreward-btn1">
            <span>บันทึกข้อมูล</span>
        </a>
        <a href="{{ url('admin/manageuser') }}" class="cancle-btn">
            <span>ยกเลิก</span>
        </a>
    </div>
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