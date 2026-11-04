<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('manager/css/assessment.css') }}">
    <link rel="stylesheet" href="{{ asset('manager/css/theme-manager.css') }}">
    <link rel="icon" href="{{ asset('user/img/Logo.png') }}">
    <title>สุ่มรางวัลแบบประเมิน</title>
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
        <a href="{{ url('manager/managereward') }}" class="btn-Home-1">
            <img src="{{ asset('manager/img/รูปปุ่มเมนูจัดการรางวัล.png') }}" alt="รูปปุ่มเมนูจัดการรางวัล" class="btn-Home-img-1">
            <span>จัดการรางวัล</span>
        </a>
        <a href="{{ url('manager/managespin') }}" class="btn-Random-1">
            <img src="{{ asset('manager/img/รูปปุ่มเมนูจัดการวงล้อสุ่ม.png') }}" alt="รูปปุ่มเมนูจัดการวงล้อสุ่ม" class="btn-Random-img-1">
            <span>จัดการวงล้อสุ่ม</span>
        </a>
        <a href="{{ url('manager/assessment') }}" class="btn-Assessment-assess">
            <img src="{{ asset('manager/img/รุปแบบประเมินกิจกรรมสีดำ.png') }}" alt="รูปติดต่อเรา" class="btn-Assessment-img-assess">
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

{{-- --------------------------------------------------------------- --}}
    {{-- กรอบหลักใหญ่ๆที่คอบทุกเนื้อหาไว้ --}}
    <div class="detail-spinwheel">
    {{-- ส่วนรายละเอียดแบบประเมิน(header) --}}
    <div class="random-reward-header">
        <div class="top-name-assessment">
            <h4 class="assessment-title-name">{{$assessment->name}}</h4>
            <span class="assess-status">{{$assessment->is_open ? 'open' : 'closed'}}
                {{$assessment->is_open ? 'เปิดอยู่' : 'ปิดแล้ว'}}
            </span>
        </div>
        <h4 class="assessment-summary-sub">
            วงล้อรางวัล:{{$wheel->rewards->pluck('name')->join(', ')}}
        </h4>
    </div>

    {{-- พื้นหลังของวงล้อทั้งหมด --}}
    {{-- พื้นหลังของแถบสุ่มทั้งหมด --}}
    <div class="all-wheel-background">
    <div class="reel-stack">
 
        {{-- แถบสุ่มรายชื่อของคนที่ทำแบบประเมิน --}}
        <div class="reel-section reel-section--name" id="nameReelSection">
            <div class="background-respondent-header">
                <div class="Logo-topic-respondent">
                    <img src="{{asset('admin/img/รูปของชื่อวงล้อสุ่มรายชื่อ.png')}}" alt="โลโก้ของแถบสุ่มรายชื่อ" width="50" height="50">
                    <p class="text-res-header">สุ่มรายชื่อ</p>
                </div>
                <div class="num-respondent-box">
                    <span class="num-respondent-wheel" id="respondentCount">
                        จำนวนรายชื่อทั้งหมด ({{ $respondents->count() }})
                    </span>
                </div>
            </div>
            {{-- ปุ่มเปิด/ปิดแถบรายชื่อ --}}
            <div class="toggle-main-namebox">
                <label class="toggle-switch">
                    <input type="checkbox" id="toggle-name-wheel" checked>
                    <span class="toggle-slider"></span>
                </label>
                <p class="tog-btn-descript">เปิด/ปิดแถบสุ่ม</p>
            </div>
            {{-- แถบการ์ดรายชื่อ (JS เติมการ์ดให้) --}}
            <div class="reel-viewport" id="nameReel">
                <div class="reel-strip"></div>
                <div class="reel-pointer"></div>
            </div>
        </div>
 
        {{-- แถบสุ่มของรางวัล --}}
        <div class="reel-section reel-section--reward" id="rewardReelSection">
            <div class="text-wheel">
                <div class="logo-topic">
                    <img src="{{ asset('admin/img/รูปของวงล้อสุ่มของรางวัล.png') }}" alt="รูปของแถบสุ่มของรางวัล" class="img-framesmallrandomreward" width="50" height="50">
                    <p class="text-topic">สุ่มของรางวัล</p>
                </div>
                <div class="num-reward-box">
                    <span class="num-reward-wheel" id="rewardCount">
                        จำนวนรางวัลทั้งหมด ({{ $wheel->rewards->sum('pivot.quantity_selected') }})
                    </span>
                </div>
            </div>
            {{-- ปุ่มเปิด/ปิดแถบรางวัล --}}
            <div class="toggle-main-box">
                <label class="toggle-switch">
                    <input type="checkbox" id="toggle-reward-wheel" checked>
                    <span class="toggle-slider"></span>
                </label>
                <p class="tog-btn-descript">เปิด/ปิดแถบสุ่ม</p>
            </div>
            {{-- แถบการ์ดรางวัล (JS เติมการ์ดให้) --}}
            <div class="reel-viewport" id="rewardReel">
                <div class="reel-strip"></div>
                <div class="reel-pointer"></div>
            </div>
        </div>
 
        <div class="btnstartRandomreward">
            <button type="button" class="btn-startRandomreward" id="spinassessmentBtn">
                <img src="{{ asset('admin/img/รูปของปุ่มเรื่มสุ่มรางวัล.png') }}" alt="รูปของปุ่มเริ่มสุ่มรางวัล" class="img-btn-startRandomreward">
                <p class="messagebtn-startRandomreward">สุ่มรางวัล</p>
            </button>
        </div>
 
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
    {{-- <div class="bottom-name-assessment">
        <h4 class="assessment-title-name-bottom">{{$assessment->name}}</h4>
        <span class="assess-status-bottom">{{$assessment->is_open ? 'open' : 'closed'}}
                {{$assessment->is_open ? 'เปิดอยู่' : 'ปิดแล้ว'}}
        </span>
        <p class="assessbottom-summary-sub">
            สร้างโดย: {{ $assessment->created_by_name ?? '-' }} • 
            ปิดรับคำตอบ: {{ $assessment->closed_at?->format('d M Y') ?? '-' }}
        </p>
    </div> --}}
    {{-- ส่วนรายละเอียดแบบประเมิน (Footer) --}}
<div class="assessment-footer-container">
    {{-- แสดงผู้โชคดีคนล่าสุด --}}
    <div class="footer-winner-card">
        <div class="footer-winner-header">
            <div class="footer-winner-title-wrapper">
                <img src="{{ asset('admin/img/รูปของหัวข้อผู้โชคดีล่าสุด.png') }}" alt="ไอคอนผู้โชคดี" width="45" height="45">
                <p class="footer-winner-title">ผู้โชคดี 3 คนล่าสุด</p>
            </div>
        </div>

        {{-- เส้นแบ่งด้านล่างหัวข้อ --}}
        <hr class="footer-winner-divider">

        {{-- ส่วนกล่องแสดงรายชื่อผู้โชคดี --}}
        <div id="recentWinnersList" class="footer-winner-list">
            <p class="footer-no-winner">ยังไม่มีผู้โชคดี</p> 
        </div>
    </div>

    {{-- บ็อกหลักแสดงอัตรารางวัล --}}
    <div class="footer-probability-card">
        <div class="footer-probability-header">
            <div class="footer-probability-title-wrapper">
                <img src="{{ asset('admin/img/รูปของโอกาสออกของรางวัล.png') }}" alt="ไอคอนโอกาสรางวัล" width="45" height="45">
                <p class="footer-probability-title">โอกาสออกของรางวัล</p>
            </div>
        </div>

        {{-- เส้นแบ่งด้านล่างหัวข้อ --}}
        <hr class="footer-winner-divider">

        <div id="rewardProbabilityList" class="footer-probability-list">
            {{-- แสดงผ่านตัว JS --}}
        </div>
    </div>
    </div>
    </div>
{{-- -------------------------------------------------------------------------- --}}
    @php
        $rewardWheelDataArr = $wheel->rewards
            ->filter(fn($r) => $r->pivot->quantity_selected > 0)
            ->map(function($r){
            return [
                'id' => $r->reward_id,
                'label' => $r->name,
                'rate' => $r->rate,
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
        window.spinUrl = "{{ route('manager.assessment.spin', $assessment->assessment_id) }}";
    </script>
    <script src="{{ asset('admin/js/assessmentrandomreward.js') }}"></script>
</body>
</html>