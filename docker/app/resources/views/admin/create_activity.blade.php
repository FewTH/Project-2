<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สร้างกิจกรรม</title>
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
<div class="main-content">
    <div class="createactivity">
        <h1>สร้างกิจกรรม</h1>
    </div>

    <div class="grayframeactivity">

            <a href="{{ url('admin/assessment') }}" class="frameretrospective">
                <img src="{{ asset('admin/img/รูปของปุ่มย้อนกลับ.png') }}" alt="รูปของปุ่มย้อนกลับ" class="img-retrospective">
                <p class="messageretrospective">ย้อนกลับ</p>
            </a>


        <div class="framecreateactivity">
            <img src="{{ asset('admin/img/รูปโลโกมหาลัย.png') }}" alt="รูปโลโกมหาลัย" class="img-university">
            <div class="messagecreateactivity">
                <p class="messagecreateactivity-1">สร้างกิจกรรม</p>
                <span class="create-QR">สร้าง QR แล้วให้ผู้เข้าร่วม scan ลงทะเบียนในงานได้เลย</span>
            </div>
            <form id="frame_blackactivity_1">
            <div class="frameblackactivity">
                <div class="framesettings">
                    <p class="messagesettings">ตั้งค่ากิจกรรม</p>
                    <span class="fill-information">กรอกข้อมูลด้านล่าง ระบบจะสร้าง QR code ให้อัตโนมัติ</span>
                </div>
                <label class="frameactivity-name">
                    <div class="activity-name-1">
                        <p class="messageactivity-name">ชื่อกิจกรรม <span class="asteriskactivity">*</span></p>
                    </div>
                    <input type="text" class="framepimactivity-nam" placeholder="กรอกชื่อกิจกรรม" id="frame_pim_activitynam">
                </label>
                <div class="framemessagedatetime">
                    <p class="dateactivity">วันที่จัดกิจกรรม <span class="asteriskdateactivity">*</span></p>
                    <p class="closingtime-Register">เวลาปิด Register <span class="asteriskdateactivity">*</span></p>
                </div>
                <div class="frameweardate">
                    <input type="date" class="framedatemonthyear" id="framedate_month_year">
                    <input type="time" class="framedatemonthyear" id="time_offregister">
                </div>
                <div class="framechoosereward-1">
                    <p class="messagechoosereward">เลือกของรางวัล <span class="asteriskchoosereward">*</span></p>
                </div>

                @foreach($rewards as $reward)
                <div class="framebtn-chooserewardall">
                    <div class="framechooserewardall">
                        <div class="framemessage2">
                            <p class="messagepencil">{{ $reward->name }}</p>
                            <span class="messagestationery">{{ $reward->category->name }}</span>
                        </div>
                            <p class="percentpencil">{{ $reward->quantity_reward }}</p>
                            <p class="percentpencil">{{ number_format($reward->rate, 1) }} %</p>
                        <div class="btn-plus-delete-checkbox">
                            <button type="button" class="btndelete" onclick="deletenumberquantity('qty_{{ $reward->reward_id }}')">
                                <p class="btndelet-10">-</p>
                            </button>
                            <input type="number" id="qty_{{ $reward->reward_id }}" name="rewards[{{ $reward->reward_id }}][qty]" value="1" class="btndelete-1" min="1" max="{{ $reward->quantity_reward }}">
                            <button type="button" class="btnplus" onclick="addnumberquantity('qty_{{ $reward->reward_id }}' , {{ $reward->quantity_reward }})">+</button>
                            <input type="checkbox" class="btn-checkbox" id="active_{{ $reward->reward_id }}" name="reward[{{ $reward->reward_id }}][active]" value="1">
                        </div>
                    </div>
                </div>
                @endforeach

                    <button type="button" class="showmore" id="show_more">
                        <p class="messageshowmore">แสดงเพิ่มเติม</p>
                    </button>

                <div class="frameandquantity">
                    <p class="messagequantity">จำนวนผู้เข้าร่วมสูงสุด</p>
                    <input type="number" value="1" class="framenumberquantity" id="frame_number_quantity">
                </div>
                <button type="submit" id="submit_buildandQR" class="submitbuildandQR">
                    <img src="{{ asset('admin/img/รูปของปุ่มสร้างกิจกรรมและ QR code.png') }}" alt="รูปของปุ่มสร้างกิจกรรมและ QR code" class="buildandQR">
                    <p class="messagebuildandQR">สร้างกิจกรรมและ QR code</p>
                </button>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('admin/js/JavaScriptAdmin.js') }}"></script>
</body>
</html>