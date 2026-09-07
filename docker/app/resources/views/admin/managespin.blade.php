<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <div class="search-btn-box">
                <input type="text" class="search-spn-input">
                <img src="{{ asset('admin/img/search.png')}}" alt="รูปแว่นขยาย">
            </div>
            <h4 class="descrip-title">เลือกของรางวัลจากคลัง</h4>
        {{-- dropdownของหน้ารางวัล --}}
        {{-- <div class="dropdown-spn-cate">
            <label for="category-spn-re" class="cate-spn-re"></label>
            <select class="category_list_02" name="category_id" id="category_list">
                <option value="">หมวดหมู่</option>
                @foreach
                <option value="{{$categories->category_id}}" {{old('category_id') == $category->category_id ? 'selected': ''}}>
                    {{$category->name}}
                </option>
                @endforeach
            </select>
        </div> --}}
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
        <div class="reward-wheel-1">
            <h3 class="name_re1">{{ $reward->name }}</h3>
            <h3 class="rate_re1">{{ $reward->rate }}</h3>
            <h3 class="quantity_re1">{{ $reward->quantity_reward }}</h3>
        </div>
    @empty
        <div class="no-data">
            <p>ยังไม่มีรายการของรางวัลในระบบ</p>
        </div>
    @endforelse
    </div>
        </div>
        {{-- วงล้อสุ่ม --}}
    <div class="main-wheel-spn">
        <div class="spn-wheel-topic">
            <h4>วงล้อสุ่มรางวัล</h4>
            {{-- ตัวนับจำนวนราง --}}
             <span>จำนวนของรางวัล <span id="selectedCount">0</span> รายการ</span>
        </div>
        {{-- ตัววงล้อ --}}
        <div class="wheel-spn-main">
            <canvas id="wheel-spn-reward"></canvas>
        </div>
        {{-- ปุ่มบันทึกกับลบ --}}
        <div class="btn-manage-wheel">
            <button type="button" class="submit-wheel-reward" id="submit-btn-wheel">บันทึก</button>
            <button type="button" class="cancle-wheel-btn" id="cancle-btn-wheel">ยกเลิก</button>
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
</body>
</html>