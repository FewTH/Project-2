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

{{-- อันหลักของหน้าสุ่ม --}}
    <div class="main-content2">
        <h1 class="Topic-main-spin">ศูนย์กลางสุ่มของขวัญ</h1>

        <div class="main-search-spin2">
            <input type="text" class="search-spin2" placeholder="ค้นหารายชื่อแบบประเมิน">
            <img src="img/แว่นขยาย.png" alt="แว่นขยาย" class="search-spin-icon">
        </div>
        <div class="filter-main">
            <button type="button" class="filter-btn active" id="all-btn">ทั้งหมด</button>
            <button type="button" class="filter-btn" id="spined-btn">สุ่มแล้ว</button>
            <button type="button" class="filter-btn" id="not-spin">ยังไม่สุ่ม</button>
        </div>
        <div class="main-spincontent">
            <h2 class="spin-subtiltle">รายการแบบประเมินที่ทำแล้ว</h2>
            <div class="test-content2">
                <div class="spincontent-test1" id="test1">
                    <h4 class="test101">แบบประเมินความเครียด1</h4>
                </div>
                <div class="spincontent-test2" id="test2" >
                    <h4 class="test101">แบบประเมินความเครียด2</h4>
                </div>
            </div>
        </div>
    </div>

<div class="container-home">
    <!-- โลโกมหาลัย -->
    <div class="img-Logo-home">
        <img src="img/Logo.png" alt="รูปโลโกมหาลัย" class="Logo-img">
    </div>
    <!-- ปุ่มเมนู -->
    <div class="btn-Sidebar">
        <a href="{{ url('user/home') }}" class="btn-Home-2">
            <img src="{{ asset('user/img/Home.png') }}" alt="รูปบ้าน" class="btn-Home-img-2">
            <span>หน้าหลัก</span>
        </a>

        <a href="{{ url('user/spin') }}" class="btn-Random2">
            <img src="{{ asset('user/img/Randomสีดำ.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Random-img2">
            <span>สุ่มของรางวัล</span>
        </a>

        <a href="{{ url('user/contact') }}" class="btn-Contact-2">
            <img src="{{ asset('user/img/Contact.png') }}" alt="รูปติดต่อเรา" class="btn-Contact-img-2">
            <span>ติดต่อเรา</span>
        </a>
    </div>
    <!-- ปุ่มกดออกจากระบบ -->
    <div class="btn-logout-wrapper">
        <a href="{{ url('user/loginuser') }}" class="btn-logout1">
            <img src="img/รูปปุ่มกดออก.png" alt="รูปออกจากระบบ" class="btn-logout-img1">
            <span>ออกจากระบบ </span>
        </a>
    </div>
    </div>
       <script src="{{ asset('user/js/JavaScript.js') }}"></script>
</body>
</html>