<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    {{-- ส่วนรายละเอียดแบบประเมิน(header) --}}
    <div class="random-reward-header">
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

    {{-- พื้นหลังของวงล้อทั้งหมด --}}
    <div class="all-wheel-background">

    {{-- ส่วนวงล้อรายชื่อของคนที่ทำแบบประเมิน --}}
    <div class="respondent-box">
        <div class="background-respondent-header">
            <div class="logo-topic-respondent">
                <img src="{{asset('admin/img/รูปของชื่อวงล้อสุ่มรายชื่อ.png')}}" alt="โลโก้ของวงล้อรายชื่อ" width="50" height="50">
                <p class="text-res-header">วงล้อสุ่มรายชื่อ</p>
            </div>
            <div class="num-respondent-box">
                <span class="num-respondent-wheel">
                    จำนวนรายชื่อทั้งหมด ({{ $respondents->count() }})
                </span>
            </div>
        </div>
        {{-- ส่วนของปุ่มเปิด/ปิดวงล้อรายชื่อ --}}
        <div class="toggle-main-namebox">
            <label class="toggle-switch">
                <input type="checkbox" id="toggle-name-wheel" checked>
                <span class="toggle-slider"></span>
            </label>
            <p class="tog-btn-descript">เปิด/ปิดวงล้อ</p>
        </div>
        {{-- แสดงวงล้อรายชื่อของผูัที่ทำแบบประเมิน --}}
        <div class="respondent-main-wheel">
            <canvas id="wheelNameCanvas" width="500" height="500"></canvas>
            <div class="respondent-wheel-pointer"></div>
        </div>
    </div>


        {{-- ส่วนวงล้อรางวัล --}}
    <div class="wheel-reward-box">
        <div class="text-wheel">
            <div class="logo-topic">
                <img src="{{ asset('admin/img/รูปของวงล้อสุ่มของรางวัล.png') }}" alt="รูปของวงล้อสุ่มของรางวัล" class="img-framesmallrandomreward" width="50" height="50">
                <p class="text-topic">วงล้อสุ่มของรางวัล</p>
            </div>
            <div class="num-reward-box">
                <span class="num-reward-wheel">
                    จำนวนรางวัลทั้งหมด ({{ $wheel->rewards->sum('pivot.quantity_selected') }})
                </span>
            </div>
        </div>
        {{-- แสดงวงล้อที่ผูกกับแบบประเมิน --}}
        <div class="toggle-main-box">
            <label class="toggle-switch">
                <input type="checkbox" id="toggle-reward-wheel" checked>
                <span class="toggle-slider"></span>
            </label>
            <p class="tog-btn-descript">เปิด/ปิดวงล้อ</p>
        </div>
        <div class="wheel-assessment-rewards">
            <canvas id="wheelrewardCanvas" width="500" height="500"></canvas>
            <div class="wheel-pointer"></div>
        </div>
    </div>
    <div class="btnstartRandomreward">
        <button type="button" class="btn-startRandomreward" id="spinassessmentBtn">
            <img src="{{ asset('admin/img/รูปของปุ่มเรื่มสุ่มรางวัล.png') }}" alt="รูปของปุ่มเรื่มสุ่มรางวัล" class="img-btn-startRandomreward">
            <p class="messagebtn-startRandomreward">สุ่มรางวัล</p>
        </button>
    </div>
    </div>
    {{-- ส่วนของpopup ตอนที่สุ่มได้รางวัลแล้วจะโชว์ขึ้นมา --}}
    <div class="spin-result-popup" id="spinResultPopup" style="display: none;">
        <div class="spin-result-box">
            <h2 class="text-congrat">ยินดีด้วย!!</h2>
            <p class="spin-result-name" id="spinResultName"></p>
            <p>ได้รับรางวัล: <span id="spinResultReward" style="color:#ec4899; font-weight:bold;"></span></p>
            <button type="button" class="congrat-btn" id="closeSpinResultBTN">ตกลง</button>
        </div>
    </div>

    {{-- ส่วนรายละเอียดแบบประเมิน(Footer) --}}
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

    {{-- ปุ่มเมนู --}}
    <div class="container-assessment">
        <!-- โลโกมหาลัย -->
        <div class="img-Logo">
            <img src="{{ asset('admin/img/Logo.png') }}" alt="รูปโลโกมหาลัย" class="Logo-img">
    </div>
    <!-- ปุ่มเมนู -->
    <div class="btn-Sidebar-assessment">
        <a href="{{ url('admin/dashboard') }}" class="btn-Dashboard-assessment">
            <img src="{{ asset('admin/img/แดชบอร์ด.png') }}" alt="รูปแดชบอร์ด" class="btn-Dashboard-img-assessment">
            <span>แดชบอร์ด</span>
        </a>
        <a href="{{ url('admin/managereward') }}" class="btn-Manage_Rewards-assess">
            <img src="{{ asset('admin/img/รูปจัดการรางวัล.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Manage_Rewards-img-assess">
            <span>จัดการรางวัล</span>
        </a>
        <a href="{{ url('admin/manageuser') }}" class="btn-Manage_users">
            <img src="{{ asset('admin/img/รูปจัดการผู้ใช้.png') }}" alt="รูปติดต่อเรา" class="btn-Manage_users-img">
            <span>จัดการผู้ใช้</span>
        </a>
        <a href="{{ url('admin/managespin') }}" class="btn-Managewheel">
            <img src="{{ asset('admin/img/รูปจัดการวงล้อสุ่ม.png') }}" alt="รูปติดต่อเรา" class="btn-Managewheel-img">
            <span>จัดการวงล้อสุ่ม</span>
        </a>
        <a href="{{ url('admin/assessment') }}" class="btn-Assessment-assess">
            <img src="{{ asset('admin/img/รุปแบบประเมินกิจกรรมสีดำ.png') }}" alt="รูปติดต่อเรา" class="btn-Assessment-img-assess">
            <span>แบบประเมิน/กิจกรรม</span>
        </a>
    </div>
    <!-- ปุ่มกดออกจากระบบ -->
    <div class="btn-logout-wrapper">
        <a href="{{ url('user/loginuser') }}" class="btn-logout">
            <img src="{{ asset('admin/img/รูปปุ่มกดออก.png') }}" alt="รูปออกจากระบบ" class="btn-logout-img">
            <span>ออกจากระบบ</span>
        </a>
    </div>
    </div> 

    @php
        $rewardWheelDataArr = $wheel->rewards
            ->filter(fn($r) => $r->pivot->quantity_selected > 0)
            ->map(function($r){
            return [
                'id' => $r->reward_id,
                'label' => $r->name,
                'weight' => $r->rate*$r->pivot->quantity_selected,
                'quantity' => $r->pivot->quantity_selected,
            ];
        })->values();
        $nameWheelDataArr = $respondents->map(function ($r){
            return [
                'id' => $r->respondent_id,
                'label' => $r->full_name,
            ];
        });
    @endphp
    <script>
        window.rewardWheelData = @json($rewardWheelDataArr);
        window.nameWheelData = @json($nameWheelDataArr);
        window.assessmentId = {{ $assessment->assessment_id }};
    </script>
    <script src="{{ asset('admin/js/assessmentrandomreward.js') }}"></script>
</body>
</html>