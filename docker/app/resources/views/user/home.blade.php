<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <title>BUUGIFT</title>
</head>
<body class="Bodyhome">
    <div class="btn-user-wrapper">
        <a href="{{ url('user/profile') }}" class="btn-user">
            <img src="img/user.png" alt="รูปผู้ใช้งาน" class="btn-user-img">
            <span> User </span>
        </a>
    </div>
    <!-- titlename -->
    <div class="justtext">
        <h2>หน้าหลัก</h2>
    </div>
    <!-- รูปของรางวัลยอดนิยม -->
    <div class="justbackground">
        <h2 class="subtitle">ของรางวัลยอดนิยม</h2>
    <div class="popular-reward">
        <img src="img\Vector2.png" alt="left-arrow1" width="50" height="50" class="left-arrow1">
        <div class="picre1">
            <img src="img\ดินสอ.jpg" alt="popular-reward1" width="250" class="pop-pic-reward1">
            <h3 class="textre1">ดินสอ</h3>
        </div>
        <div class="picre2">
            <img src="img\สมุด.jpg" alt="popular-reward2" width="250" class="pop-pic-reward2">
            <h3 class="textre2">สมุด</h3>
        </div>
        <div class="picre3">
            <img src="img\หนังสือ.jpg" alt="popular-reward2" width="250" class="pop-pic-reward3">
            <h3 class="textre3">หนังสือ</h3>
        </div>
        <img src="img\Vector.png" alt="right-arrow1" width="50" height="50" class="right-arrow1">
    </div>
    </div>
    <div class="content-row">
    <!-- แบบประเมินที่ทำแล้ว -->
        <div class="test-box1">
            <h3 class="text-test1">แบบประเมินที่ทำล่าสุด</h3>
            <div class="tested1">
            <div class="test-date1">
                <span class="day1">20</span>
                <span class="month1">พ.ค.</span>
            </div>    
                <h5 class="name-test1">แบบประเมินความพึงพอใจ BUU Book Fair 2569</h5>
            <div class="sts-pending">
                <span class="not-spn"></span>
                <span>ยังไม่สุ่ม</span>
            </div>
            </div>
            <div class="tested2">
                <div class="test-date2">
                <span class="day2">25</span>
                <span class="month2">พ.ค.</span>
            </div>
                <h5 class="name-test2">แบบประเมินบุคคลากรในห้องสมุดประจำปี 2569</h5>
                <div class="sts-spned">
                <span class="spned"></span>
                <span>สุ่มแล้ว</span>
            </div>
            </div>
        </div>
        <!-- กิจกรรมที่จะมาถึง -->
        <div class="mainevnt-soon">
            <h3 class="title-evnt-soon">กิจกรรมที่จะมาถึง</h3>
            <div class="sub-background-evnt-soon">
            <div class="evnt-box1">
                <img src="img\ไอคอนหัวใจ.png" alt="hearticon" width="30" class="hearth-icon">
                <span class="evntname-soon1">วาเลนไทน์</span>
                <span class="evntdate-soon1">เริ่มวันที่ x เดือน x ปี 2xxxx</span>
            </div>
            <div class="evnt-box2">
                <img src="img\ไอคอนพลุ.png" alt="fireworkicon" width="30" class="firework-icon">
                <span class="evntname-soon1">ปีใหม่</span>
                <span class="evntdate-soon2">เริ่มวันที่ x เดือน x ปี 2xxxx</span>
            </div>
            <div class="evnt-box3">
                <img src="img\ไอคอนหนังสือ.png" alt="bookicon" width="30" class="book-icon">
                <span class="evntname-soon1">ฮาโลวีน</span>
                <span class="evntdate-soon3">เริ่มวันที่ x เดือน x ปี 2xxxx</span>
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
        <a href="{{ url('user/home') }}" class="btn-Home1">
            <img src="{{ asset('user/img/homelogo1.png') }}" alt="รูปบ้าน" class="btn-homelogo-img1">
            <span>หน้าหลัก</span>
        </a>

        <a href="{{ url('user/spin') }}" class="btn-Random1">
            <img src="{{ asset('user/img/Random.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Random-img1">
            <span>สุ่มของรางวัล</span>
        </a>

        <a href="{{ url('user/contact') }}" class="btn-Contact1">
            <img src="{{ asset('user/img/Contact.png') }}" alt="รูปติดต่อเรา" class="btn-Contact-img1">
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
</body>
</html>