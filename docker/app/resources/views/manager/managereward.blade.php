<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('manager/css/managereward.css') }}">
    <link rel="icon" href="{{ asset('user/img/Logo.png') }}">
    <title>จัดการรางวัล</title>
</head>
<body>
    <!-- ชื่อผู้ใช้งาน -->
    <div class="btn-user-wrapper">
    <a href="{{ url('manager/profile') }}" class="btn-user">
        @if($user?->profile_image)
        <img src="{{ asset('storage/'.$user->profile_image) }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @else
        <img src="{{ asset('manager/img/รูปuser.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @endif
        <span>Manager</span>
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
            <a href="{{ url('manager/managereward') }}" class="btn-Home-1">
                <img src="{{ asset('manager/img/รูปปุ่มเมนูจัดการรางวัล.png') }}" alt="รูปปุ่มเมนูจัดการรางวัล" class="btn-Home-img-1">
                <span>จัดการรางวัล</span>
            </a>
        <a href="{{ url('manager/managespin') }}" class="btn-Random-1">
            <img src="{{ asset('manager/img/รูปปุ่มเมนูจัดการวงล้อสุ่ม.png') }}" alt="รูปปุ่มเมนูจัดการวงล้อสุ่ม" class="btn-Random-img-1">
            <span>จัดการวงล้อสุ่ม</span>
        </a>
        <a href="{{ url('manager/assessment') }}" class="btn-Contact-1">
            <img src="{{ asset('manager/img/รูปปุ่มเมนูรายการกิจกรรม.png') }}" alt="รูปปุ่มเมนูรายการกิจกรรม" class="btn-Contact-img-1">
            <span>แบบประเมิน/กิจกรรม</span>
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


</body>
</html>