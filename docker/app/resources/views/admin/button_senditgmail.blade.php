<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ส่งอีเมลให้ผู้ได้รางวัล</title>
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="icon" href="{{ asset('admin/img/Logo.png') }}">
</head>
<body>
    <body>
    <!-- ชื่อผู้ใช้งาน -->
<div class="btn-user-wrapper">
    <a href="{{ url('admin/profile') }}" class="btn-user">
        @if($user?->profile_image)
        <img src="{{ asset('storage/'.$user->profile_image) }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @else
        <img src="{{ asset('admin/img/รูปuser.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @endif
        <span>Admin</span>
    </a>
</div>
<!--กรอบของเมนูปิดแท็กตรงออกจากระบบ-->
<div class="container-assessment">
    <!-- โลโกมหาลัย -->
    <div class="img-Logo">
        <img src="{{ asset('admin/img/Logo.png') }}" alt="รูปโลโกมหาลัย" class="Logo-img">
</div>
<!-- ปุ่มเมนู -->
<div class="btn-Sidebar-assessment">
    <a href="{{ url('admin/dashboard') }}" class="btn-Dashboard-assessment">
        <img src="{{ asset('admin/img/แดชบอร์ด.png') }}" alt="รูปแดชบอร์ด" class="btn-Dashboard-img-assessment">
        <span>แดชบอร์ด</span>
    </a>
    <a href="{{ url('admin/managereward') }}" class="btn-Manage_Rewards-assess">
        <img src="{{ asset('admin/img/รูปจัดการรางวัล.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Manage_Rewards-img-assess">
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
    <a href="{{ url('admin/assessment') }}" class="btn-Assessment-assess">
        <img src="{{ asset('admin/img/รุปแบบประเมินกิจกรรมสีดำ.png') }}" alt="รูปติดต่อเรา" class="btn-Assessment-img-assess">
        <span>แบบประเมิน/กิจกรรม</span>
    </a>
</div>
<!-- ปุ่มกดออกจากระบบ -->
<div class="btn-logout-wrapper">
    <a href="{{ url('user/loginuser') }}" class="btn-logout">
        <img src="{{ asset('admin/img/รูปปุ่มกดออก.png') }}" alt="รูปออกจากระบบ" class="btn-logout-img">
        <span>ออกจากระบบ</span>
    </a>
    </div>
</div> 
<!--เอาไว้ควบคุมส่วนกลางของเว็บปิดล่างสุด-->
<div class="main-content-1">
<div class="framedashboard">
    <div class="Overview_Dashboard">
        <h1>ส่งอีเมลให้ผู้ได้รับรางวัล</h1>
    </div>
    <div class="sendallemails">
        <button type="button" class="btn-sendallemails1" id="btn_sendallemails1">
            <img src="{{ asset('admin/img/รูปของปุ่มส่งอีเมลทั้งหมด.png') }}" alt="รูปของปุ่มส่งอีเมลทั้งหมด">
            <p class="sendallemails1">ส่งอีเมลทั้งหมด</p>
        </button>
    </div>
</div>

    <div class="frameallsentdeliveryfailed">
        <div class="frameallbuttonsenditgmail">
            <p class="numberallbuttonsenditgmail" id="numberallbutton_senditgmail">30</p>
            <span class="messageallbuttonsenditgmail">ทั้งหมด</span>
        </div>
        <div class="framesentbuttonsenditgmail">
            <p class="numbersentbuttonsenditgmail" id="numbersentbutton_senditgmail">26</p>
            <span class="messagesentbuttonsenditgmail">ส่งแล้ว</span>
        </div>
        <div class="framedeliveryfailedbuttonsenditgmail">
            <p class="numberdeliveryfailedbuttonsenditgmail" id="numberdeliveryfailedbutton_senditgmail">4</p>
            <span class="messagedeliveryfailedbuttonsenditgmail">ส่งไม่สำเร็จ</span>
        </div>
    </div>

    <div class="framebiglistnamerecipientreward">
        <div class="framemessagelistnamerecipientreward">
            <p class="pointlistnamerecipientreward"></p>
            <p class="messagelistnamerecipientreward">ประวัตการส่ง QrCode</p>
        </div>
            <hr class="linemessagelistnamerecipientreward">
        <div class="framemessagelistnamerecipientreward-1">
            <div class="framecirclenumberlistnamerecipientreward">
                <p class="circlenumberlistnamerecipientreward">1</p>
            </div>
            <div class="framelistnamegmaildateassessment">
                <p class="messagelistnamegmaildateassessment">กิตติภพ รัตนวิจิตร</p>
                <p class="messagegmaildateassessment">kittiphop.rat@gmail.com</p>
                <span class="messagedateassessment">ประเมินเมื่อ 20:15:03 น. 20 พ.ค. 2569 </span>
            </div>
            <div class="framesenttogmail">
                <img src="{{ asset('admin/img/รูปติกถูกของกรอบส่งแล้วหน้าส่งอีเมลให้ผู้ได้รับรางวัล.png') }}" alt="รูปติกถูกของกรอบส่งแล้วหน้าส่งอีเมลให้ผู้ได้รับรางวัล">
                <p class="messagesenttogmail">ส่งแล้ว</p>
            </div>
        </div>   
        <hr class="linemessagelistnamerecipientreward">


        <div class="framemessagelistnamerecipientreward-1">
            <div class="framecirclenumberlistnamerecipientreward">
                <p class="circlenumberlistnamerecipientreward">3</p>
            </div>
            <div class="framelistnamegmaildateassessment">
                <p class="messagelistnamegmaildateassessment">จิรภัทร อัศวเดชากุล</p>
                <p class="messagegmaildateassessment">jiraphat.asawa@gmail.com</p>
                <span class="messagedateassessment">ประเมินเมื่อ 13:32:46 น. 21 พ.ค. 2569 </span>
            </div>
            <div class="frameerrorgmail">
                <img src="{{ asset('admin/img/รูปแจ้งเตือนส่ง email ล้มเหลว.png') }}" alt="รูปแจ้งเตือนส่ง email ล้มเหลว">
                <p class="messageerrorgmail">ล้มเหลว</p>
            </div>
            <button type="button" id="btn_Resend" class="btn-Resend">
                <img src="{{ asset('admin/img/รูปของปุ่มส่งใหม่.png') }}" alt="รูปของปุ่มส่งใหม่">
                <p class="messagebtn-Resend">ส่งใหม่</p>
            </button>
        </div>   
        <hr class="linemessagelistnamerecipientreward">
    </div>


    <div class="framelistthatfailed">
        <p class="messagelistthatfailed">รายการที่ล้มเหลว</p>
        <hr class="linemessagelistnamerecipientreward">
        <div class="framelistnamethatfailed">
            <p class="pointlistnamethatfailed"></p>
            <span class="messagelistnamethatfailed">จิรภัทร อัศวเดชากุล</span>
        </div>
        <button type="button" id="btn_Resend_1" class="btn-Resend1">
            <img src="{{ asset('admin/img/รูปของปุ่มส่งใหม่.png') }}" alt="รูปของปุ่มส่งใหม่">
            <p class="messagebtn-Resend1">ส่งใหม่</p>
        </button>
        <hr class="linemessagelistnamerecipientreward">


        <div class="framelistnamethatfailed">
            <p class="pointlistnamethatfailed"></p>
            <span class="messagelistnamethatfailed">กัญญาวีร์ อนันต์โชคชัย</span>
        </div>
        <button type="button" id="btn_Resend_1" class="btn-Resend1">
            <img src="{{ asset('admin/img/รูปของปุ่มส่งใหม่.png') }}" alt="รูปของปุ่มส่งใหม่">
            <p class="messagebtn-Resend1">ส่งใหม่</p>
        </button>
        <hr class="linemessagelistnamerecipientreward">



        <button type="button" class="btn-resendallthatfailed" id="btn_resendallthatfailed">
            <img src="{{ asset('admin/img/รูปของปุ่มส่งใหม่.png') }}" alt="รูปของปุ่มส่งใหม่">
            <p class="messagebtn-resendallthatfailed">ส่งใหม่ทั้งหมดที่ล้มเหลว</p>
        </button>
    </div>



    



    



</div>
<script src="{{ asset('admin/js/JavaScriptAdmin.js') }}"></script>
</body>
</html>