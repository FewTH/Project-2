<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="icon" href="{{ asset('admin/img/Logo.png') }}">
    <title>จัดการรางวัล</title>
</head>
<body class="mgreward-body">
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
    <!-- ส่วนเนื้อหาหลัก (Detail) -->
        <div class="detail">
            <!-- หัวข้อหลัก -->
            <h1 class="maintitle-name">จัดการรางวัล</h1>
            
            <div class="searchbox">
                <div class="input-wrapper">
                    <input type="text" class="search-box" placeholder="ค้นหารายการรางวัล">
                    <img src="img/search.png" alt="search-icon" class="search-icon">
                </div>
            </div>
            <!-- ปุ่มเพิ่มของรางวัล -->
                <div class="addbutton">
                    <button type="button" class="addreward">
                    <a href="{{ url('admin/addreward') }}" class="addreward-btn">
                        <img src="img/ไอคอนบวก.png" alt="plusicon" class="plus-icon">
                        <span class="addrwdtext">เพิ่มของรางวัล</span>
                    </a>
                    </button>
                </div>
        <div class="reward-list">
            <div class="topic-rewardlist">
                <h4 class="topic1">ชื่อของรางวัล</h4>
                <h4 class="topic2">หมวดหมู่</h4>
                <h4 class="topic3">อัตราการออก</h4>
                <h4 class="topic4">จำนวน</h4>
                <h4 class="topic5">จัดการ</h4>
            </div>
    <div class="reward-list-name">
    <!-- รายการของรางวัลชิ้นที่ 1 -->
    @forelse($rewards as $reward)
        <div class="reward-1">
            <h3 class="name_re1">{{ $reward->name }}</h3>
            <h3 class="category_re1">{{ $reward->category->name }}</h3>
            <h3 class="rate_re1">{{ $reward->rate }}</h3>
            <h3 class="quantity_re1">{{ $reward->quantity_reward }}</h3>

        <div class="manage-btn3">
             <!-- ปุ่มแก้ไข -->
            <a href="{{ route('admin.reward.edit', $reward->reward_id) }}">
                <img src="{{ asset('admin/img/editicon.png') }}" alt="รูปปุ่มแก้ไข" class="edit-icon3">
            </a>
            <!-- ปุ่มลบข้อมูล -->
            <form action="{{ route('admin.reward.destroy', $reward->reward_id) }}" method="POST" class="delete-form" onsubmit="return confirm('ต้องการลบรางวัลใช่หรือไม่?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn-action">
                    <img src="{{ asset('admin/img/delete.png') }}" alt="รูปปุ่มลบ" class="delete-icon3">
                </button>
            </form>
            </div>
        </div>
    @empty
        <div class="no-data">
            <p>ยังไม่มีรายการของรางวัลในระบบ</p>
        </div>
    @endforelse
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
        <a href="{{ url('admin/managereward') }}" class="btn-Manage_Rewards2">
            <img src="{{ asset('admin/img/รูปจัดการรางวัลสีดำ.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Manage_Rewards-img2">
            <span>จัดการรางวัล</span>
        </a>
        <a href="{{ url('admin/manageuser') }}" class="btn-Manage_users2">
            <img src="{{ asset('admin/img/รูปจัดการผู้ใช้.png') }}" alt="รูปติดต่อเรา" class="btn-Manage_users-img2">
            <span>จัดการผู้ใช้</span>
        </a>
        <a href="{{ url('admin/managespin') }}" class="btn-Managewheel2">
            <img src="{{ asset('admin/img/รูปจัดการวงล้อสุ่ม.png') }}" alt="รูปติดต่อเรา" class="btn-Managewheel-img2">
            <span>จัดการวงล้อสุ่ม</span>
        </a>
        <a href="{{ url('admin/assessment') }}" class="btn-Assessment2">
            <img src="{{ asset('admin/img/รูปแบบประเมินกิจกรรม.png') }}" alt="รูปติดต่อเรา" class="btn-Assessment-img2">
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
</body>
</html>