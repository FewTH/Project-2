<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แดชบอร์ด</title>
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="icon" href="{{ asset('admin/img/Logo.png') }}">
</head>
<body>
<!-- ชื่อผู้ใช้งาน -->
<div class="btn-user-wrapper">
    <a href="{{ url('admin/profile') }}" class="btn-user">
        <img src="{{ asset('admin/img/user.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        <span>Admin</span>
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
    <a href="{{ url('admin/dashboard') }}" class="btn-Dashboard">
        <img src="{{ asset('admin/img/แดชบอร์ดสีดำ.png') }}" alt="รูปแดชบอร์ด" class="btn-Dashboard-img">
        <span>แดชบอร์ด</span>
    </a>
    <a href="{{ url('admin/managereward') }}" class="btn-Manage_Rewards">
        <img src="{{ asset('admin/img/รูปจัดการรางวัล.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Manage_Rewards-img">
        <span>จัดการรางวัล</span>
    </a>    
    <a href="{{ url('admin/manageuser') }}" class="btn-Manage_users">
        <img src="{{ asset('admin/img/รูปจัดการผู้ใช้.png') }}" alt="รูปติดต่อเรา" class="btn-Manage_users-img">
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
    <a href="{{ url('user/loginuser') }}" class="btn-logout">
        <img src="{{ asset('admin/img/รูปปุ่มกดออก.png') }}" alt="รูปออกจากระบบ" class="btn-logout-img">
        <span>ออกจากระบบ </span>
    </a>
    </div>
</div> 
<!--เอาไว้ควบคุมส่วนกลางของเว็บปิดล่างสุด-->
<div class="main-content">
<!--กรอบแดชบอร์ด-->
<div class="framedashboard">
    <!--ชื่อแดชบอร์ดภาพรวม-->  
    <div class="Overview_Dashboard">
        <h1>แดชบอร์ดภาพรวม</h1>
    </div>
<!--ปุ่มกดวัน สัปดาห์ เดือน -->
    <div class="ButtonDate">
        <div class="btn-day" id="button-day">
        <button type="button" class="btn-day-1">วัน</button>
        </div>
        <button type="button" class="btn-week" id="button-week">สัปดาห์</button>
        <button type="button" class="btn-month" id="button-month">เดือน</button>
    </div>
</div>
 <div id="dashboard_error" class="dashboard-error">
    <div class="dashboard-error-1">
        <img src="{{ asset('admin/img/รูปerror หน้าแดชบอร์ด.png') }}" alt="รูปerrorหน้าแดชบอร์ด" class="img-dashboard-error">
        <div class="cannotDownload-1">
        <p class="cannotDownload">โหลดข้อมูลไม่สำเร็จ</p>
        <p class="cannotDownloadDashboard">ไม่สามารถโหลดข้อมูลแดชบอร์ดได้ กรุณาลองใหม่อีกครั้ง</p>
        </div>
        <button class="but-cannotDownload" id="but_cannotDownload">
            <img src="{{ asset('admin/img/รูปปุ่มรีโหลดหน้าแดชบอร์ด.png') }}" alt="รูปปุ่มรีโหลดหน้าแดชบอร์ด" class="img-but-cannotDownload">
            <span class="but-cannotDownload-1">ลองใหม่<span>
        </button>
    </div>
</div>

<!--กรอบรวมของผู้ใช้ ทำแบบประเมิน สุ่ม รอรับของขวัญ-->
<div class="alluser_frames-1">
<!--กรอบผู้ใช้งานทั้งหมด-->
<div class="alluser_frames">
    <!--ผู้ใช้งานทั้งหมด-->
    <div class="All_users">
        <h4>ผู้ใช้ทั้งหมด</h4>
    </div>
    <!--ตัวเลขบอกจำนวนคน-->
    <div class="Userfigures">
        <h2 id="user_figures">150</h2>
    </div>
    <!--ตัวเลขบอกว่าเพิ่มกี่คนในวันนี้-->
    <div class="Addnumbers_users">
        <p id="add_numbers_users">↗ +38 คนวันนี้</p>
    </div>
</div>

<!--กรอบการทำแบบประเมิน-->
<div class="assessmentframe">
    <!--ทำแบบประเมินแล้ว-->
    <div class="frame">
        <h4>ทำแบบประเมินแล้ว</h4>
    </div>
    <!--ตัวเลขบอกจำนวนแบบประเมินที่ทำแล้ว-->
    <div class="Numberframe">
        <h2 id="number_frame">120</h2>
    </div>
    <!--ตัวเลขบอกว่าเพิ่มกี่คนในวันนี้-->
    <div class="Addnumbers">
        <p id="add_numbers">↗ +81 % ของผู้ใช้ทั้งหมด</p>
    </div>
</div>

<!--กรอบสุ่มทั้งหมด-->
<div class="randomall">
    <!--สุ่มทั้งหมด-->
    <div class="Random_all">
        <h4>สุ่มทั้งหมด</h4>
    </div>
    <!--ตัวเลขสุ่ม-->
    <div class="numberrandom">
        <h2 id="Number_random">100</h2>
    </div>
    <!--ตัวเลขบอกการสุ่มเมื่อวานก่อน-->
    <div class="numberotherday">
        <p id="number_other_day">↗ +18 % เมื่อวานก่อน</p>
    </div>
</div>

<!--กรอบรอรับของขวัญ-->
<div class="framewaitreceiveaward">
    <!--รอรับของขวัญ-->
    <div class="waitreceiveaward">
        <h4>รอรับของขวัญ</h4>
    </div>
    <!--ตัวเลขรับของขวัญ-->
    <div class="numberaward">
        <h2 id="Number_award">35</h2>
    </div>
    <!--ต้องติดตามของขวัญที่ยังไม่ได้รับ-->
    <div class="followaward" id="followaward_box">
        <p id="Follow_award">1 ต้องติดตาม</p>
    </div>
</div>
</div>
  <!--ชิ่อหัวข้อสุ่มรายวัน-->
<div class="chart-wrap">
    <!--ชิ่อหัวข้อสุ่มรายวัน-->
    <div class="sectionrandom">
        <h2 id="sectionrandom-1">การสุ่มรายวัน — 14 วันล่าสุด</h2>
    </div>
    <canvas class="graph-1" id="graph"></canvas>
</div>
<!--กรอบของขวัญยอดนิยมปิดแท็บตรงแบตสำรอง-->
<div class="framesmost_popular">
    <div class="most_popular-1">
        <div class="most_popular">
            <h2>ของขวัญยอดนิยม</h2>
        </div>
        <div class="randomall-100">
            <p>จากการสุ่มทั้งหมด <span id="randomall100">100</span> ครั้ง</p>
        </div>
    </div>
<!--กรอบของดินสอทั้งหมด-->
<div class="framepancil" id="rank1"> 
    <div class="redframe" id="rank1_redframe"></div>
    <div class="pencil">
        <img src="{{ asset('admin/img/ดินสอ.png') }}" alt="ดินสอ" class="img-pencil-1" id="rank1_img">
        <h3 id="rank1_name">ดินสอ</h3>
    </div>
    <div class="timeallpancil">
        <p><span id="rank1_times"> 45 </span> ครั้ง </p>
    </div>
    <div class="point-1">
        <p> · </p>
    </div>
    <div class="settingspencil">
        <p><span id="rank1_setting"> 50 % </span>ตั้งค่า</p>
    </div>
<div class="black-frame-pencil-1">
    <div class="black-frame-pencil">
        <div class="frame-pencil" id="rank1_bar"></div>
    </div>
    <div class="Percent-1">
        <p id="rank1_percent">24%</p>
        </div>
    </div>
</div>
    <!--เส้นสีดำปิดท้าย-->
    <hr class="blackline-1">
<!--กรอบของสมุดทั้งหมด-->
<div class="framenotebook" id="rank2">
    <div class="blueframe" id="rank2_blueframe"></div>
    <div class="notebook">
        <img src="{{ asset('admin/img/สมุด.png') }}" alt="รูปสมุด" class="img-notebook-1" id="rank2_img">
        <h3 id="rank2_name">สมุด</h3>
    </div>
    <div class="timeallnotebook">
        <p><span id="rank2_times"> 25 </span> ครั้ง </p>
    </div>
    <div class="point-2">
        <p> · </p>
    </div>
    <div class="settingsnotebook">
        <p><span id="rank2_setting"> 40 % </span>ตั้งค่า</p>
    </div>
<div class="black-frame-notebook-1">
    <div class="black-frame-notebook">
        <div class="frame-notebook" id="rank2_bar"></div>
    </div>
    <div class="Percent-2">
        <p id="rank2_percent">19%</p>
    </div>
    </div>
</div>
    <!--เส้นสีดำปิดท้าย-->
    <hr class="blackline-2">
<!--กรอบของหนังสือทั้งหมด-->
<div class="framebook" id="rank3">
    <div class="greenframe" id="rank3_greenframe"></div>
    <div class="book">
        <img src="{{ asset('admin/img/หนังสือ.png') }}" alt="รูปหนังสือ" class="img-book-1" id="rank3_img">
        <h3 id="rank3_name">หนังสือ</h3>
    </div>
    <div class="timeallbook">
        <p><span id="rank3_times"> 20 </span> ครั้ง </p>
    </div>
    <div class="point-3">
        <p> · </p>
    </div>
    <div class="settingsbook">
        <p><span id="rank3_setting"> 20 % </span>ตั้งค่า</p>
    </div>
<div class="black-frame-book-1">
    <div class="black-frame-book">
        <div class="frame-book" id="rank3_bar"></div>
    </div>
    <div class="Percent-3">
        <p id="rank3_percent">15%</p>
    </div>
    </div>
</div>
    <hr class="blackline-3">
<!--กรอบของแบตสำรองทั้งหมด-->
<div class="framepowerbank" id="rank4">
    <div class="orangeframe" id="rank4_orangeframe"></div>
    <div class="powerbank">
        <img src="{{ asset('admin/img/แบตสำรอง.png') }}" alt="รูปแบตสำรอง" class="img-powerbank-1" id="rank4_img">
        <h3 id="namepowerbank">แบตสำรอง</h3>
    </div>
    <div class="timeallpowerbank">
        <p><span id="rank4_times"> 10 </span> ครั้ง </p>
    </div>
    <div class="point-4">
        <p> · </p>
    </div>
    <div class="settingspowerbank">
        <p><span id="rank4_setting"> 10 % </span>ตั้งค่า</p>
    </div>
<div class="black-frame-powerbank-1">
    <div class="black-frame-powerbank">
        <div class="frame-powerbank" id="rank4_bar"></div>
    </div>
    <div class="Percent-4">
        <p id="rank4_percent">13%</p>
        </div>
    </div>
</div>
</div>

<!--กรอบของสถานะQRCodeปิดแท็กล่างสุด-->
<div class="framestatusQRCode">
    <div class="statusQRCode">
        <h2>สรุปสถานะ QR code</h2>
    </div>
<div class="framenumberreceived">
    <div class="numberreceived">
        <h1  class="number_received-1" id="number_received">65</h1>
        <p class="letterreceived">รับแล้ว</p>
    </div>
    <hr class="blackline-6">
    <div class="numberwaitreceive">
        <h1 class="numberwait_receive-1" id="numberwait_receive">35</h1>
        <p class="letterwaitreceive">รอรับ</p>
    </div>
    <hr class="blackline-7">
    <div class="numberall">
        <h1 class="number_all-1" id="number_all">100</h1>
        <p class="letterall">ทั้งหมด</p>
    </div>
</div>    
<div class="frameratereceiveaward">
    <div class="ratereceiveaward">
        <p>อัตราการรับของขวัญ</p>
    </div>
    <div class="black-frame-award">
        <div class="green-frame-award" id="green_frame_award1"></div>
    </div>
    <div class="percentreceived">
        <p><span id="percent_received" class="bold-text">65%</span> <span class="bold-text">รับแล้ว</span> <span class="point-5"> · </span> <span class="left"> เหลือ </span> <span class="numberlist" id="left_list1">35</span> <span class="list"> รายการ </span></p>
    </div>
</div>
    <hr class="blackline-5">
<div class="randomtoday-1">
    <div class="randomtoday">
        <p>การสุ่มวันนี้</p>
    </div>
    <div class="fromyesterday" id="from_yesterday">
        <h4 class="from_yesterday-1" id="from_yesterday1">↗ +12 % จากเมื่อวาน</h4>
    </div>
    </div>
</div>
</div>
</div>
    <script src="{{ asset('admin/js/JavaScriptAdmin.js') }}"></script>
</body>
</html>