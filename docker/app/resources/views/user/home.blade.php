<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <title>BUUGIFT</title>
</head>
<body class="Bodyhome">
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
    <!-- titlename -->
    <div class="justtext">
        <h1>หน้าหลัก</h1>
    </div>
    <!-- รูปของรางวัลยอดนิยม -->
    <div class="justbackground">
        <h2 class="subtitle">ของรางวัลยอดนิยม</h2>
        <div class="popular-reward">
            @forelse($popularRewards as $index => $reward)
                <div class="picre{{ $index + 1 }}">
                    {{-- เปลี่ยนจาก reward_name เป็น name ตามตารางจริง --}}
                    <h3 class="textre{{ $index + 1 }}">{{ $reward->name }}</h3>
                </div>
            @empty
                <div style="text-align: center; width: 100%; color: #666; padding: 20px;">ยังไม่มีข้อมูลของรางวัล</div>
            @endforelse
        </div>
    </div>
    <!-- แบบประเมินที่ทำแล้ว -->
    <div class="content-row">
        <div class="test-box1">
            <div class="header-background-recive">
                <h3 class="text-test1">แบบประเมินที่ทำล่าสุด</h3>
            </div>
            <div class="test-list">
                @forelse($latestAssessments as $item)
                    <div class="tested1">
                        <div class="test-date1">
                            {{-- แสดงหมายเลขลำดับ --}}
                            <span>{{ $loop->iteration }}</span>
                        </div>    
                        
                        <h5 class="name-test1">{{ $item->name }}</h5>
                        
                        <div class="sts-spned">
                            <span>สุ่มแล้ว</span>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 15px; color: #666;">ยังไม่มีประวัติการทำแบบประเมิน</div>
                @endforelse
            </div>
        </div>

        <!-- ของรางวัลที่เคยได้กรอบหลัก -->
        <div class="recived-reward">
            <div class="header-background-recive">
                <h3 class="title-recive">ของรางวัลที่เคยได้รับ</h3>
            </div>
            <div class="recived-reward-list">
                @forelse($winReward as $item)
                <div class="show-recive-reward">
                    <span class="recivere-name1">{{ $item->reward->name ?? 'ของรางวัล' }}</span>
                    <span class="recivere-date1">ได้รับเมื่อ: {{ $item->created_at ? $item->created_at->format('d/m/Y') : '-'}}</span>
                </div>
                @empty
                    <div class="no-reward-recive" style="text-align: center; padding: 15px; color: #666;">ท่านยังไม่เคยได้รับรางวัล</div>
                @endforelse
            </div>
        </div> 
    </div>

    <div class="container-home">
    <!-- โลโกมหาลัย -->
    <div class="img-Logo-home">
        <img src="img/Logo.png" alt="รูปโลโกมหาลัย" class="Logo-img">
    </div>
    <!-- ปุ่มเมนู -->
    <div class="btn-Sidebar-home">
        <a href="{{ url('user/home') }}" class="btn-Home1">
            <img src="{{ asset('user/img/homelogo1.png') }}" alt="รูปบ้าน" class="btn-homelogo-img1">
            <span>หน้าหลัก</span>
        </a>

        <a href="{{ url('user/spin') }}" class="btn-Random1">
            <img src="{{ asset('user/img/Random.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Random-img">
            <span>สุ่มของรางวัล</span>
        </a>

        <a href="{{ url('user/contact') }}" class="btn-Contact-1">
            <img src="{{ asset('user/img/Contact.png') }}" alt="รูปติดต่อเรา" class="btn-Contact-img-1">
            <span>ติดต่อเรา</span>
        </a>
    </div>
    <!-- ปุ่มกดออกจากระบบ -->
    <div class="btn-logout-wrapper1">
        <a href="{{ url('user/loginuser') }}" class="btn-logout1">
            <img src="img/รูปปุ่มกดออก.png" alt="รูปออกจากระบบ" class="btn-logout-img1">
            <span>ออกจากระบบ </span>
        </a>
    </div>
    </div>
</body>
</html>