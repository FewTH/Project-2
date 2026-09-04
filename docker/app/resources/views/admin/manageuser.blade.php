<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="icon" href="{{ asset('admin/img/Logo.png') }}">
    <title>จัดการผู้ใช้</title>
</head>
<body class="Mainbody-manageuser">
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
    <div class="manageuser-box">
        <h1 class="manageusr-title">จัดการสิทธิ์ผู้ใช้งาน</h1>
        <!-- บ็อกหลักรายชื่อผู้ใช้ -->
        <div class="manageusr-mainbox">
            <h3 class="sub-manageuser">รายชื่อผู้ใช้ทั้งหมด</h3>

            <a href="{{ route('admin.adduser') }}" class="add-usr-btn">
                <img src="img/ไอคอนบวก.png" alt="ไอคอนเพิ่มผู้ใช้งาน">
                <span>เพิ่มผู้ใช้งานใหม่</span>
            </a>
            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- search-user -->
            <div class="search-usr-box">
                <input type="text" class="usr-searchbox" placeholder="ค้นหาชื่อผู้ใช้งานหรืออีเมล">
                <img src="{{ asset('admin/img/search.png') }}" alt="กล่องค้นหารายชื่อ" class="search-usr-png">
            </div>

            <div class="usr-topic">
                <h3 class="topic-name-usr">ผู้ใช้</h3>
                <h3 class="topic-email-usr">อีเมล</h3>
                <h3 class="topic-auth-usr">ระดับสิทธิ์</h3>
                <h3 class="topic-sts-usr">สถานะ</h3>
                <h3 class="topic-manage-usr">จัดการ</h3>
            </div>

            <!-- ลูปแสดงข้อมูลผู้ใช้จากฐานข้อมูล -->
            @forelse($users as $user)
                <div class="user-1">
                    <h3 class="name1">{{ $user->full_name }}</h3>
                    <h3 class="email1">{{ $user->email }}</h3>
                    <h3 class="auth1">{{ $user->role }}</h3>
                    <h3 class="sts1">{{ $user->is_active ? 'ใช้งานอยู่' : 'ปิดใช้งาน' }}</h3>
                    <div class="manage-btn3">
                        <!-- ปุ่มแก้ไข -->
                        <a href="{{ route('admin.user.edit', $user->user_id) }}">
                            <img src="{{ asset('admin/img/editicon.png') }}" alt="รูปปุ่มแก้ไข" class="edit-icon3">
                        </a>
                    <!-- ปุ่มลบข้อมูล -->
                    <form action="{{ route('admin.user.destroy', $user->user_id) }}" method="POST" class="delete-form" onsubmit="return confirm('คุณต้องการลบผู้ใช้คนนี้ใช่หรือไม่');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn-action">
                            <img src="{{ asset('admin/img/delete.png') }}" alt="รูปปุ่มลบ" class="delete-icon3">
                        </button>
                    </form>
                    </div>
                    </div>
                        @empty
                <div class="empty-user-msg">
                    ยังไม่มีข้อมูลผู้ใช้งานในระบบ
                </div>
            @endforelse
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
        <a href="{{ url('admin/managespin') }}" class="btn-Managewheel3">
            <img src="{{ asset('admin/img/รูปจัดการวงล้อสุ่ม.png') }}" alt="รูปติดต่อเรา" class="btn-Managewheel-img3">
            <span>จัดการวงล้อสุ่ม</span>
        </a>
        <a href="{{ url('admin/assessment') }}" class="btn-Assessment3">
            <img src="{{ asset('admin/img/รูปแบบประเมินกิจกรรม.png') }}" alt="รูปติดต่อเรา" class="btn-Assessment-img3">
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
</div>
</body>
</html>