<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ส่งอีเมลให้ผู้ได้รางวัล</title>
    <link rel="stylesheet" href="{{ asset('manager/css/style.css') }}">
    <link rel="icon" href="{{ asset('admin/img/Logo.png') }}">
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
        <a href="{{ url('manager/รอเปลี่ยน') }}" class="btn-Home-1">
            <img src="{{ asset('manager/img/รูปปุ่มเมนูจัดการรางวัล.png') }}" alt="รูปปุ่มเมนูจัดการรางวัล" class="btn-Home-img-1">
            <span>จัดการรางวัล</span>
        </a>
        <a href="{{ url('manager/managespin') }}" class="btn-Random-1">
            <img src="{{ asset('manager/img/รูปปุ่มเมนูจัดการวงล้อสุ่ม.png') }}" alt="รูปปุ่มเมนูจัดการวงล้อสุ่ม" class="btn-Random-img-1">
            <span>จัดการวงล้อสุ่ม</span>
        </a>
        <a href="{{ url('manager/assessment') }}" class="btn-Assessment-assess">
            <img src="{{ asset('admin/img/รุปแบบประเมินกิจกรรมสีดำ.png') }}" alt="รูปติดต่อเรา" class="btn-Assessment-img-assess">
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
<!--เอาไว้ควบคุมส่วนกลางของเว็บปิดล่างสุด-->
<div class="main-content-1">
<div class="framedashboard">
    <div class="Overview_Dashboard">
        <h1>ส่งอีเมลให้ผู้ได้รับรางวัล</h1>
    </div>
    <div class="sendallemails">
        <button type="button" class="btn-sendallemails1" id="btn_sendallemails1">
            <img src="{{ asset('admin/img/รูปของปุ่มส่งอีเมลทั้งหมด.png') }}" alt="รูปของปุ่มส่งอีเมลทั้งหมด" class="btn-imgsendallemails1">
            <p class="sendallemails1">ส่งอีเมลทั้งหมด</p>
        </button>
    </div>
</div>

    <div class="frameallsentdeliveryfailed">
        <div class="frameallbuttonsenditgmail">
            <p class="numberallbuttonsenditgmail" id="numberallbutton_senditgmail">0</p>
            <span class="messageallbuttonsenditgmail">ทั้งหมด</span>
        </div>
        <div class="frameallbuttonsenditgmail">
            <p class="numbersentbuttonsenditgmail" id="numbersentbutton_senditgmail">0</p>
            <span class="messageallbuttonsenditgmail">ส่งแล้ว</span>
        </div>
        <div class="frameallbuttonsenditgmail">
            <p class="numberdeliveryfailedbuttonsenditgmail" id="numberdeliveryfailedbutton_senditgmail">0</p>
            <span class="messageallbuttonsenditgmail">ส่งไม่สำเร็จ</span>
        </div>
    </div>

    <div class="framebiglistnamerecipientreward-1">
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
                        <span class="messagelistnamegmaildateassessment">กิตติภพ รัตนวิจิตร</span>
                        <span class="messagegmaildateassessment">kittiphop.rat@gmail.com</span>
                        <span class="messagedateassessment">ประเมินเมื่อ 20:15:03 น. 20 พ.ค. 2569 </span>
                    </div>
                    <div class="framesenttogmail">
                        <img src="{{ asset('admin/img/รูปติกถูกของกรอบส่งแล้วหน้าส่งอีเมลให้ผู้ได้รับรางวัล.png') }}" alt="รูปติกถูกของกรอบส่งแล้วหน้าส่งอีเมลให้ผู้ได้รับรางวัล">
                        <p class="messagesenttogmail">ส่งแล้ว</p>
                    </div>
                </div>   
                <hr class="linemessagelistnamerecipientreward-1">
            

            <div class="framemessagelistnamerecipientreward-1">
                <div class="framecirclenumberlistnamerecipientreward">
                    <p class="circlenumberlistnamerecipientreward">2</p>
                </div>
            <div class="framelistnamegmaildateassessment">
                    <span class="messagelistnamegmaildateassessment">จิรภัทร อัศวเดชากุล</span>
                    <span class="messagegmaildateassessment">jiraphat.asawa@gmail.com</span>
                    <span class="messagedateassessment">ประเมินเมื่อ 13:32:46 น. 21 พ.ค. 2569 </span>
                </div>
                <div class="frameerrorgmail">
                    <img src="{{ asset('admin/img/รูปแจ้งเตือนส่ง email ล้มเหลว.png') }}" alt="รูปแจ้งเตือนส่ง email ล้มเหลว">
                    <p class="messageerrorgmail">ล้มเหลว</p>
                </div>
                <button type="button" id="btn_Resend" class="btn-Resend">
                <img src="{{ asset('admin/img/รูปของปุ่มส่งใหม่.png') }}" alt="รูปของปุ่มส่งใหม่" class="imgbtn-Resend">
                    <p class="messagebtn-Resend">ส่งใหม่</p>
                </button>
            </div>   
            <hr class="linemessagelistnamerecipientreward-1">
        </div>
    

        <div class="framelistthatfailed">
            <p class="messagelistnamerecipientreward">รายการที่ล้มเหลว</p>
            <hr class="linemessagelistnamerecipientreward">
            <div class="framelistnamethatfailed">
                <p class="pointlistnamethatfailed"></p>
                <span class="messagelistnamethatfailed">จิรภัทร อัศวเดชากุล</span>
                <button type="button" id="btn_Resend_1" class="btn-Resend1">
                    <img src="{{ asset('admin/img/รูปของปุ่มส่งใหม่.png') }}" alt="รูปของปุ่มส่งใหม่" class="imgbtn-Resend1">
                    <p class="messagebtn-Resend1">ส่งใหม่</p>
                </button>
            </div>
            <hr class="linemessagelistnamerecipientreward-2">


            <div class="framelistnamethatfailed">
                <p class="pointlistnamethatfailed"></p>
                <span class="messagelistnamethatfailed">กัญญาวีร์ อนันต์โชคชัย</span>
                <button type="button" id="btn_Resend_1" class="btn-Resend1">
                    <img src="{{ asset('admin/img/รูปของปุ่มส่งใหม่.png') }}" alt="รูปของปุ่มส่งใหม่">
                    <p class="messagebtn-Resend1">ส่งใหม่</p>
                </button>
            </div>
            <hr class="linemessagelistnamerecipientreward-2">

            <button type="button" class="btn-resendallthatfailed" id="btn_resendallthatfailed">
                <img src="{{ asset('admin/img/รูปของปุ่มส่งใหม่.png') }}" alt="รูปของปุ่มส่งใหม่" class="imgbtn-Resend1">
                <p class="messagebtn-resendallthatfailed">ส่งใหม่ทั้งหมดที่ล้มเหลว</p>
            </button>
        </div>
    </div>


    



    



</div>
<script src="{{ asset('admin/js/JavaScriptAdmin.js') }}"></script>
</body>
</html>