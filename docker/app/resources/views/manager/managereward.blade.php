<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('manager/css/managereward.css') }}">
    <link rel="icon" href="{{ asset('user/img/Logo.png') }}">
    <title>จัดการรางวัล</title>
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
        <a href="{{ url('manager/managereward') }}" class="btn-managereward1">
            <img src="{{ asset('admin/img/รูปจัดการรางวัลสีดำ.png') }}" alt="รูปปุ่มเมนูจัดการรางวัล" class="btn-Home-img-1">
            <span>จัดการรางวัล</span>
        </a>
        <a href="{{ url('manager/managespin') }}" class="btn-Random-1">
            <img src="{{ asset('manager/img/รูปปุ่มเมนูจัดการวงล้อสุ่ม.png') }}" alt="รูปปุ่มเมนูจัดการวงล้อสุ่ม" class="btn-Random-img-1">
            <span>จัดการวงล้อสุ่ม</span>
        </a>
        <a href="{{ url('manager/assessment') }}" class="btn-Assessment-assess">
            <img src="{{ asset('manager/img/รูปปุ่มเมนูรายการกิจกรรม.png') }}" alt="รูปติดต่อเรา" class="btn-Assessment-img-assess">
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

    <!-- ส่วนเนื้อหาหลัก (Detail) -->
        <div class="detail">
            <!-- หัวข้อหลัก -->
            <div class="maintitle-name">
                <h1>จัดการรางวัล</h1>
            </div>

            <div class="btn-top-rewardbox">
                {{-- ช่องค้นหา --}}
                    <div class="input-wrapper">
                        <input type="text" class="search-box" placeholder="ค้นหารายการรางวัล">
                        <img src="{{ asset('admin/img/search.png') }}" alt="search-icon" class="search-icon">
                    </div>
            <!-- ปุ่มเพิ่มของรางวัล -->
                {{-- <div class="addbutton"> --}}
                    <button type="button" class="addreward">
                    <a href="{{ url('manager/addreward') }}" class="addreward-btn">
                        <span class="addrwdtext">+ เพิ่มของรางวัล</span>
                    </a>
                    </button>
                {{-- </div> --}}
            </div>

        <div class="reward-list">
            <div class="topic-rewardlist">
                <h3 class="topic1">ชื่อของรางวัล</h3>
                <h3 class="topic2">หมวดหมู่</h3>
                <h3 class="topic3 text-center">อัตราการออก</h3>
                <h3 class="topic4 text-center">จำนวน</h3>
                <h3 class="topic5 text-center">จัดการ</h3>
            </div>
    <div class="reward-list-name">
    <!-- รายการของรางวัลชิ้นที่ 1 -->
    @forelse($rewards as $reward)
        <div class="reward-1">
            <h3 class="name_re1">{{ $reward->name }}</h3>
            <h3 class="category_re1">{{ $reward->category->name }}</h3>
            <h3 class="rate_re1 text-center">{{ $reward->rate }}%</h3>
            <h3 class="quantity_re1 text-center">{{ $reward->quantity_reward }}</h3>
            

        <div class="manage-btn3 justify-center">
             <!-- ปุ่มแก้ไข -->
            <a href="{{ route('manager.reward.edit', $reward->reward_id) }}">
                <img src="{{ asset('admin/img/editicon.png') }}" alt="รูปปุ่มแก้ไข" class="edit-icon3">
            </a>
            <!-- ปุ่มลบข้อมูล -->
            <form action="{{ route('manager.reward.destroy', $reward->reward_id) }}" method="POST" class="delete-form" onsubmit="return confirm('ต้องการลบรางวัลใช่หรือไม่?');">
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

</body>
<script src="{{asset('manager/js/managereward.js')}}"></script>
</html>