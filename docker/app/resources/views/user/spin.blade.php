<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <title>BUUGIFT</title>
</head>
<body class="main-spin-body">
    <!-- ชื่อผู้ใช้งาน -->
    <div class="btn-user-wrapper">
        <a href="{{ url('user/profile') }}" class="btn-user">
            <img src="img/user.png" alt="รูปผู้ใช้งาน" class="btn-user-img">
            <span> User </span>
        </a>
    </div>
    <div class="container-spin">
    <!-- โลโกมหาลัย -->
    <div class="img-Logo-spin">
        <img src="img/Logo.png" alt="รูปโลโกมหาลัย" class="Logo-img">
    </div>
    <!-- ปุ่มเมนู -->
    <div class="btn-Sidebar">

        <a href="{{ url('user/home') }}" class="btn-Home2">
            <img src="{{ asset('user/img/Home.png') }}" alt="รูปบ้าน" class="btn-Home-img2">
            <span>หน้าหลัก</span>
        </a>

        <a href="{{ url('user/spin') }}" class="btn-Random2">
            <img src="{{ asset('user/img/Randomสีดำ.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Random-img2">
            <span>สุ่มของรางวัล</span>
        </a>

        <a href="{{ url('user/contact') }}" class="btn-Contact2">
            <img src="{{ asset('user/img/Contact.png') }}" alt="รูปติดต่อเรา" class="btn-Contact-img2">
            <span>ติดต่อเรา</span>
        </a>
    </div>
    <!-- ปุ่มกดออกจากระบบ -->
    <div class="btn-logout-wrapper">
        <a href="{{ url('user/loginuser') }}" class="btn-logout2">
            <img src="img/รูปปุ่มกดออก.png" alt="รูปออกจากระบบ" class="btn-logout-img2">
            <span>ออกจากระบบ </span>
        </a>
    </div>
    </div>
</body>
</html>