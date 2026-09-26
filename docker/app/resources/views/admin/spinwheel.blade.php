<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <title>สุ่มรางวัลแบบประเมิน</title>
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
    <div class="random-reward">
        <div class="top-name-assessment">
            <h4 class="assessment-title-name">{{$assessment->name}}</h4>
            <span class="assess-status">{{$assessment->is_open ? 'open' : 'closed'}}
                {{$assessment->is_open ? 'เปิดอยู่' : 'ปิดแล้ว'}}
            </span>
        </div>
        <p class="assessment-summary-sub">
            วงล้อรางวัล:{{$wheel->rewards->pluck('name')->join(', ')}}
        </p>
    </div>
    <div class="wheel-box-main">
        <div class="text-wheel">
            <h3 class="text-topic">สุ่มของรางวัล</h3>
        </div>
        {{-- แสดงวงล้อที่ผูกกับแบบประเมิน --}}
        <div class="wheel-assessment-rewards">
            <canvas id="wheelrewardCanvas" width="500" height="500"></canvas>
            <div class="wheel-pointer"></div>
        </div>
    </div>
    <div class="spin-wheelassess-btn">
        <button type="button" id="spinassessmentBtn" class="spin-assessment-btn">
            <span class="play-icon">▶สุ่มรางวัล</span>
        </button>
    </div>
    <div class="bottom-name-assessment">
        <h4 class="assessment-title-name-bottom">{{$assessment->name}}</h4>
        <span class="assess-status-bottom">{{$assessment->is_open ? 'open' : 'closed'}}
                {{$assessment->is_open ? 'เปิดอยู่' : 'ปิดแล้ว'}}
        </span>
        <p class="assessbottom-summary-sub">
            สร้างโดย: {{ $assessment->created_by_name ?? '-' }} • 
            ปิดรับคำตอบ: {{ $assessment->closed_at?->format('d M Y') ?? '-' }}
        </p>
    </div>
    <script src="{{ asset('admin/js/assessmentrandomreward.js') }}"></script>
</body>
</html>