<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="icon" href="{{ asset('admin/img/Logo.png') }}">
    <title>จัดการผู้ใช้</title>
</head>
<body class="Mainbody-manageuser">
    <!-- ชื่อผู้ใช้งาน -->
    <div class="btn-user-wrapper">
    <a href="{{ url('admin/profile') }}" class="btn-user">
        <img src="{{ asset('admin/img/user.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        <span>Admin</span>
    </a>
    </div>
    <div class="manageuser-box">
        <h1 class="manageusr-title">จัดการสิทธิ์ผู้ใช้งาน</h1>
        <!-- บ็อกหลักรายชื่อผู้ใช้ -->
        <div class="manageusr-mainbox">
            <h3 class="sub-manageuser">รายชื่อผู้ใช้ทั้งหมด</h3>
            <button type="button" class="add-usr-btn">
                <img src="img/ไอคอนบวก.png" alt="ไอคอนเพิ่มผู้ใช้งาน">
                <span>เพิ่มผู้ใช้งานใหม่</span>
            </button>
            <!-- search-user -->
            <div class="search-usr-box">
                <input type="text" class="usr-searchbox" placeholder="ค้นหาชื่อผู้ใช้งานหรืออีเมล">
                <img src="img/search.png" alt="กล่องค้นหารายชื่อ" class="search-usr-png">
            </div>
            <div class="usr-topic">
                <h3 class="topic-name-usr">ผู้ใช้</h3>
                <h3 class="topic-email-usr">อีเมล</h3>
                <h3 class="topic-auth-usr">ระดับสิทธิ์</h3>
                <h3 class="topic-sts-usr">สถานะ</h3>
                <h3 class="topic-manage-usr">จัดการ</h3>
            </div>
            <div class="user-1">
                <h3 class="name1">Admin</h3>
                <h3 class="email1">admin@gmail.com</h3>
                <h3 class="auth1">แอดมิน</h3>
                <h3 class="sts1">ใช้งานอยุ่</h3>
                <div class="manage-btn3">
                    <img src="img\editicon.png" alt="รูปปุ่มแก้ไข" class="edit-icon3">
                    <img src="img\delete.png" alt="รูปปุ่มลบ" class="delete-icon3">
                </div>
            </div>
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
</div>
</body>
</html>