<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
 
    <title>BUUGIFT</title>
</head>
<body class="main-spin-body">
    <!-- ชื่อผู้ใช้งาน -->
    <div class="btn-user-wrapper">
         <a href="{{ url('user/profile') }}" class="btn-user">
            @if($user?->profile_image)
            <img src="{{ asset('storage/'.$user->profile_image) }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
            @else
            <img src="{{ asset('user/img/รูปuser.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
            @endif
            <span>User</span>
        </a>
    </div>

{{-- อันหลักของหน้าสุ่ม --}}
    <div class="main-content2">
        <h1 class="Topic-main-spin">ศูนย์กลางสุ่มของขวัญ</h1>

        <div class="main-search-spin2">
            <input type="text" class="search-spin2" placeholder="ค้นหารายชื่อแบบประเมิน">
            <img src="img/แว่นขยาย.png" alt="แว่นขยาย" class="search-spin-icon">
        </div>
        <div class="filter-main">
            <button type="button" class="filter-btn active" id="all-btn">ทั้งหมด</button>
            <button type="button" class="filter-btn" id="spined-btn">สุ่มแล้ว</button>
            <button type="button" class="filter-btn" id="not-spin">ยังไม่สุ่ม</button>
        </div>
        <div class="main-spincontent">
    <h2 class="spin-subtiltle">รายการแบบประเมินที่ทำแล้ว</h2>

<div class="frame-grey-1" id="assessment-list">
    @forelse($assessments as $assessment)
    <div class="sectionassessment"
         id="test1-{{ $assessment->assessment_id }}"
         data-name="{{ $assessment->name }}"
         data-drawn="{{ $assessment->is_drawn ? '1' : '0' }}">

        <div class="frameinformation-assessment">
            <div class="framesection-status">
                <h3 class="section-assessment">{{ $assessment->name }}</h3>
                <div class="frame-status">
                    <p class="point-status"></p>
                    <p class="message-status">
                        {{ $assessment->is_drawn ? 'สุ่มแล้ว' : 'ยังไม่สุ่ม' }}
                    </p>
                </div>
            </div>

            <p class="message-assessment">
                ปิดรับคำตอบ: {{ $assessment->closed_at ? $assessment->closed_at->format('d M Y') : '-' }}
            </p>

            <a href="{{ route('user.spin.history', $assessment->assessment_id) }}" class="view-history">
                <p class="message-view-history">ดูประวัติการสุ่ม</p>
            </a>
        </div>
    </div>
    @empty
    <div class="nothaveactivity">
        <p class="nothaveactivity-1">ยังไม่มีรายการแบบประเมินที่ถูกทำ</p>
    </div>
    @endforelse
</div>

<div class="container-spin">
    <!-- โลโกมหาลัย -->
    <div class="img-Logo-home">
        <img src="img/Logo.png" alt="รูปโลโกมหาลัย" class="Logo-img">
    </div>
    <!-- ปุ่มเมนู -->
    <div class="btn-Sidebar-spin">
        <a href="{{ url('user/home') }}" class="btn-Home-2">
            <img src="{{ asset('user/img/Home.png') }}" alt="รูปบ้าน" class="btn-Home-img-2">
            <span>หน้าหลัก</span>
        </a>

        <a href="{{ url('user/spin') }}" class="btn-Random2">
            <img src="{{ asset('user/img/Randomสีดำ.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Random-img2">
            <span>สุ่มของรางวัล</span>
        </a>

        <a href="{{ url('user/contact') }}" class="btn-Contact-2">
            <img src="{{ asset('user/img/Contact.png') }}" alt="รูปติดต่อเรา" class="btn-Contact-img-2">
            <span>ติดต่อเรา</span>
        </a>
    </div>
    <!-- ปุ่มกดออกจากระบบ -->
    <div class="btn-logout-wrapper">
        <a href="{{ url('user/loginuser') }}" class="btn-logout2">
            <img src="img/รูปปุ่มกดออก.png" alt="รูปออกจากระบบ" class="btn-logout-img2">
            <span>ออกจากระบบ </span>
        </a>
    </div>
    </div>
       <script src="{{ asset('user/js/JavaScript.js') }}"></script>
</body>
</html>