<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <title>เพิ่มรางวัล</title>
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
    <h1 class="Topic-addreward">เพิ่มของรางวัล</h1>
    <!-- ช่องกรอกข้อมูลของรางวัล -->
    <div class="input-reward-name">
        <label class="name-reward-sub" for="name-reward">ชื่อของรางวัล</label> <br>
        <input type="text" class="name-reward1" id="name-reward01" placeholder="กรอกรายชื่อของรางวัลของคุณ">
    </div>

    <div class="input-reward-category">
        <label class="category-reward-sub" for="category-reward01">หมวดหมู่</label> <br>
        <input type="text" class="category-reward1" id="category-reward01" list="category_list" placeholder="กรุณากรอกหรือเลือกหมวดหมู่">
    <datalist  class="category_list_01" id="category_list">
            <option value="เครื่องเขียน">
            <option value="อุปกรณ์การเรียน">
            <option value="ของใช้ทั่วไป">
    </datalist>     
    </div>

    <div class="input-reward-num">
        <label class="num-reward-sub" for="num_reward">จำนวน</label> <br>
        <input type="number" class="num-reward1" id="num-reward01" placeholder="โปรดระบุจำนวนของรางวัลของคุณ">
    </div>
    <div class="input-reward-rate">
        <label class="rate-reward-sub" for="rate-reward_sub">อัตราการออก(%)</label> <br>
        <input type="number" class="rate-reward1" id="rate-reward01" placeholder="ระบุเปอร์เซ็นของรางวัล">
    </div>   
    <div class="ad-botton">
        <a href="{{ url('admin/managereward') }}" class="addreward-btn1">
            <span>บันทึกข้อมูล</span>
        </a>
        <a href="{{ url('admin/managereward') }}" class="cancle-btn">
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