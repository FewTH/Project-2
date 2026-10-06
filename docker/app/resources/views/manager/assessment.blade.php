<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('manager/css/assessment.css') }}">
    <link rel="icon" href="{{ asset('user/img/Logo.png') }}">
    <title>แบบประเมิน/กิจกรรม</title>
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
        <a href="{{ url('manager/รอเปลี่ยน') }}" class="btn-Home-1">
            <img src="{{ asset('manager/img/รูปปุ่มเมนูจัดการรางวัล.png') }}" alt="รูปปุ่มเมนูจัดการรางวัล" class="btn-Home-img-1">
            <span>จัดการรางวัล</span>
        </a>
        <a href="{{ url('manager/managespin') }}" class="btn-Random-1">
            <img src="{{ asset('manager/img/รูปปุ่มเมนูจัดการวงล้อสุ่ม.png') }}" alt="รูปปุ่มเมนูจัดการวงล้อสุ่ม" class="btn-Random-img-1">
            <span>จัดการวงล้อสุ่ม</span>
        </a>
        <a href="{{ url('manager/assessment') }}" class="btn-Assessment-assess">
            <img src="{{ asset('admin/img/รุปแบบประเมินกิจกรรมสีดำ.png') }}" alt="รูปติดต่อเรา" class="btn-Assessment-img-assess">
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
    
    <!--เอาไว้ควบคุมส่วนกลางของเว็บปิดล่างสุด-->
<div class="main-content">

    <div class="sectionlist">
        <h1>รายการกิจกรรม</h1>
    </div>

    <div class="btn-activity-rate">
        <button class="btn-activity active" id="btn_activity">
            <h3 class="btn-activity-1">รายการกิจกรรม</h3>
            <p class="number-activity active" id="number_activity">4</p>
        </button>
        <button class="btn-rate" id="btn_rate">
            <h3 class="btn-rate-1">แบบประเมิน</h3>
            <p class="number-rate" id="number_rate">{{ $assessments->count() }}</p>
        </button>
    </div>

    <div class="bulb-black">
        <div class="bulb-yellow" id="bulb_yellow"></div>
    </div>

<!--กรอบของรายการกิจกรรม-->
<div class="frame-grey active" id="frame_grey">
    <div class="activity-Closed-Open">
        <div class="all-activities">
            <h1 class="activities-number-assessment" id="activities_number_assessment">3</h1>
            <p class="activities-assessment">กิจกรรมทั้งหมด</p>
        </div>
        <div class="Closed-assessment">
            <h1 class="Closed-assessment-1" id="Closed_assessment_1">2</h1>
            <p class="Closed-assessment-2">ปิดแล้ว</p>
        </div>
        <div class="Open-assessment">
            <h1 class="open-assessment-1" id="open_assessment_1">1</h1>
            <p class="open-assessment-2">เปิดอยู่</p>
        </div>
      
    </div>


    <div class="frame-search-activity-2">
        <div class="frame-search-activity">
            <input type=text class="search-activity" id="frame_search_activity" placeholder="ค้นหารายชื่อกิจกรรม">
        </div>
          <div class="btn-build-activityurgent">
            <a href="{{ url('manager/create_activity') }}" class="btn-build-activityurgent-1"><span class="btn-plus">+</span> สร้างกิจกรรมด่วน</a>
        </div>
    </div>

    <div class="card-Container" id="cardContainer">
        @forelse($events as $event)
        <div class="frame-activity-assessment" data-status="{{ $event->isexpired ? 'closed' : 'open' }}">
            <div class="framecontentactivity">
                <h4 class="headingactivity">{{ $event->title }}</h4>
                <div class="frameclosed">
                    <p class="pointclosed"></p>
                    <span class="closed" >{{ $event->isexpired ? 'ปิด' : 'เปิดอยู่' }}</span>
                </div>
            </div>
            <p class="messagecreationtime">สร้างเมื่อ {{ $event->created_at->format('d M Y') }} · ปิด Register {{ \Carbon\Carbon::parse($event->register_close_at)->format('d M Y') }}</p>
            <hr class="lineactivity-1">
            <div class="maximumnumber_outtime">
                <p class="maximumnumber">ผู้เข้าร่วมสูงสุด {{ $event->max_participants }} คน</p>
                <p class="outtime">หมดเวลา {{ \Carbon\Carbon::parse($event->register_close_at)->format('H.i') }} น.</p>
            </div>
            <div class="framerank-1-2-3">
                @if($event->wheel)
                    @foreach($event->wheel->rewards->take(3) as $reward)
                    <div class="framerank-1-assessment">
                        <p class="rank-1-assessment">{{ $reward->name }}</p>
                    </div>
                    @endforeach
                @endif
            </div>
            <hr class="lineactivity-2">
            <div class="register">
                <p class="register-1">{{ $event->registrations->count() }} คนลงทะเบียนแล้ว</p>
                <div class="view-details">
                    <a href="{{ route('manager.activity.detail', $event->event_id) }}" class="view-details-1">ดูรายละเอียด</a>
                </div>
            </div>
        </div>
        @empty
        <div class="nothaveactivity">
            <p class="nothaveactivity-1">ยังไม่มีกิจกรรมในตอนนี้</p>
        </div>
        @endforelse
    </div>
</div>
    
<!--กรอบของแบบประเมิน-->
<div class="frame-evaluation" id="frame_evaluation">
    <div class="frame-search-activity-1">
        <div class="search-activity-1">
        <input type=text class="search-activity-2" id="frame_search_activity_2" placeholder="ค้นหารายชื่อแบบประเมิน">
        </div>
        <div class="framealloffon-assessment">
            <button class="frameall-assessment active" id="frameall_assessment">
                <p class="all-assessment active" id="all_assessment">ทั้งหมด</p>
                <span class="allnumber-assessment active" id="allnumber_assessment">({{ $assessments->count() }})</span>
            </button>
            <button class="frameoff-assessment" id="frameoff_assessment">
                <p class="off-assessment" id="off_assessment">ปิดแล้ว</p>
                <span class="offnumber-assessment" id="offnumber_assessment">({{ $assessments->where('is_open',0)->count() }})</span>
            </button>
            <button class="farmeon-assessment" id="farmeon_assessment">
                <p class="on-assessment" id="on_assessment">เปิดอยู่</p>
                <span class="onnumber-assessment" id="onnumber_assessment">({{ $assessments->where('is_open',1)->count() }})</span>
            </button>
        </div>
    </div>
    
    <!--กรอบของแบบประเมินที่ดึงมาจาก api-->
    <div class="frame-grey-1">
        @forelse($assessments as $assessment)
        <div class="sectionassessment" 
            data-status="{{ $assessment->is_open ? 'open' : 'closed' }}"
            data-random="{{ $assessment->wheelAssessment ? 'true' : 'false' }}">
        
            <p class="sectionassessment-1">{{ $assessment->name }}</p>

            <div class="frameinformation-assessment">
                <div class="framesection-status">
                    <h3 class="section-assessment">{{$assessment->name}}</h3>
                    <div class="frame-status">
                        <p class="point-status"></p>
                        <p class="message-status">{{$assessment->is_open ? 'เปิดอยู่' : 'ปิดแล้ว'}}</p>
                    </div>
                </div>
                <p class="message-assessment">
                    @if($assessment -> WheelAssessment)
                    รางวัล{{ $assessment -> WheelAssessment->wheel->rewards->pluck('name')->join(' ')}}
                    @else
                        ยังไม่ได้บันทึกวงล้อ
                    @endif
                </p>
                <p class="message-create-by">
                    สร้างโดย: {{$assessment->create_by_name ?? '-'}}
                    ปิดรับคำตอบ: {{$assessment->closed_at ? \Carbon\Carbon::parse($assessment->closed_at)->format('d M Y') : '-'}}
                </p>
                @if($assessment->wheelAssessment)
                {{-- กรณีที่เราบันทึกวงล้อแล้วตัวแบบประเมินจะมีปุ่มเข้าสู่การสุ่มเพิ่มขึ้นมา --}}
                <a href="{{route('manager.assessment.random',$assessment->assessment_id)}}" class="enter-random">
                    <img src="{{asset('admin/img/รูปของปุ่มเข้าสู้การสุ่มรางวัล.png')}}" alt="รูปของการสุ่มแบบประเมิน" class="img-enter-random">
                    <p class="message-enter-random">เข้าสู่การสุ่มรางวัล</p>
                </a>
                <a href="{{ route('manager.history_random', $assessment->assessment_id) }}" class="view-history">
                    <p class="message-view-history">ดูประวัติการสุ่ม</p>
                </a>
                @else
                {{-- ยังไม่ได้ผูกวงล้อจะให้โชวปุ่มไปหน้าสร้างวงล้อ --}}
                <a href="{{url('admin/managespin')}}" class="assessment-open-1">
                    <p class="message-assessment-open">ยังไม่ได้บันทึกวงล้อ คลิกเพื่อสร้าง</p>
                </a>
                @endif
            </div>
        </div>
        @empty
        <div class="nothaveactivity">
            <p class="nothaveactivity-1">ยังไม่มีแบบประเมินในตอนนี้</p>
        </div>
        @endforelse
        {{-- <div class="sectionassessment" data-status="open" data-random="false">
            <p class="sectionassessment-1">แบบประเมิน - BUU Book Fair 2569</p>
            <div class="frameinformation-assessment">
                <div class="framesection-status">
                    <h3 class="section-assessment">แบบประเมิน - BUU Book Fair 2569</h3>
                    <div class="frame-status">
                        <p class="point-status"></p>
                        <p class="message-status">เปิดอยู่</p>
                    </div>
                </div> --}}


                    {{-- <p class="message-assessment">ผู้เข้าร่วมประเมิน 8 คน • รางวัล ดินสอ สมุดโน้ต กระเป๋าดินสอ </p>
                    <p class="message-created-by">สร้างโดย: Admin • ปิดรับคำตอบ: 20 พ.ค. 2569</p>
                        <template id="Viewhistory">
                            <button class="assessment-open-1">
                                <p class="message-assessment-open">แบบประเมินยังเปิดอยู่</p>
                            </button>
                        </template>
                    <template id="Enterrandom">
                        <a href="{{ url('admin/spinwhell') }}" class="enter-random">
                            <img src="{{ asset('admin/img/รูปของปุ่มเข้าสู้การสุ่มรางวัล.png') }}" alt="รูปของปุ่มเข้าสู้การสุ่มรางวัล" class="img-enter-random">
                            <p class="message-enter-random">เข้าสู้การสุ่มรางวัล</p>
                        </a>
                    </template> --}}


                    {{-- <a href="{{ url('admin/history_random') }}" class="view-history">
                        <p class="message-view-history">ดูประวัติการสุ่ม</p>
                    </a> --}}
                {{-- </template>  --}}
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
   

</div>



    <script src="{{ asset('manager/js/assessment.js') }}"></script>

</body>
</html>