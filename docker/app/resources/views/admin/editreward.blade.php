<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <title>แก้ไขรางวัล</title>
</head>
<body>
    <!-- ชื่อผู้ใช้งาน -->
<div class="btn-user-wrapper">
    <a href="{{ url('admin/profile') }}" class="btn-user">
        @if($user?->profile_image)
        <img src="{{ asset('storage/'.$user->profile_image) }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @else
        <img src="{{ asset('admin/img/รูปuser.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @endif
        <span>Admin</span>
    </a>
</div>

    <div class="edit-re-main">
        <h1>แก้ไขรางวัล</h1>
    <form action="{{ route('admin.reward.update', $reward->reward_id) }}" method="POST">
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

            <a href="{{url ('admin/managereward')}}" class="cancle-btn-editreward">
                <span>ยกเลิก</span>
            </a>
        </div>
    </form>
    </div>

    <!-- ส่วนเมนูsidebar -->
    <div class="container-mngrewrd">
    <!-- โลโกมหาลัย -->
    <div class="img-Logo-mngrewrd">
        <img src="{{ asset('admin/img/Logo.png') }}" alt="รูปโลโกมหาลัย" class="Logo-img-mngrewrd">
    </div>
    <!-- ปุ่มเมนู -->
    <div class="btn-Sidebar-mngrewrd">
        <a href="{{ url('admin/dashboard') }}" class="btn-Dashboard-mngrewrd">
            <img src="{{ asset('admin/img/แดชบอร์ด.png') }}" alt="รูปแดชบอร์ดสีดำ" class="btn-Dashboard-img-mngrewrd">
            <span>แดชบอร์ด</span>
        </a>
        <a href="{{ url('admin/managereward') }}" class="btn-Manage_Rewards-mngrewrd">
            <img src="{{ asset('admin/img/รูปจัดการรางวัลสีดำ.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Manage_Rewards-img-mngrewrd">
            <span>จัดการรางวัล</span>
        </a>
        <a href="{{ url('admin/manageuser') }}" class="btn-Manage_users-mngrewrd">
            <img src="{{ asset('admin/img/รูปจัดการผู้ใช้.png') }}" alt="รูปติดต่อเรา" class="btn-Manage_users-img-mngrewrd">
            <span>จัดการผู้ใช้</span>
        </a>
        <a href="{{ url('admin/managespin') }}" class="btn-Managewheel-mngrewrd">
            <img src="{{ asset('admin/img/รูปจัดการวงล้อสุ่ม.png') }}" alt="รูปติดต่อเรา" class="btn-Managewheel-img-mngrewrd">
            <span>จัดการวงล้อสุ่ม</span>
        </a>
        <a href="{{ url('admin/assessment') }}" class="btn-Assessment-mngrewrd">
            <img src="{{ asset('admin/img/รูปแบบประเมินกิจกรรม.png') }}" alt="รูปติดต่อเรา" class="btn-Assessment-img-mngrewrd">
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