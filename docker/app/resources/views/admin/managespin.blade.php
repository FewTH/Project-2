<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="icon" href="{{ asset('admin/img/Logo.png') }}">
    <title>จัดการวงล้อสุ่ม</title>
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

    <div class="wheel-mainspn-topic">
        <h1 class="main-spn-topic">จัดการวงล้อสุ่ม</h1>
    </div>

    <div class="main-spn-box">
        <div class="reward-spn-list">
            {{-- ช่องค้นหารางวัล --}}
            <div class="search-box-spn">
                <input type="text" class="search-spn-input">
                <img src="{{ asset('admin/img/search.png')}}" class="search-spn-icon" alt="รูปแว่นขยาย">
            </div>
            <h4 class="descrip-title">เลือกของรางวัลจากคลัง</h4>
        {{-- หัวข้อด้านบน --}}
        <div class="topic-spn-list">
            <h4 class="spn-name">ชื่อรางวัล</h4>
            <h4 class="spn-rate">อัตรา</h4>
            <h4 class="spn-quantity">จำนวน</h4>
            <h4 class="spn-selected-quantity">ระบุจำนวน</h4>
        </div>
        <div class="reward-list-name">
    <!-- รายการของรางวัลชิ้นที่ 1 -->
    @forelse($rewards as $reward)
        <div class="reward-wheel-1" 
         data-id="{{ $reward->reward_id }}" 
         data-name="{{ $reward->name }}" 
         data-rate="{{ $reward->rate }}">
        <span class="name_re1">{{ $reward->name }}</span>
        <span class="rate_re1">{{ $reward->rate }}%</span>
        <span class="quantity_re1">{{ $reward->quantity_reward }}</span>

            {{-- ปุ่มเพิ่มกับลดจำนวนของรางวัล --}}
            <div class="select-re-qnty">
                <button type="button" class="qnty-plus">+</button>
                <input type="number" class="qnty-in" value="1" min="1" max="{{$reward->quantity_reward}}">
                <button type="button" class="qnty-minus">-</button>
                <input type="checkbox" class="reward-check-box" id="reward-{{$reward->reward_id}}">
                <label for="reward-{{$reward->reward_id}}" class="checkbx-reward"></label>
            </div>
        </div>
    @empty
        <div class="no-data">
            <p>ยังไม่มีรายการของรางวัลในระบบ</p>
        </div>
    @endforelse
    </div>
        <button type="button" class="claerall-selected" id="clearAllselected" disabled>ล้างทั้งหมด</button>
    </div>
    
    {{-- วงล้อสุ่ม --}}
    <div class="main-wheel-spn">
        <div class="spn-wheel-topic">
            <h4>วงล้อสุ่มรางวัล</h4>
            {{-- ตัวนับจำนวนราง --}}
             <span>จำนวนของรางวัล <span id="slected-count">0</span> รายการ</span>
        </div>
        {{-- ตัววงล้อ --}}
        <div class="wheel-spn-main">
            <canvas id="wheel-spn-reward" width="500" height="500"></canvas>
        </div>
        {{-- ปุ่มบันทึกกับลบ --}}
        <div class="btn-manage-wheel">
            <button type="button" class="submit-wheel-reward" id="submit-btn-wheel">บันทึก</button>
            <button type="button" class="cancle-wheel-btn" id="cancle-btn-wheel">ยกเลิก</button>
        </div>
    </div>
    </div>
    
    {{-- ส่วนป็อบอัพ --}}
    <div class="pop-up-background" id="assessmentModal">
        <div class="pop-up-content">
            <div class="header-popup-spn">
                <img src="{{asset('admin/img/โลโก้รางวัลป็อปอัป.png')}}" class="logo-popup-topic" alt="โลโก้รางวัลป็อปอัป">
                <span class="text-assess">เพิ่มวงล้อรางวัลไปยังแบบประเมิน</span>
                <img src="{{asset('admin/img/กากบาท.png')}}" class="x-button" id="closeModalBtn" alt="กากบาท">
            </div>
        <div class="wheel-name">
            <h4 class="topic-wheel-sub">วงล้อที่สร้างใหม่</h4>
            <h4 class="wheel-sum-value" id="wheelSumtext">วงล้อรางวัล <span id="wheelItemCount"></span>รายการ (<span id="wheeItemnames"></span>)</h4>
        </div>
        {{-- หัวข้ออธิบาย --}}
        <div class="descrip">
            <h4 class="wheel-sumary">เลือกแบบประเมินที่ต้องการ</h4>
            <p class="wheel-sum" id="wheelSummary">แสดงเฉพาะแบบประเมินที่ยังไม่มีวงล้อ</p>
        </div>
        {{-- หัวข้อในตาราง --}}
        <div class="topic-assess">
            <span class="name-topic-assess">รายการแบบประเมิน</span>
            <span class="sts-topic-assess">สถานะ</span>
        </div>
        {{-- ไว้แสดงรายการแบบประเมิน --}}
        <div class="all-assess-list" id="assessmentListBody">
            
        </div>
        {{-- ปุ่ม --}}
        <div class="modal-footer-btn">
            <button type="button" class="confirm-btn" id="confirmAssessmentBtn">บันทึก</button>
            <button type="button" class="not-confirm-btn" id="cancelAssessmentBtn">ยกเลิก</button>
        </div>
    </div>
</div>

    <!-- ส่วนเมนูsidebar -->
    <div class="container2">
    <!-- โลโกมหาลัย -->
    <div class="img-Logo2">
        <img src="{{ asset('admin/img/Logo.png') }}" alt="รูปโลโกมหาลัย" class="Logo-img">
    </div>
    <!-- ปุ่มเมนู -->
    <div class="btn-Sidebar">
        <a href="{{ url('admin/dashboard') }}" class="btn-Dashboard2">
            <img src="{{ asset('admin/img/แดชบอร์ด.png') }}" alt="รูปแดชบอร์ดสีดำ" class="btn-Dashboard-img2">
            <span>แดชบอร์ด</span>
        </a>
        <a href="{{ url('admin/managereward') }}" class="btn-Manage_Rewards3">
            <img src="{{ asset('admin/img/รูปจัดการรางวัล.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Manage_Rewards-img3">
            <span>จัดการรางวัล</span>
        </a>
        <a href="{{ url('admin/manageuser') }}" class="btn-Manage_users">
            <img src="{{ asset('admin/img/รูปจัดการผู้ใช้.png') }}" alt="รูปติดต่อเรา" class="btn-Manage_users-img">
            <span>จัดการผู้ใช้</span>
        </a>
        <a href="{{ url('admin/managespin') }}" class="btn-Managewheel4">
            <img src="{{ asset('admin/img/รูปจัดการวงล้อสุ่มสีดำ.png') }}" alt="รูปติดต่อเรา" class="btn-Managewheel-img4">
            <span>จัดการวงล้อสุ่ม</span>
        </a>
        <a href="{{ url('admin/assessment') }}" class="btn-Assessment4">
            <img src="{{ asset('admin/img/รูปแบบประเมินกิจกรรม.png') }}" alt="รูปติดต่อเรา" class="btn-Assessment-img4">
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
<script src="{{ asset('admin/js/managespin.js') }}"></script>
</body>
</html>