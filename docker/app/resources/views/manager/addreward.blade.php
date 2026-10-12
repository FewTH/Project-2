<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('manager/css/addreward.css')}}">
    <title>เพิ่มรางวัล</title>
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
    <form action="{{route('manager.reward.store')}}" method="POST">
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
        <a href="{{ url('manager/managereward') }}" class="cancle-btn">
            <span>ยกเลิก</span>
        </a>
    </div>
    </form>
</div>

</body>
</html>