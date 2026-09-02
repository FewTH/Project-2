<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <title>แก้ไขผู้ใช้งาน</title>
</head>
<body>
    <!-- ชื่อผู้ใช้งาน -->
<div class="btn-user-wrapper">
    <a href="{{ url('admin/profile') }}" class="btn-user">
        @if($user->profile_image)
        <img src="{{ asset('storage/'.$user->profile_image) }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @else
        <img src="{{ asset('admin/img/user.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @endif
        <span>Admin</span>
    </a>
</div>

        <div class="main-edit-box">
            <h1 class="edit-usr-topic">แก้ไขผู้ใช้งาน</h1>
            <form id="edit-usr-box">
                {{-- ลำดับ --}}
                <div class="num-user">
                    <label  class="num-user-li" for="">ลำดับ</label> <br>
                    <input type="number" class="num-user-acc" id="num-user-acc" placeholder="2" default="0">
                </div>
                {{-- ชื่อ --}}
                <div class="name-user">
                    <label class="name-user-li" for="name-user-acc">ชื่อผู้ใช้งาน</label> <br>
                    <input type="text" class="name-user-acc" id="name-user-acc" name="fullname" placeholder="ระบุชื่อผู้ใช้งาน">
                </div>
                {{-- บทบาท --}}
                <div class="role-user">
                    <label class="role-usr-li" for="role-usr-acc">บทบาท</label> <br>
                    <input type="text" class="role-user-acc" list="role_list" id="role-usr-acc" placeholder="บทบาทผู้ใช้">
                    <datalist class="role_list_01" id="role_list">
                        <option value="Admin">
                        <option value="User">
                        <option value="Manager">
                    </datalist>
                </div>
                {{-- ปุ่มบันทีกกับยกเลิก --}}
                <div class="btn-sub_cln">
                    <button type="submit" class="submit-btn-edtusr">
                        <span>บันทึก</span>
                    </button>

                    <a href="{{url ('admin/manageuser')}}" class="cancle-btn-editusr">
                        <span>ยกเลิก</span>
                    </a>
                </div> 
            </form>
        </div>
    

<!-- ส่วนเมนูsidebar -->
    <div class="container2">
    <!-- โลโกมหาลัย -->
    <div class="img-Logo2">
        <img src="{{ asset('admin/img/Logo.png') }}" alt="รูปโลโกมหาลัย" class="Logo-img">
    </div>
    <!-- ปุ่มเมนู -->
    <div class="btn-Sidebar">
        <a href="{{ url('admin/dashboard') }}" class="btn-Dashboard3">
            <img src="{{ asset('admin/img/แดชบอร์ด.png') }}" alt="รูปแดชบอร์ดสีดำ" class="btn-Dashboard-img3">
            <span>แดชบอร์ด</span>
        </a>
        <a href="{{ url('admin/managereward') }}" class="btn-Manage_Rewards3">
            <img src="{{ asset('admin/img/รูปจัดการรางวัล.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Manage_Rewards-img3">
            <span>จัดการรางวัล</span>
        </a>
        <a href="{{ url('admin/manageuser') }}" class="btn-Manage_users3">
            <img src="{{ asset('admin/img/รูปจัดการผู้ใช้สีดำ.png') }}" alt="รูปจัดการผู้ใช้" class="btn-Manage_users-img3">
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
        <a href="{{ url('user/loginuser') }}" class="btn-logout2">
            <img src="{{ asset('admin/img/รูปปุ่มกดออก.png') }}" alt="รูปออกจากระบบ" class="btn-logout-img2">
            <span>ออกจากระบบ </span>
        </a>
    </div>
</div>
</body>
</html>