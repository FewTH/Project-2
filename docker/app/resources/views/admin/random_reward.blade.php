    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>สุ่มของรางวัล</title>
        <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
        <link rel="icon" href="{{ asset('admin/img/Logo.png') }}">
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
    </div>
    <!--กรอบของเมนูปิดแท็กตรงออกจากระบบ-->
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

    <div class="main-content-1">
        <div class="My_Profile">
            <h1>ศูนย์กลางสุ่มรางวัล</h1>
        </div>


            <div class="framebigofWheel">
                <!--วงล้อสุ่มรายชื่อ-->
                <div class="framesmallnameofwheel" id="framesmall_nameofwheel">
                    <div class="framewheelname-quantityname">
                        <img src="{{ asset('admin/img/รูปของชื่อวงล้อสุ่มรายชื่อ.png') }}" alt="รูปลองชื่อวงล้อสุ่มรายชื่อ" class="img-framewheelname-quantityname">
                        <p class="messageframewheelname">วงล้อสุ่มรายชื่อ</p>
                        <div class="messagequantityname-1">
                            <span class="messagequantityname">จำนวนของรายชื่อ {{ $event->registrations->count() }} รายการ</span>
                        </div>
                    </div>

                    <div class="on-offlistnamesRandom">
                        <label class="on-offlistnamesRandom-1">
                            <input type="checkbox" class="btn-on-offlistnamesRandom" id="btn_on_offlistnamesRandom" checked>
                            <span class="on-offlistnamesRandom-2"></span>
                        </label>
                        <p class="messagebtn-on-offlistnamesRandom">ปิด/เปิดสุ่มรายชื่อ</p>
                    </div>

                    <div class="namecanvas">
                        <div class="namecanvas-1"></div>
                        <canvas id="name_canvas" width="500" height="500"></canvas>
                    </div>
                </div>

                <!--วงล้อสุ่มของรางวัล-->
                <div class="framesmallrandomreward" id="framesmall_randomreward">
                    <div class="framemessagerandomreward">
                        <img src="{{ asset('admin/img/รูปของวงล้อสุ่มของรางวัล.png') }}" alt="รูปของวงล้อสุ่มของรางวัล" class="img-framesmallrandomreward">
                        <p class="messagerandomreward">วงล้อสุ่มของรางวัล</p>
                        <div class="messagequantityrandomreward-1">
                            <span class="messagequantityrandomreward">จำนวนของรายชื่อ {{ $event->wheel->rewards->count() }} รายการ</span>
                        </div>
                    </div>

                    <div class="on-offlistnamesRandom">
                        <label class="on-offlistnamesRandom-1">
                            <input type="checkbox" class="btn-on-offlistnamesRandom" id="btn_no_offrandomreward" checked>
                            <span class="on-offlistnamesRandom-2"></span>
                        </label>
                        <p class="messagebtn-no-offrandomreward">ปิด/เปิดสุ่มของรางวัล</p>
                    </div>

                    <div class="rewardcanvas">
                        <div class="rewardcanvas-1"></div>
                        <canvas id="reward_canvas" width="500" height="500"></canvas>
                    </div>
                </div>

                <div class="btnstartRandomreward">
                    <button type="button" class="btn-startRandomreward" id="btn_startRandomreward">
                        <img src="{{ asset('admin/img/รูปของปุ่มเรื่มสุ่มรางวัล.png') }}" alt="รูปของปุ่มเรื่มสุ่มรางวัล" class="img-btn-startRandomreward">
                        <p class="messagebtn-startRandomreward">สุ่มรางวัล</p>
                    </button>
                </div>
            </div>

            <dialog class="popupluckywinner-10" id="popup_luckywinner">
                <div class="framepopupluckywinner">
                    <img src="{{ asset('admin/img/รูปของหัวข้อpopupผู้โชคดีได้รับรางวัล.png') }}" alt="รูปของหัวข้อpopupผู้โชคดีได้รับรางวัล" class="img-popupluckywinner">
                    <p class="message-popupluckywinner">ผู้โชคดีได้รับรางวัล</p>
                </div>

                <div class="frameimg-userpopupluckywinner">
                    <img src="{{ asset('admin/img/รูปuserของpopupผู้โชคดีได้รับรางวัล.png') }}" alt="รูปuserของpopupผู้โชคดีได้รับรางวัล" class="img-userpopupluckywinner">
                    <span class="messageuserpopupluckywinner">ผู้ที่ได้รับรางวัล</span>
                    <span class="messageuserpopupluckywinner-1" id="messageuser_popupluckywinner_1">น.ส.ฟ้าใส ดีงาม</span>
                </div>
                <div class="linemessageuserpopupluckywinner"> 
                    <hr class="linemessageuserpopupluckywinner-1">
                </div>
            <div class="frameprizes-1">
                <div class="frameprizes">   
                    <div class="frameimgprizes">
                        <img src="{{ asset('admin/img/รูปของขวัญของpopupผู้โชคดีได้รับรางวัล.png') }}" alt="รูปของขวัญของpopupผู้โชคดีได้รับรางวัล" class="img-prizes">
                    </div>
                    <span class="messagerewardreceived-1">รางวัลที่ได้รับ</span>
                    <div class="messagerewardreceived">
                        <span class="messagerewardreceived-2" id="message_rewardreceived_2">ยางลบ</span>
                    </div>
                </div>
            </div>
                <div class="framebtn-offpopupluckywinner">
                    <button type="button" class="offpopupluckywinner" id="off-popupluckywinner">
                        <p class="messageoffpopupluckywinner">ปิด</p>
                    </button>
                </div>
            </dialog>
            

        <div class="frameluckywinner">
            <div class="framesectionluckywinner">
                <div class="sectionluckywinner">
                <img src="{{ asset('admin/img/รูปของหัวข้อผู้โชคดีล่าสุด.png') }}" alt="รูปของหัวข้อผู้โชคดีล่าสุด" class="img-sectionluckywinner">
                <p class="messagesectionluckywinner">ผู้โชคดีล่าสุด 6 คน</p>
                </div>

                <hr class="linesectionluckywinner">
                
                @forelse($latestwinners as $index => $winner)
                <div class="framenameluckywinner">
                    <div class="framenumberluckywinner">
                        <p class="framenumberluckywinner-1">{{ $index + 1 }}</p>
                    </div>
                    <p class="nameluckywinner">{{ $winner->full_name }}</p>
                    <div class="framePrizes">
                        <p class="rawardname">{{ $winner->reward->name ?? '-' }}</p>
                    </div>
                </div>

                    @empty
                        <p class="warnnothaveluckywinner">ยังไม่มีผู้โชคดี</p>
                    @endforelse
        </div>

            <div class="framechanceleavereward">
                <div class="sectionchanceleavereward">
                    <img src="{{ asset('admin/img/รูปของโอกาสออกของรางวัล.png') }}" alt="รูปของโอกาสออกของรางวัล" class="img-sectionchanceleavereward">
                    <p class="messagesectionchanceleavereward">โอกาสออกของรางวัล</p>
                </div>
                <hr class="linesectionluckywinner-1">
                @foreach($event->wheel->rewards as $reward)
                <div class="framenameprizes">
                    <div class="pointnameprefixreward"></div>
                    <p class="messagenameprizes">{{ $reward->name }}</p>
                    <div class="percentnameprizes-1">
                        <span class="percentnameprizes">{{ number_format($reward->rate , 1) }}%</span>
                    </div>
                </div>
                <hr class="linesectionluckywinner-1">
                @endforeach
            </div>
        </div>


    
    </div>
@if($event->wheel)
<script>
    const eventId = {{ $event->event_id }};
    const nameData = @json($nameData);
    const rewardData = @json($rewardData);
</script>
@endif
    <script src="{{ asset('admin/js/JavaScriptAdmin.js') }}"></script>
    </body>
    </html>