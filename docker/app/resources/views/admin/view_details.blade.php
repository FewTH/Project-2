<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดกิจกรรม</title>
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="icon" href="{{ asset('admin/img/Logo.png') }}">
</head>
<body>
        <!-- ชื่อผู้ใช้งาน -->
<div class="btn-user-wrapper">
    <a href="{{ url('admin/profile') }}" class="btn-user">
        @if($user->profile_image)
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
    <div class="My_Profile">
        <h1>รายละเอียดกิจกรรม</h1>
    </div>
    <div class="framelargest">

        <div class="frameback-correct-offRegister">
            <a href="{{ url('admin/assessment') }}" class="btn-retrospective">
                <img src="{{ asset('admin/img/รูปของปุ่มย้อนกลับ.png') }}" alt="รูปของปุ่มย้อนกลับ" class="img-retrospective">
                <p class="messageretrospective">ย้อนกลับ</p>
            </a>
            <a href="{{ url('admin/edit_activity') }}" class="edit-activity">
                <p class="message-edit-activity">แก้ไข</p>
            </a>
            <button type="button" class="offRegister" id="off_Register">
                <p class="message-offRegister">ปิด Register</p>
            </button>
        </div>


            <div class="frameactivitytime">
                <div class="frameactivitytime-1">
                    <div class="frmemsectionCreated">
                        <p class="messagesectionactivity">กิจกรรมลุ้นรางวัล OpenHouse 2569</p>
                        <span class="messagesectionactivity-1">สร้างเมื่อ 30 พ.ค. 2569 · โดย Admin</span>
                    </div>
                    <div class="framemessageoffregister-time">
                        <p class="messageoffregister">ปิด Register ใน</p>
                        <h2 class="numbertime" id="number_time">10:00</h2>
                    </div>
                </div>

                <button href="{{ url('admin/random_reward') }}" class="btn-randomreward" id="btn_randomreward" data-url="{{ url('admin/random_reward') }}" disabled>
                    <img src="{{ asset('admin/img/รูปถ้วยรางวัลของปุ่มเริ่มสุ่มรางวัล.png') }}" alt="รูปถ้วยรางวัลของปุ่มเริ่มสุ่มรางวัล" class="img-trophy">
                    <p class="messagestartrandom">เริ่มสุ่มรางวัล</p>
                    <img src="{{ asset('admin/img/รูปลูกศรของปุ่มเริ่มสุ่มรางวัล.png') }}" alt="รูปลูกศรของปุ่มเริ่มสุ่มรางวัล" class="img-arrowstartrandom">
                </button>

                <div class="frame4frame">
                    <div class="framenumbermessageregister">
                        <h2 class="numberregister">0</h2>
                        <p class="messageregister">ลงทะเบียนแล้ว</p>
                    </div>
                    <div class="framenumbermessagereceiveupto">
                        <h2 class="numberreceiveupto">0</h2>
                        <p class="messagereceiveupto">รับสูงสุด</p>
                    </div>
                    <div class="framemessagenomessagestatus">
                        <h2 class="messageno">เปิดอยู่</h2>
                        <p class="messagestatus">สถานะ</p>
                    </div>
                    <div class="framenumbertimemessagestimeoff">
                        <h2 class="numbertime-1">10:30 น.</h2>
                        <p class="messagestimeoff">เวลาปิด</p>
                    </div>
                </div>

                <div class="frameQRcoderegister-1">
                    <div class="frmaemessageQRcoderegistermessagescan">
                        <p class="messageQRcoderegister">QR code ลงทะเบียน</p>
                        <div class="frmaemessagescan">
                            <p class="messagescan">Scan ได้เลย</p>
                        </div>
                    </div>
                    <hr class="lineQRcode">
                    <img src="{{ asset('admin/img/รูปQrcodeจำลอง.png') }}" alt="รูปQrcodeจำลอง" class="img-QRcode">

                    <div class="framerecordshare">
                        <button type="button" class="btn-recordQrcode" id="btn_recordQrcode">
                            <p class="message-recordQrcode">บันทึก</p>
                        </button>
                    </div>
                    <button type="button" class="frameshare" id="frame_shareQrcode">
                        <img src="{{ asset('admin/img/รูปของปุ่มแชร์.png') }}" alt="รูปของปุ่มแชร์" class="img-shareQrcode">
                        <p class="messageframeshare">แชร์</p>
                    </button>
                </div>


            <div class="frameQRcoderegister">
                <p class="messageactivity">ข้อมูลกิจกรรม</p>
                <hr class="lineactivity">
                <div class="framedateorganize">
                    <p class="messagedateorganize">วันที่จัดกิจกรรม</p>
                    <span class="dateorganize">30 พ.ค 2569</span>
                </div>
                <div class="frametimeoffRegister">
                    <p class="messageRegister">เวลาปิด Register</p>
                    <span class="numbertimeoffRegister">10:30 น.</span>
                </div>
                <div class="framequantitymaximum">
                    <p class="messagequantitymaximum">จำนวนสูงสุด</p>
                    <span class="numberquantitymaximum">5</span>
                </div>
                <div class="framelistrewardall">
                    <p class="messagelistrewardall">รายการรางวัลทั้งหมด</p>
                    <span class="message-listrewardall">ดินสอ สมุดโน้ต ยางลบ</span>
                </div>
            </div>

            <div class="framelistnamesregister">
                <div class="pointlistnamesregister"></div>
                <div class="framelistnamesregister-1">
                    <p class="messagelistnamesregiste">รายชื่อผู้ลงทะเบียน</p>
                    <div class="framequantitypeople">
                        <p class="numberquantitypeople">1 คน</p>
                    </div>
                </div>
                <hr class="linequantitypeople">

                <div class="frameinformationparticipants">
                    <div class="framenumberpeople">
                        <p class="numberpeople">1</p>
                    </div>
                    <div class="frmaename-emailparticipants">
                        <p class="nameparticipants">นายสปาเก็ตตี้ คาโบนาร่า</p>
                        <span class="emailparticipants">spagetthi@gmail.com</span>
                    </div>
                    <div class="frametimeparticipants">
                        <p class="timeparticipants">10:24 น.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="{{ asset('admin/js/JavaScriptAdmin.js') }}"></script>
</body>
</html>