<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('manager/css/editreward.css')}}">
    <title>แก้ไขรางวัล</title>
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

<div class="edit-re-main">
        <h1>แก้ไขรางวัล</h1>
    <form action="{{ route('manager.reward.update', $reward->reward_id) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- ชื่อรางวัล --}}
        <div class="name-re-edit">
            <label for="namere-edt-in" class="topic-namere-edt">ชื่อรางวัล</label><br>
            <input type="text" class="namere-edt-in" id="name" name="name" value="{{ old('name',$reward->name) }}" required>
        </div>
        {{-- หมวดหมู่ --}}
        <div class="cate-re-edit">
            <label for="catere-edt" class="topic-cate-edt">หมวดหมู่</label><br>
                <select class="catere-edt-in" id="category_list" name="category_id" required>
                    <option value="">--เลือกหมวดหมู่ของรางวัล--</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->category_id }}" {{ old('category_id',$reward->category_id) == $category->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                     @endforeach
                </select>
        </div>
        {{-- อัตราการออก --}}
        <div class="rate-re-edit">
            <label for="ratere-edt-in" class="topic-rate-edt">อัตราการออก</label><br>
            <input type="number" class="ratere-edt-in" id="rate" name="rate" value="{{old('rate',$reward->rate)}}" required>
        </div>
        {{-- จำนวนรางวัล --}}
        <div class="qnty-re-edit">
            <label for="" class="topic-qnty-edt">จำนวนของรางวัล</label><br>
            <input type="number" class="qntyre-edt-in" id="quantity" name="quantity_reward" value="{{old('quantity_reward',$reward->quantity_reward)}}" required>
        </div>
        {{-- ปุ่มบันทึกและยกเลิก --}}
        <div class="mnge-boxmain">
            <button type="submit" class="submtedt-btn">
                <span>บันทึก</span>
            </button>

            <a href="{{url ('manager/managereward')}}" class="cancle-btn-editreward">
                <span>ยกเลิก</span>
            </a>
        </div>
    </form>
    </div>
</body>
</html>