<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบประเมิน/กิจกรรม</title>
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
<div class="main-content">

    <div class="sectionlist">
        <h1>รายการกิจกรรม</h1>
    </div>

    <div class="btn-activity-rate">
        <button class="btn-activity active" id="btn_activity">
            <h3 class="btn-activity-1">รายการกิจกรรม</h3>
            <p class="number-activity active" id="number_activity">4</p>
        </button>
        <button class="btn-rate" id="btn_rate">
            <h3 class="btn-rate-1">แบบประเมิน</h3>
            <p class="number-rate" id="number_rate">3</p>
        </button>
    </div>

    <div class="bulb-black">
        <div class="bulb-yellow" id="bulb_yellow"></div>
    </div>

<!--กรอบของรายการกิจกรรม-->
<div class="frame-grey active" id="frame_grey">
    <div class="activity-Closed-Open">
        <div class="all-activities">
            <h1 class="activities-number-assessment" id="activities_number_assessment">3</h1>
            <p class="activities-assessment">กิจกรรมทั้งหมด</p>
        </div>
        <div class="Closed-assessment">
            <h1 class="Closed-assessment-1" id="Closed_assessment_1">2</h1>
            <p class="Closed-assessment-2">ปิดแล้ว</p>
        </div>
        <div class="Open-assessment">
            <h1 class="open-assessment-1" id="open_assessment_1">1</h1>
            <p class="open-assessment-2">เปิดอยู่</p>
        </div>
        <div class="btn-build-activityurgent">
            <a href="{{ url('admin/create_activity') }}" class="btn-build-activityurgent-1"><span class="btn-plus">+</span> สร้างกิจกรรมด่วน</a>
        </div>
        
    </div>

        <div class="frame-search-activity">
            <input type=text class="search-activity" id="frame_search_activity" placeholder="ค้นหารายชื่อกิจกรรม">
            <img src="{{ asset('admin/img/รูปปุ่มค้นหน้าหน้าแบบประเมินกิจกรรม.png') }}" alt="รูปปุ่มค้นหน้าหน้าแบบประเมินกิจกรรม" class="img-btn-activity" id="img_btn_activity">
        </div>

<template id="cardTemplate"> 
    <div class="frame-activity-assessment">
        <div class="framecontentactivity">
            <h4 class="headingactivity">กิจกรรมเช็คอินโต้รุ่ง ช่วงติวไฟนอล 2568</h4>
            <div class="frameclosed">
                <p class="pointclosed"></p>
                <span class="closed" >ปิด</span>
            </div>
        </div>
        <p class="messagecreationtime">สร้างเมื่อ 20 ต.ค. 2568 · ปิด Register 23 ต.ค. 2568</p>
        <hr class="lineactivity-1">
        <div class="maximumnumber_outtime">
            <p class="maximumnumber">ผู้เข้าร่วมสูงสุด 10 คน</p>
            <p class="outtime">หมดเวลา 11.30 น.</p>
        </div>
        <div class="framerank-1-2-3">
            <div class="framerank-1-assessment">
                <p class="rank-1-assessment">ดินสอ</p>
            </div>
            <div class="framerank-1-assessment">
                <p class="rank-1-assessment">สมุดโน้ต</p>
            </div>
            <div class="framerank-1-assessment">
                <p class="rank-1-assessment">แบตสำรอง</p>
            </div>               
        </div>
        <hr class="lineactivity-2">
        <div class="register">
            <p class="register-1">8 คนลงทะเบียนแล้ว</p>
            <div class="view-details">
                <a href="{{ url('admin/view_details/') }}" class="view-details-1">ดูรายละเอียด</a>
            </div>
        </div>
    </div>
</template>

<div id="cardContainer"></div>
</div>

<!--กรอบของแบบประเมิน-->
<div class="frame-evaluation" id="frame_evaluation">
    <div class="frame-search-activity-1">
        <div class="search-activity-1">
        <input type=text class="search-activity-2" id="frame_search_activity_2" placeholder="ค้นหารายชื่อแบบประเมิน">
        <img src="{{ asset('admin/img/รูปปุ่มค้นหน้าหน้าแบบประเมินกิจกรรม.png') }}" alt="รูปปุ่มค้นหน้าหน้าแบบประเมินกิจกรรม" class="img-btn-activity-2" id="img_btn_activity_1">
        </div>
        <div class="framealloffon-assessment">
            <button class="frameall-assessment" id="frameall_assessment">
                <p class="all-assessment" id="all_assessment">ทั้งหมด</p>
                <span class="allnumber-assessment" id="allnumber_assessment">(0)</span>
            </button>
            <button class="frameoff-assessment" id="frameoff_assessment">
                <p class="off-assessment" id="off_assessment">ปิดแล้ว</p>
                <span class="offnumber-assessment" id="offnumber_assessment">(0)</span>
            </button>
            <button class="farmeon-assessment" id="farmeon_assessment">
                <p class="on-assessment" id="on_assessment">เปิดอยู่</p>
                <span class="onnumber-assessment" id="onnumber_assessment">(0)</span>
            </button>
        </div>
        <div class="frame-assign-assessment">
            <button class="btn-assign-assessment"  id="btn_assign_assessment">
                <img src="{{ asset('admin/img/รูปของปุ่มมอบหมายแบบประเมิน.png') }}" alt="รูปของปุ่มมอบหมายแบบประเมิน" class="img-assign-assessment">
                <p class="message-assign-assessment">มอบหมายแบบประเมิน</p>
            </button>
        </div>
    </div>
    
    <!--กรอบของแบบประเมินที่ดึงมาจาก api-->
    <div class="frame-grey-1">


        <div class="sectionassessment">
            <h3>แบบประเมิน - BUU Book Fair 2569</h3>
            <div class="frameinformation-assessment">
                <div class="framesection-status">
                    <h2 class="section-assessment">แบบประเมิน - BUU Book Fair 2569</h2>
                    <div class="frame-status">
                        <p class="point-status"></p>
                        <p class="message-status">เปิดอยู่</p>
                    </div>
                    <p class="message-assessment">ผู้เข้าร่วมประเมิน 8 คน • รางวัล ดินสอ สมุดโน้ต กระเป๋าดินสอ </p>
                    <p class="message-created-by">สร้างโดย: Admin • ปิดรับคำตอบ: 20 พ.ค. 2569</p>
                    <div>
                    

                        <button class="assessment-open-1">
                            <p class="message-assessment-open">แบบประเมินยังเปิดอยู่</p>
                        </button>


                        <button class="enter-random">
                            <img src="{{ asset('admin/img/รูปของปุ่มเข้าสู้การสุ่มรางวัล.png') }}" alt="รูปของปุ่มเข้าสู้การสุ่มรางวัล" class="img-enter-random">
                            <p class="message-enter-random">เข้าสู้การสุ่มรางวัล</p>
                        </button>



                        <button class="view-history">
                            <p class="message-view-history">ดูประวัติการสุ่ม</p>
                        </button>



                </div>
            </div>

        </div>

        
    </div>
</div>

</div>



    <script src="{{ asset('admin/js/JavaScriptAdmin.js') }}"></script>
</body>
</html>