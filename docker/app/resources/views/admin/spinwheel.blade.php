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
    {{-- กรอบหลักใหญ่ๆที่คอบทุกเนื้อหาไว้ --}}
    <div class="detail-spinwheel">
    {{-- ส่วนรายละเอียดแบบประเมิน(header) --}}
    <div class="random-reward-header">
        <div class="top-name-assessment">
            <h2 class="assessment-title-name">{{$assessment->name}}</h2>
            <span class="assess-status">{{$assessment->is_open ? 'open' : 'closed'}}
                {{$assessment->is_open ? 'เปิดอยู่' : 'ปิดแล้ว'}}
            </span>
        </div>
        <h4 class="assessment-summary-sub">
            วงล้อรางวัล: {{$wheel->rewards->pluck('name')->join(', ')}}
        </h4>
    </div>

    {{-- พื้นหลังของวงล้อทั้งหมด --}}
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
        window.recentWinners = @json($recentWinners ?? []);
        window.spinUrl = "{{ route('admin.assessment.spin', $assessment->assessment_id) }}";
    </script>
    <script src="{{ asset('admin/js/assessmentrandomreward.js') }}"></script>
</body>
</html>