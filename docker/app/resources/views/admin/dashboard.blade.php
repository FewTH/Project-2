    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>แดชบอร์ด</title>
        <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
        <link rel="icon" href="{{ asset('admin/img/Logo.png') }}">
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
    <!--กรอบของเมนูปิดแท็กตรงออกจากระบบ-->
    <div class="container">
        <!-- โลโกมหาลัย -->
        <div class="img-Logo-dashboard">
            <img src="{{ asset('admin/img/Logo.png') }}" alt="รูปโลโกมหาลัย" class="Logo-img-dashboard">
        </div>
    <!-- ปุ่มเมนู -->
    <div class="btn-Sidebar-dashboard">
        <a href="{{ url('admin/dashboard') }}" class="btn-Dashboard-01">
            <img src="{{ asset('admin/img/แดชบอร์ดสีดำ.png') }}" alt="รูปแดชบอร์ด" class="btn-Dashboard-img-01">
            <span>แดชบอร์ด</span>
        </a>
        <a href="{{ url('admin/managereward') }}" class="btn-Manage_Rewards-01">
            <img src="{{ asset('admin/img/รูปจัดการรางวัล.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Manage_Rewards-img-01">
            <span>จัดการรางวัล</span>
        </a>    
        <a href="{{ url('admin/manageuser') }}" class="btn-Manage_users-01">
            <img src="{{ asset('admin/img/รูปจัดการผู้ใช้.png') }}" alt="รูปติดต่อเรา" class="btn-Manage_users-img-01">
            <span>จัดการผู้ใช้</span>
        </a>
        <a href="{{ url('admin/managespin') }}" class="btn-Managewheel-01">
            <img src="{{ asset('admin/img/รูปจัดการวงล้อสุ่ม.png') }}" alt="รูปติดต่อเรา" class="btn-Managewheel-img-01">
            <span>จัดการวงล้อสุ่ม</span>
        </a>
        <a href="{{ url('admin/assessment') }}" class="btn-Assessment-01">
            <img src="{{ asset('admin/img/รูปแบบประเมินกิจกรรม.png') }}" alt="รูปติดต่อเรา" class="btn-Assessment-img-01">
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
    <!--เอาไว้ควบคุมส่วนกลางของเว็บปิดล่างสุด-->
    <div class="main-content">
    <!--กรอบแดชบอร์ด-->
    <div class="framedashboard">
        <!--ชื่อแดชบอร์ดภาพรวม-->  
        <div class="Overview_Dashboard">
            <h1>แดชบอร์ดภาพรวม</h1>
        </div>
    <!--ปุ่มกดวัน สัปดาห์ เดือน -->
    @php
    $range = request('range', 'day'); // ถ้าไม่มีค่า ให้เป็น day
    @endphp
    <div class="ButtonDate">
        <button type="button" class="btn-date {{ $range === 'day' ? 'active' : '' }}" id="button-day">วัน</button>
        <button type="button" class="btn-date {{ $range === 'week' ? 'active' : '' }}" id="button-week">สัปดาห์</button>
        <button type="button" class="btn-date {{ $range === 'month' ? 'active' : '' }}" id="button-month">เดือน</button>
    </div>
    </div>
    <div id="dashboard_error" class="dashboard-error">
        <div class="dashboard-error-1">
            <img src="{{ asset('admin/img/รูปerror หน้าแดชบอร์ด.png') }}" alt="รูปerrorหน้าแดชบอร์ด" class="img-dashboard-error">
            <div class="cannotDownload-1">
            <p class="cannotDownload">โหลดข้อมูลไม่สำเร็จ</p>
            <p class="cannotDownloadDashboard">ไม่สามารถโหลดข้อมูลแดชบอร์ดได้ กรุณาลองใหม่อีกครั้ง</p>
            </div>
            <button class="but-cannotDownload" id="but_cannotDownload">
                <img src="{{ asset('admin/img/รูปปุ่มรีโหลดหน้าแดชบอร์ด.png') }}" alt="รูปปุ่มรีโหลดหน้าแดชบอร์ด" class="img-but-cannotDownload">
                <span class="but-cannotDownload-1">ลองใหม่<span>
            </button>
        </div>
    </div>

    <!--กรอบรวมของผู้ใช้ ทำแบบประเมิน สุ่ม รอรับของขวัญ-->
    <div class="alluser_frames-1">
        <!--กรอบผู้ใช้งานทั้งหมด-->
        <div class="alluser_frames">
            <!--ผู้ใช้งานทั้งหมด-->
            <div class="All_users">
                <h4>ผู้ใช้ทั้งหมด</h4>
            </div>
            <!--ตัวเลขบอกจำนวนคน-->
            <div class="Userfigures">
                <h2 id="user_figures">{{ $totalusers }}</h2>
            </div>
            <!--ตัวเลขบอกว่าเพิ่มกี่คนในวันนี้-->
            <div class="Addnumbers_users">
                <p id="add_numbers_users"> + {{ $newusers }} {{ $newtext }}</p>
            </div>
        </div>

        <!--กรอบการทำแบบประเมิน-->
        <div class="assessmentframe">
            <!--ทำแบบประเมินแล้ว-->
            <div class="frame">
                <h4>ทำแบบประเมินแล้ว</h4>
            </div>
            <!--ตัวเลขบอกจำนวนแบบประเมินที่ทำแล้ว-->
            <div class="Numberframe">
                <h2 id="number_frame">{{ $totalassessed }}</h2>
            </div>
            <!--ตัวเลขบอกว่าเพิ่มกี่คนในวันนี้-->
            <div class="Addnumbers">
                <p id="add_numbers">+ {{ $assessedtoday }} {{ $newtext }}</p>
            </div>
        </div>

        <!--กรอบสุ่มทั้งหมด-->
        <div class="randomall">
            <!--สุ่มทั้งหมด-->
            <div class="Random_all">
                <h4>สุ่มทั้งหมด</h4>
            </div>
            <!--ตัวเลขสุ่ม-->
            <div class="numberrandom">
                <h2 id="Number_random">{{ $totalspin }}</h2>
            </div>
            <!--ตัวเลขบอกการสุ่มเมื่อวานก่อน-->
            <div class="numberotherday">
                <p id="number_other_day">สุ่ม{{ $thistext }} {{ $spinthis }} ครั้ง</p>
            </div>
        </div>

        <!--กรอบรอรับของขวัญ-->
        <div class="framewaitreceiveaward">
            <!--รอรับของขวัญ-->
            <div class="waitreceiveaward">
                <h4>กิจกรรมที่เปิดอยู่</h4>
            </div>
            <!--ตัวเลขรับของขวัญ-->
            <div class="numberaward">
                <h2 id="Number_award">{{ $openevents }}</h2>
            </div>
            <!--ต้องติดตามของขวัญที่ยังไม่ได้รับ-->
            <div class="followaward" id="followaward_box">
                <p id="Follow_award">+ {{ $newevents }} สร้างใหม่ในช่วงนี้</p>
            </div>
        </div>
         <div class="framewaitreceiveaward">
            <!--รอรับของขวัญ-->
            <div class="waitreceiveaward">
                <h4>แบบประเมินที่เปิดอยู่</h4>
            </div>
            <!--ตัวเลขรับของขวัญ-->
            <div class="numberaward">
                <h2 id="Number_award">{{ $openassess }}</h2>
            </div>
            <!--ต้องติดตามของขวัญที่ยังไม่ได้รับ-->
            <div class="followaward" id="followaward_box">
                <p id="Follow_award">+ {{ $newassess }} เพิ่มใหม่ในช่วงนี้</p>
            </div>
        </div>
    </div>
    <!--ชิ่อหัวข้อสุ่มรายวัน-->
    <div class="chart-wrap">
        <!--ชิ่อหัวข้อสุ่มรายวัน-->
        <div class="sectionrandom">
            <h2 id="sectionrandom-1">{{ $charttitle }}</h2>
        </div>
         <div class="graph-box">
            <canvas id="graph"></canvas>
        </div>
    </div>
    <!--กรอบของขวัญยอดนิยมปิดแท็บตรงแบตสำรอง-->
    <div class="framesmost_popular">
        <div class="most_popular-1">
            <div class="most_popular">
                <h2>ของขวัญยอดนิยม</h2>
            </div>
            <div class="randomall-100">
                <p>จากการสุ่มทั้งหมด <span id="randomall100">{{ $totalspin }}</span> ครั้ง</p>
            </div>
        </div>
    @if(isset($popular[0]))
    <!--กรอบของดินสอทั้งหมด-->
    <div class="framepancil" id="rank1"> 
            <div class="pencil">
                <span class="pencil1">{{ $popular[0]['name'] }}</span>
                <div class="timeallpancil">
                    <span>{{ $popular[0]['times'] }} ครั้ง </span>
                    <span> · </span>
                    <span>{{ $popular[0]['setting'] }} % ตั้งค่า</span>
                </div>
            </div>
    <div class="black-frame-pencil-1">
        <div class="black-frame-pencil">
            <div class="frame-pencil" style="width: {{ $popular[0]['percent'] }}%"></div>
        </div>
        <div class="Percent-1">
            <p>{{ $popular[0]['percent'] }}%</p>
            </div>
        </div>  
    </div>
        <!--เส้นสีดำปิดท้าย-->
        <hr class="blackline-1">
    @endif

    @if(isset($popular[1]))
    <!--กรอบของสมุดทั้งหมด-->
    <div class="framenotebook" id="rank2">
        <div class="pencil">
            <span class="pencil1">{{ $popular[1]['name'] }}</span>
            <div class="timeallpancil">
                <span>{{ $popular[1]['times'] }} ครั้ง </span>
                <span> · </span>
                <span>{{ $popular[1]['setting'] }} % ตั้งค่า</span>
            </div>
        </div>
    <div class="black-frame-pencil-1">
        <div class="black-frame-pencil">
            <div class="frame-notebook" style="width: {{ $popular[1]['percent'] }}%"></div>
        </div>
        <div class="Percent-2">
            <p>{{ $popular[1]['percent'] }}%</p>
        </div>
        </div>
    </div>
        <!--เส้นสีดำปิดท้าย-->
        <hr class="blackline-2">
    @endif

    @if(isset($popular[2]))
    <!--กรอบของหนังสือทั้งหมด-->
    <div class="framebook" id="rank3">
        <div class="pencil">
            <span class="pencil1">{{ $popular[2]['name'] }}</span>
            <div class="timeallpancil">
                <span>{{ $popular[2]['times'] }} ครั้ง </span>
                <span> · </span>
                <span>{{ $popular[2]['setting'] }} % ตั้งค่า</span>
            </div>
        </div>
    <div class="black-frame-book-1">
        <div class="black-frame-book">
            <div class="frame-book" style="width: {{ $popular[2]['percent'] }}%"></div>
        </div>
        <div class="Percent-3">
            <p>{{ $popular[2]['percent'] }}%</p>
        </div>
        </div>
    </div>
        <hr class="blackline-3">
    @endif

    @if(isset($popular[3]))
    <!--กรอบของแบตสำรองทั้งหมด-->
    <div class="framebook" id="rank4">
        <div class="pencil">
            <span class="pencil1">{{ $popular[3]['name'] }}</span>
            <div class="timeallpancil">
                <span>{{ $popular[3]['times'] }} ครั้ง </span>
                <span> · </span>
                <span>{{ $popular[3]['setting'] }} % ตั้งค่า</span>
            </div>
        </div>
    <div class="black-frame-book-1">
        <div class="black-frame-book">
            <div class="frame-powerbank" style="width: {{ $popular[3]['percent'] }}%"></div>
        </div>
        <div class="Percent-3">
            <p>{{ $popular[3]['percent'] }}%</p>
            </div>
        </div>
    </div>
    @endif
    </div>

    <!--กรอบของสถานะQRCodeปิดแท็กล่างสุด-->
    <div class="framestatusQRCode">
        <div class="statusQRCode">
            <h2>สรุปสถานะ QR code</h2>
        </div>
    <div class="framenumberreceived">
        <div class="numberreceived">
            <h1  class="number_received-1" id="number_received">{{ $received }}</h1>
            <p class="letterreceived">รับแล้ว</p>
        </div>
        <hr class="blackline-6">
        <div class="numberwaitreceive">
            <h1 class="numberwait_receive-1" id="numberwait_receive">{{ $notreceived }}</h1>
            <p class="letterwaitreceive">รอรับ</p>
        </div>
        <hr class="blackline-7">
        <div class="numberall">
            <h1 class="number_all-1" id="number_all">{{ $qrtotal }}</h1>
            <p class="letterall">ทั้งหมด</p>
        </div>
    </div>    
    <div class="frameratereceiveaward">
        <div class="ratereceiveaward">
            <p>อัตราการรับของขวัญ</p>
        </div>
        <div class="black-frame-award">
            <div class="green-frame-award" id="green_frame_award1" style="width: {{ $receivedpercent }}%"></div>
        </div>
        <div class="percentreceived">
            <p><span id="percent_received" class="bold-text">{{ $receivedpercent }}%</span> <span class="bold-text">รับแล้ว</span> <span class="point-5"> · </span> <span class="left"> เหลือ </span> <span class="numberlist" id="left_list1">{{ $notreceived }}</span> <span class="list"> รายการ </span></p>
        </div>
    </div>
        <hr class="blackline-5">
    <div class="randomtoday-1">
        <div class="randomtoday">
            <p>การสุ่ม{{ $thistext }}</p>
        </div>
        <div class="fromyesterday" id="from_yesterday">
            <h4 class="from_yesterday-1" id="from_yesterday1">{{ number_format($spinthis) }} ครั้ง</h4>
        </div>
        </div>
    </div>
    </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    const chartLabels = @json($labels);
    const chartValues = @json($values);
    const chartRange = @json($range);
</script>
<script src="{{ asset('admin/js/JavaScriptAdmin.js') }}"></script>
    </body>
    </html>