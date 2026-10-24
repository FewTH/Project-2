<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการสุ่ม</title>
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="icon" href="{{ asset('user/img/Logo.png') }}">
</head>
<body>
    <!-- ชื่อผู้ใช้งาน -->
<div class="btn-user-wrapper-1">
    <a href="{{ url('user/profile') }}" class="btn-user">
        @if($user?->profile_image)
        <img src="{{ asset('storage/'.$user->profile_image) }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @else
        <img src="{{ asset('user/img/รูปuser.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @endif
        <span>User</span>
   </a>
</div>
<!--กล่องครอบเมนูปิดแท็กตรงปุ่มออกจากระบบ-->
<div class="Top_frame">
    <div class="container-profile">
    <!-- โลโกมหาลัย -->
   <div class="img-Logo">
        <img src="{{ asset('admin/img/Logo.png') }}" alt="รูปโลโกมหาลัย" class="Logo-img">
   </div>
   <!-- ปุ่มเมนู -->
   <div class="btn-Sidebar-profile">
        <a href="{{ url('user/home') }}" class="btn-Home4">
            <img src="{{ asset('user/img/Home.png') }}" alt="รูปบ้าน" class="btn-Home-img4">
            <span>หน้าหลัก</span>
        </a>
        <a href="{{ url('user/spin') }}" class="btn-Random2">
            <img src="{{ asset('user/img/Randomสีดำ.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Random-img2">
            <span>สุ่มของรางวัล</span>
        </a>
        <a href="{{ url('user/contact') }}" class="btn-Contact4">
            <img src="{{ asset('user/img/Contact.png') }}" alt="รูปติดต่อเรา" class="btn-Contact-img4">
            <span>ติดต่อเรา</span>
        </a>
    </div>
    <!-- ปุ่มกดออกจากระบบ -->
    <div class="btn-logout-wrapper4">
        <a href="{{ url('user/loginuser') }}" class="btn-logout4">
            <img src="{{ asset('user/img/รูปปุ่มกดออก.png') }}" alt="รูปออกจากระบบ" class="btn-logout-img4">
            <span>ออกจากระบบ </span>
        </a>
    </div>
</div>
</div> 
<!--เอาไว้ควบคุมส่วนกลางของเว็บปิดล่างสุด-->
<div class="main-content-5">
    <!-- ชื่อโปรไฟล์-->  
    <div class="My_Profile">
        <h1>ผลการสุ่ม</h1>
    </div>

   @forelse($history as $item)
    @if($item->reward)
    <div class="framebigrandomresult">
        <p class="sectionrandomresult">ยินดีด้วย คุณได้รับรางวัล</p>
        <p class="reward-name">เรียน คุณ <span class="reward-name1">{{ $item->winner_name }}</span></p>
        <div class="framemessagereceiverewards">
            <span>คุณได้รับรางวัลจาการสุ่มรางวัล กรุณาแสดง QR Code ด้านล่าง</span>
            <span class="messagereceiverewards">เพื่อรับของรางวัล</span>
        </div>
        <hr class="linemessagereceiverewards1">
        <div class="framenamereward">
            <p class="messagenamereward">รางวัล</p>
            <div class="namereward">
                <p class="namereward2">{{ $item->reward->name }}</p>
            </div>
        </div>
        <hr class="linemessagereceiverewards">
        <div class="framenamereward">
            <p class="messagenamereward">รหัสรับรางวัล</p>
            <div class="namereward">
                <p class="namereward2">{{ $item->qr_code }}</p>
            </div>
        </div>
        <hr class="linemessagereceiverewards">
        <div class="reward-qr">
            <div>
                {!! QrCode::size(250)->generate($item->qr_code) !!}
            </div>
            <div class="reward-qr-1">
                <p>สแกนหรือแสดง QR Code นี้ที่จุดรับรางวัล</p>
            </div>
        </div>
    </div>
    @else
    <div class="framebigrandomresult">
        <p class="sectionrandomresult">ขอบคุณที่ร่วมกิจกรรม</p>
        <p class="reward-name">เรียน คุณ <span class="reward-name1">{{ $item->winner_name }}</span></p>
        <p class="messagereceiverewards">คุณถูกสุ่มรายชื่อในรอบนี้ แต่กิจกรรมนี้ไม่มีของรางวัล ขอบคุณที่เข้าร่วมกิจกรรม</p>
    </div>
    @endif
@empty
    <div class="framebigrandomresult">
        @if($isDrawn)
            <p class="sectionrandomresult">ขอบคุณที่ร่วมกิจกรรม</p>
            <p class="messagereceiverewards">การสุ่มรอบนี้เสร็จสิ้นแล้ว ครั้งนี้คุณไม่ได้อยู่ในรายชื่อผู้ถูกสุ่ม ขอบคุณที่เข้าร่วมกิจกรรม</p>
        @else
            <p class="sectionrandomresult">ยังไม่มีผลการสุ่ม</p>
            <p class="messagereceiverewards">รายการนี้ยังไม่ได้สุ่มรางวัล กรุณารอประกาศผลจากผู้ดูแลระบบ</p>
        @endif
    </div>
@endforelse
</div>
</body>
</html>