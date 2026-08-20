<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="icon" href="{{ asset('admin/img/Logo.png') }}">
    <title>จัดการรางวัล</title>
</head>
<body class="mgreward-body">
    <!-- ชื่อผู้ใช้งาน -->
    <div class="btn-user-wrapper">
        <a href="{{ url('admin/profile') }}" class="btn-user">
            <img src="img/user.png" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
            <span>Admin</span>
        </a>
    </div>
    <!-- ส่วนเนื้อหาหลัก (Detail) -->
        <div class="detail">
            <!-- หัวข้อหลัก -->
            <h1 class="maintitle-name">จัดการรางวัล</h1>
            
            <div class="searchbox">
                <div class="input-wrapper">
                    <input type="text" class="search-box" placeholder="ค้นหารายการรางวัล">
                    <img src="img/search.png" alt="search-icon" class="search-icon">
                </div>
            </div>
            <!-- ปุ่มเพิ่มของรางวัล -->
                <div class="addbutton">
                    <button type="button" class="addreward">
                    <a href="{{ url('admin/addreward') }}" class="addreward-btn">
                    <img src="img/ไอคอนบวก.png" alt="plusicon" class="plus-icon">
                    <span class="addrwdtext">เพิ่มของรางวัล</span>
                    </a>
                        {{-- <img src="img/ไอคอนบวก.png" alt="plusicon" class="plus-icon">
                        <span class="addrwdtext">เพิ่มของรางวัล</span> --}}
                    </button>
                </div>
        <div class="reward-list">
            <div class="topic-rewardlist">
            <h4 class="topic1">ชื่อของรางวัล</h4>
            <h4 class="topic2">หมวดหมู่</h4>
            <h4 class="topic3">อัตราการออก</h4>
            <h4 class="topic4">จำนวน</h4>
            <h4 class="topic5">จัดการ</h4>
        </div>
    <div class="reward-list-name">
    <!-- รายการของรางวัลชิ้นที่ 1 -->
    <div class="box-reward1">
    <span class="name-reward1">ดินสอ</span>
        <span class="catigory-reward1">เครื่องเขียน</span>
        <span class="rate-reward1">50%</span>
        <span class="number-reward1">100</span>
        <div class="edit-delete-button1">
        <img src="img/editicon.png" alt="ไอคอนแก้ไข" class="edit-icon1">
        <img src="img/delete.png" alt="ไอคอนลบ" class="delete-icon1">
        </div>
    </div>
    <!-- รายการของรางวัลชิ้นที่ 2 -->
    <div class="box-reward2">
        <span class="name-reward2">สมุดโน้ต</span>
        <span class="catigory-reward2">ของใช้ทั่วไป</span>
        <span class="rate-reward2">40%</span>
        <span class="number-reward2">80</span>
        <div class="edit-delete-button2">
        <img src="img/editicon.png" alt="ไอคอนแก้ไข" class="edit-icon2">
        <img src="img/delete.png" alt="ไอคอนลบ" class="delete-icon2">
        </div>
    </div>
    <!-- รายการของรางวัลชิ้นที่ 3 -->
    <div class="box-reward3">
        <span class="name-reward3">กระเป๋าดินสอ</span>
        <span class="catigory-reward3">ของใช้ทั่วไป</span>
        <span class="rate-reward3">30%</span>
        <span class="number-reward3">50</span>
        <div class="edit-delete-button3">
        <img src="img/editicon.png" alt="ไอคอนแก้ไข" class="edit-icon3">
        <img src="img/delete.png" alt="ไอคอนลบ" class="delete-icon3">
    </div>
    </div>
                    <!-- รายการของรางวัลชิ้นที่ 4 -->
    <div class="box-reward4">
        <span class="name-reward4">หนังสือการ์ตูน</span>
        <span class="catigory-reward4">หนังสือ</span>
        <span class="rate-reward4">20%</span>
        <span class="number-reward4">25</span>
        <div class="edit-delete-button4">
        <img src="img/editicon.png" alt="ไอคอนแก้ไข" class="edit-icon4">
        <img src="img/delete.png" alt="ไอคอนลบ" class="delete-icon4">
        </div>
    </div>
                    <!-- รายการของรางวัลชิ้นที่ 5 -->
    <div class="box-reward5">
        <span class="name-reward5">แบตสำรอง</span>
        <span class="catigory-reward5">อิเล็กทรอนิกส์</span>
        <span class="rate-reward5">10%</span>
        <span class="number-reward5">10</span>
        <div class="edit-delete-button5">
        <img src="img/editicon.png" alt="ไอคอนแก้ไข" class="edit-icon5">
        <img src="img/delete.png" alt="ไอคอนลบ" class="delete-icon5">
    </div>
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
        <a href="{{ url('admin/dashboard') }}" class="btn-Dashboard2">
            <img src="{{ asset('admin/img/แดชบอร์ด.png') }}" alt="รูปแดชบอร์ดสีดำ" class="btn-Dashboard-img2">
            <span>แดชบอร์ด</span>
        </a>
        <a href="{{ url('admin/managereward') }}" class="btn-Manage_Rewards2">
            <img src="{{ asset('admin/img/รูปจัดการรางวัลสีดำ.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Manage_Rewards-img2">
            <span>จัดการรางวัล</span>
        </a>
        <a href="{{ url('admin/manageuser') }}" class="btn-Manage_users2">
            <img src="{{ asset('admin/img/รูปจัดการผู้ใช้.png') }}" alt="รูปติดต่อเรา" class="btn-Manage_users-img2">
            <span>จัดการผู้ใช้</span>
        </a>
        <a href="{{ url('admin/managespin') }}" class="btn-Managewheel2">
            <img src="{{ asset('admin/img/รูปจัดการวงล้อสุ่ม.png') }}" alt="รูปติดต่อเรา" class="btn-Managewheel-img2">
            <span>จัดการวงล้อสุ่ม</span>
        </a>
        <a href="{{ url('admin/assessment') }}" class="btn-Assessment2">
            <img src="{{ asset('admin/img/รูปแบบประเมินกิจกรรม.png') }}" alt="รูปติดต่อเรา" class="btn-Assessment-img2">
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