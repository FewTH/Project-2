<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ส่งอีเมลให้ผู้ได้รางวัล</title>
    <link rel="stylesheet" href="{{ asset('manager/css/style.css') }}">
    <link rel="icon" href="{{ asset('admin/img/Logo.png') }}">
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
<div class="main-content-1">
<div class="framedashboard">
    <div class="Overview_Dashboard">
        <h1>ส่งอีเมลให้ผู้ได้รับรางวัล</h1>
    </div>
    <div class="sendallemails">
        <form action="{{ route('manager.senditgmail.sendall', $assessment->assessment_id) }}" method="POST">
        @csrf
        <button type="submit" class="btn-sendallemails1" id="btn_sendallemails1">
            <img src="{{ asset('admin/img/รูปของปุ่มส่งอีเมลทั้งหมด.png') }}" alt="รูปของปุ่มส่งอีเมลทั้งหมด" class="btn-imgsendallemails1">
            <p class="sendallemails1">ส่งอีเมลทั้งหมด</p>
        </button>
        </form>
    </div>
</div>

    <div class="frameallsentdeliveryfailed">
        <div class="frameallbuttonsenditgmail">
            <p class="numberallbuttonsenditgmail" id="numberallbutton_senditgmail">0</p>
            <span class="messageallbuttonsenditgmail">ทั้งหมด</span>
        </div>
        <div class="frameallbuttonsenditgmail-1">
            <p class="numbersentbuttonsenditgmail" id="numbersentbutton_senditgmail">0</p>
            <span class="messageallbuttonsenditgmail">ส่งแล้ว</span>
        </div>
        <div class="frameallbuttonsenditgmail-2">
            <p class="numberdeliveryfailedbuttonsenditgmail" id="numberdeliveryfailedbutton_senditgmail">0</p>
            <span class="messageallbuttonsenditgmail">ส่งไม่สำเร็จ</span>
        </div>
    </div>

    <div class="framebiglistnamerecipientreward-1">
            <div class="framebiglistnamerecipientreward">
                <div class="framemessagelistnamerecipientreward">
                    <p class="pointlistnamerecipientreward"></p>
                    <p class="messagelistnamerecipientreward">ประวัตการส่ง QrCode</p>
                </div>
                    <hr class="linemessagelistnamerecipientreward">

                @foreach($spinresults as $index => $item)
                <div class="framemessagelistnamerecipientreward-1" data-status="{{ $item->email_status }}">
                    <div class="framecirclenumberlistnamerecipientreward">
                        <p class="circlenumberlistnamerecipientreward">{{ $index + 1 }}</p>
                    </div>
                    <div class="framelistnamegmaildateassessment">
                        <span class="messagelistnamegmaildateassessment">{{ $item->winner_name }}</span>
                        <span class="messagegmaildateassessment">{{ $item->winner_email }}</span>
                        <span class="messagedateassessment">ประเมินเมื่อ {{ $item->created_at->format('H:i:s') }} น. {{ $item->created_at->format('d/m/Y') }} </span>
                    </div>
                    @if($item->email_status === 'sent')
                    <div class="framesenttogmail">
                        <img src="{{ asset('admin/img/รูปติกถูกของกรอบส่งแล้วหน้าส่งอีเมลให้ผู้ได้รับรางวัล.png') }}" alt="รูปติกถูกของกรอบส่งแล้วหน้าส่งอีเมลให้ผู้ได้รับรางวัล">
                        <p class="messagesenttogmail">ส่งแล้ว</p>
                    </div>
                    @elseif($item->email_status === 'failed')
                    <div class="frameerrorgmail">
                        <img src="{{ asset('admin/img/รูปแจ้งเตือนส่ง email ล้มเหลว.png') }}" alt="/รูปแจ้งเตือนส่ง email ล้มเหลว">
                        <p class="messageerrorgmail">ล้มเหลว</p>
                    </div>
                    <form action="{{ route('manager.senditgmail.resendone', $item->result_id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-Resend">
                            <img src="{{ asset('admin/img/รูปของปุ่มส่งใหม่.png') }}" alt="" class="imgbtn-Resend">
                            <p class="messagebtn-Resend">ส่งใหม่</p>
                        </button>
                    </form>
                    @else
                    <div class="frameerrorgmail-1">
                        <p class="messageerrorgmail-1">ยังไม่ได้ส่ง</p>
                    </div>
                    @endif
                </div>   
                <hr class="linemessagelistnamerecipientreward-1">
                @endforeach
            </div>

        <div class="framelistthatfailed">
            <p class="messagelistnamerecipientreward-1">รายการที่ล้มเหลว</p>
            <hr class="linemessagelistnamerecipientreward">

            @forelse($failedlist as $item)
            <div class="framelistnamethatfailed">
                <p class="pointlistnamethatfailed"></p>
                <span class="messagelistnamethatfailed-1">{{ $item->winner_name }}</span>
            <form action="{{ route('manager.senditgmail.resendone', $item->result_id) }}" method="POST" class="btn-Resend0">
                @csrf
                <button type="submit" class="btn-Resend1">
                    <img src="{{ asset('admin/img/รูปของปุ่มส่งใหม่.png') }}" alt="" class="imgbtn-Resend1">
                    <p class="messagebtn-Resend1">ส่งใหม่</p>
                </button>
            </form>
            </div>
            <hr class="linemessagelistnamerecipientreward-2">
            @empty
            <div class="messagelistnamethatfailed">
                <p class="messagelistnamethatfailed-1">ไม่มีรายการที่ส่งล้มเหลว</p>
            </div>
            @endforelse

            <form action="{{ route('manager.senditgmail.resendallfailed', $assessment->assessment_id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-resendallthatfailed">
                    <img src="{{ asset('admin/img/รูปของปุ่มส่งใหม่.png') }}" alt="" class="imgbtn-Resend1">
                    <p class="messagebtn-resendallthatfailed">ส่งใหม่ทั้งหมดที่ล้มเหลว</p>
                </button>
            </form>
    </div>

    </div>
</div>
<script src="{{ asset('admin/js/JavaScriptAdmin.js') }}"></script>
</body>
</html>