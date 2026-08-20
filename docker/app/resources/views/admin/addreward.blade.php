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
    <div class="input-reward-box">
        <h3 class="name-reward-sub">ชื่อของรางวัล</h3>
        <input type="text" class="name-reward">
        <h3 class="category-reward-sub">หมวดหมู่</h3>
        <input type="text" class="category-reward">
        <h3 class="rate-reward-sub">อัตราการออก(%)</h3>
        <input type="text" class="rate-reward">
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
</body>
</html>