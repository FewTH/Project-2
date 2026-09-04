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

    {{-- <div class="spinwheel-page">
    <!-- ฝั่งซ้าย: คลังของรางวัล -->
    <div class="reward-pool-box">
        <div class="pool-header">
            <h4>คลังของรางวัลทั้งหมด</h4>
            <span class="pool-count">ทั้งหมด {{ $rewards->count() }} รายการ</span>
        </div>
        <div class="pool-search">
            <input type="text" placeholder="ค้นหารายการรางวัล" id="rewardSearch">
            <select id="categoryFilter">
                <option value="">หมวดหมู่</option>
                <option value="เครื่องเขียน">เครื่องเขียน</option>
                <option value="ของใช้ทั่วไป">ของใช้ทั่วไป</option>
                <!-- ... -->
            </select>
        </div>
        <div class="pool-table-header">
            <span>ชื่อรางวัล</span>
            <span>อัตราการออก</span>
            <span>จำนวน</span>
            <span>เลือกจำนวน</span>
        </div>
        <div class="pool-list">
            @foreach ($rewards as $reward)
                <div class="pool-item" data-id="{{ $reward->id }}" data-rate="{{ $reward->rate }}">
                    <div class="pool-item-info">
                        <img src="{{ asset('admin/img/icon-' . $reward->id . '.png') }}" class="pool-item-icon">
                        <div>
                            <p class="pool-item-name">{{ $reward->name }}</p>
                            <p class="pool-item-category">{{ $reward->category }}</p>
                        </div>
                    </div>
                    <div class="pool-item-rate">
                        {{ $reward->rate }}%
                        <div class="rate-bar">
                            <div class="rate-bar-fill" style="width: {{ $reward->rate }}%"></div>
                        </div>
                    </div>
                    <span class="pool-item-qty">{{ $reward->quantity }}</span>
                    <div class="pool-item-select-qty">
                        <button type="button" class="qty-minus">−</button>
                        <input type="number" class="qty-input" value="1" min="1" max="{{ $reward->quantity }}">
                        <button type="button" class="qty-plus">+</button>
                    </div>
                    <!-- ตัวติ๊กเลือก -->
                    <input type="checkbox" class="pool-item-checkbox" id="reward-{{ $reward->id }}">
                    <label for="reward-{{ $reward->id }}" class="pool-item-radio-visual"></label>
                </div>
            @endforeach
        </div>
        <p class="pool-footer-note">ขั้นต่ำควรเลือก 2 รายการ</p>
        <button type="button" class="btn-clear-all" disabled>ล้างทั้งหมด</button>
    </div>
    <!-- ฝั่งขวา: วงล้อ -->
    <div class="wheel-box">
        <div class="wheel-header">
            <h4>วงล้อสุ่มรางวัล</h4>
            <span class="wheel-count">จำนวนของรางวัล <span id="selectedCount">0</span> รายการ</span>
        </div>
        <div class="wheel-canvas-wrapper">
            <canvas id="rewardWheel" width="500" height="500"></canvas>
            <div class="wheel-pointer"></div>
        </div>
        <div class="wheel-actions">
            <button type="button" class="btn-save-wheel" id="saveWheelBtn">บันทึกวงล้อ</button>
            <button type="button" class="btn-cancel-wheel">ยกเลิก</button>
        </div>
    </div>
</div> --}}

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
        <a href="{{ url('admin/managereward') }}" class="btn-Manage_Rewards4">
            <img src="{{ asset('admin/img/รูปจัดการรางวัล.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Manage_Rewards-img4">
            <span>จัดการรางวัล</span>
        </a>
        <a href="{{ url('admin/manageuser') }}" class="btn-Manage_users2">
            <img src="{{ asset('admin/img/รูปจัดการผู้ใช้.png') }}" alt="รูปติดต่อเรา" class="btn-Manage_users-img2">
            <span>จัดการผู้ใช้</span>
        </a>
        <a href="{{ url('admin/managespin') }}" class="btn-Managewheel4">
            <img src="{{ asset('admin/img/รูปจัดการวงล้อสุ่มสีดำ.png') }}" alt="รูปติดต่อเรา" class="btn-Managewheel-img4">
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
</div>
</body>
</html>