<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <title>เพิ่มรางวัล</title>
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

@if ($errors->any())
    <div style="color:red; margin-bottom:10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- ตัวฟอร์มให้ใส่รายละเอียดรางวัล -->
<div class="add-box-main">
    <form action="{{route('admin.reward.store')}}" method="POST">
    @csrf
    <h1 class="Topic-addreward">เพิ่มของรางวัล</h1>
    <!-- ช่องกรอกข้อมูลของรางวัล -->
    <div class="input-reward-name">
        <label class="name-reward-sub" for="name-reward">ชื่อของรางวัล</label> <br>
        <input type="text" class="name-reward1" id="name-reward01" name="name" value="{{ old('name') }}" placeholder="กรอกรายชื่อของรางวัลของคุณ" required>
    </div>
    <div class="input-reward-category">
    <label class="category-reward-sub" for="category-reward01">หมวดหมู่</label> <br>
        <select class="category_list_01" id="category_list" name="category_id" required>
            <option value="">--เลือกหมวดหมู่ของรางวัล--</option>
                @foreach($categories as $category)
            <option value="{{ $category->category_id }}" {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
                @endforeach
        </select>     
    </div>

    <div class="input-reward-num">
        <label class="num-reward-sub" for="num_reward">จำนวน</label> <br>
        <input type="number" class="num-reward1" id="num-reward01" name="quantity_reward" value="{{ old('quantity_reward') }}" placeholder="โปรดระบุจำนวนของรางวัลของคุณ" required>
    </div>
    <div class="input-reward-rate">
        <label class="rate-reward-sub" for="rate-reward_sub">อัตราการออก(%)</label> <br>
        <input type="number" class="rate-reward1" id="rate-reward01" name="rate" value="{{ old('rate') }}" placeholder="ระบุเปอร์เซ็นของรางวัล" required>
    </div>   
    <div class="ad-botton">
        <button type="submit" class="addre-btn1">
            <span>บันทึกข้อมูล</span>
        </button>
        <a href="{{ url('admin/managereward') }}" class="cancle-btn">
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
        <a href="{{ url('user/loginuser') }}" class="btn-logout2">
            <img src="{{ asset('admin/img/รูปปุ่มกดออก.png') }}" alt="รูปออกจากระบบ" class="btn-logout-img2">
            <span>ออกจากระบบ </span>
        </a>
    </div>
</div>
</body>
</html>