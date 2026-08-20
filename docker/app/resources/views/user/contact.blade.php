<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ติดต่อเรา</title>
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="icon" href="{{ asset('user/img/Logo.png') }}">
</head>
<body>
    <!-- ชื่อผู้ใช้งาน -->
    <div class="btn-user-wrapper">
        <a href="{{ url('user/profile') }}" class="btn-user">
            <img src="{{ asset('user/img/user.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img">
            <span> User </span>
        </a>
    </div>
<!--กรอบของเมนูปิดแท็กตรงออกจากระบบ-->
<div class="container">
    <!-- โลโกมหาลัย -->
   <div class="img-Logo">
        <img src="{{ asset('admin/img/Logo.png') }}" alt="รูปโลโกมหาลัย" class="Logo-img">
   </div>
   <!-- ปุ่มเมนู -->
   <div class="btn-Sidebar">
        <a href="{{ url('user/home') }}" class="btn-Home">
            <img src="{{ asset('user/img/Home.png') }}" alt="รูปบ้าน" class="btn-Home-img">
            <span>หน้าหลัก</span>
        </a>
        <a href="{{ url('user/spin') }}" class="btn-Random">
            <img src="{{ asset('user/img/Random.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Random-img">
            <span>สุ่มของรางวัล</span>
        </a>
        <a href="{{ url('user/contact') }}" class="btn-Contact">
            <img src="{{ asset('user/img/Contactสีดำ.png') }}" alt="รูปติดต่อเรา" class="btn-Contact-img">
            <span>ติดต่อเรา</span>
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

<!--เอาไว้ควบคุมส่วนกลางของเว็บปิดล่างสุด-->
<div class="main-content">
    <!--หัวข้อสำนักหอสมุดมหาวิทยาลัยบูรพา (BUULIB)-->
    <div class="office_buu">
    <h1>สำนักหอสมุดมหาวิทยาลัยบูรพา (BUULIB)</h1>
    </div>
    <!-- แกลลอรี่รูปภาพ -->
    <div class="img-Photo_Gallery">
        <div class="btn-left-arrow-1">
            <button id="arrow-left" class="btn-left-arrow">
                <img src="{{ asset('user/img/ลูกศรทางซ้าย.png') }}" alt="ลูกศรทางซ้าย" class="arrow-left-img" >
            </button>
        </div>
        <img src="{{ asset('user/img/รูปสำนักหอสมุด1.png') }}" alt="รูปสำนักหอสมุด1" class="Gallery-img left" id="Gallery_img_left">
        <img src="{{ asset('user/img/รูปสำนักหอสมุด2.png') }}" alt="รูปสำนักหอสมุด2" class="Gallery-img center" id="Gallery_img_center">
        <img src="{{ asset('user/img/รูปสำนักหอสมุด3.png') }}" alt="รูปสำนักหอสมุด3" class="Gallery-img right" id="Gallery_img_right">
        <div class="btn-right-arrow-1">
            <button id="arrow-right" class="btn-right-arrow">
                <img src="{{ asset('user/img/ลูกศรทางขวา.png') }}" alt="ลูกศรทางขวา" class="arrow-right-img">
            </button>
        </div>
    </div>

<!--กรอบคุมเวลาทำการ ช่องทางติดต่อ สำนักงาน-->
<div class="contactbuu"> 
    <div class="contact-group">
    <!--หัวข้อเวลาทำการ-->
    <div class="section-Business_Hours">
         <h1>เวลาทำการ</h1>
    </div>
    <!-- ข้อมูลบอกเวลาทำการ -->
    <div class="contact-Business_Hours">
        <p>วันอาทิตย์ 09:00 - 19:00 น.</p>
        <p>วันจันทร์ 8:00 - 20:30 น.</p>
        <p>วันอังคาร 8:00 - 20:30 น.</p>
        <p>วันพุธ 8:00 - 20:30 น.</p>
        <p>วันพฤหัสบดี 8:00 - 20:30 น.</p>
        <p>วันศุกร์ 8:00 - 20:30 น.</p>
        <p>วันเสาร์ 09:00 - 19:00 น.</p>
    </div>
</div>
<div class="contact-group">
    <!--หัวข้อช่องทางติดต่อเรา-->
    <div class="section-contact-Channels">
        <h1>ช่องทางติดต่อเรา</h1>
    </div>
    <!-- ช่องทางติดต่อเรา -->
    <div class="contact-Channels">
        <p><img src="{{ asset('user/img/logos_telephone(1).png') }}" alt="รูปโทรศัพท์" class="contact-img"> 038 102 475</p>
        <p><img src="{{ asset('user/img/logos_tiktok-icon.png') }}" alt="รูปTiktok" class="contact-img"> BUU Library</p>
        <p><img src="{{ asset('user/img/logos_facebook.png') }}" alt="รูปfacebook" class="contact-img"> สำนักหอสมุดมหาวิทยาลัยบูรพา</p>
    </div>
</div>
<div class="contact-group">
    <!--หัวข้อสำนักงานใหญ่-->
    <div class="section-contact-Office"> 
        <h1>สำนักงานใหญ่</h1>
    </div>
    <!-- สำนักงาน -->
    <div class="contact-Office">
        <p>มหาวิทยาลัยบูรพา ตำบลแสนสุข</p>
        <p>อำเภอเมือง จังหวัดชลบุรี 20131</p>
            </div>
        </div>
    </div> 
</div>   
    <script src="{{ asset('user/js/JavaScript.js') }}"></script>
</body>
</html>