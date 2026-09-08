<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดกิจกรรม</title>
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
<!--เอาไว้ควบคุมส่วนกลางของเว็บปิดล่างสุด-->
<div class="main-content-1">
    <div class="My_Profile">
        <h1>รายละเอียดกิจกรรม</h1>
    </div>
    <div class="framelargest">


        <div class="frameback-correct-offRegister">
            <button type="button" class="deleteRegister" id="delete_Register">
                <p class="message-deleteRegister">ลบกิจกรรม</p>
            </button>
        <dialog class="popupdeleteRegister" id="popup_deleteRegister">
            <form action="{{ route('admin.activity.deletedata', $event->event_id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="imgpopupdeleteRegister">
                <img src="{{ asset('admin/img/รูปของpopupลบกิจกรรม.png') }}" alt="รูปของpopupลบกิจกรรม" class="img-popupdeleteRegister">
            </div>
            <div class="message-popupdeleteRegister">
                <p class="message-confirmdeleteRegister">ยืนยันลบกิจกรรม</p>
                <span class="messagewarndeleteactivity">กิจกรรมนี้จะถูกลบอย่างถาวร</span>
                <span class="messagewarndeleteactivity">ข้อมูลการลงทะเบียนและอื่นๆจะหายไปทั้งหมด</span>
            </div>
            <div class="btn-confirmdeletion-1">
            <button type="submit" class="btn-confirmdeletion" id="btn_confirmdeletion">
                <p class="btn-confirmdeletion-2">ยืนยันลบ</p>
            </button>
            <button type="button" class="btn-canceldeletion" id="btn_canceldeletion">
                <p class="btn-canceldeletion-1">ยกเลิก</p>
            </button>
            </div>
            </form> 
        </dialog>

            <a href="{{ url('admin/edit_activity') }}" class="edit-activity">
                <p class="message-edit-activity">แก้ไข</p>
            </a>
            <button type="button" class="offRegister" id="off_Register" >
                <p class="message-offRegister">ปิด Register</p>
            </button>
        </div>

        <dialog class="popupoffRegister" id="popupoff_Register" >
            <form id="form_close_register" action="{{ route('admin.activity.close', $event->event_id) }}" method="POST" >
            @csrf
            <div class="imgpopupoffRegister">
                <img src="{{ asset('admin/img/รูปของpopupยืนยันปิด Register.png') }}" alt="รูปของpopupยืนยันปิด Register" class="img-popupoffRegister"> 
            </div>
            <div class="messageconfirmoffRegister">
                <p class="message-confirmoffRegister">ยืนยันปิด Register</p>
                <span class="messagewarn">กิจกรรมนี้จะไม่สามารถลงทะเบียนเพิ่มได้อีก</span>
                <span class="messagewarn">หลังจากยืนยันแล้ว</span>
            </div>
            <div class="btn-confirm-cancel">
                <button type="submit" class="btnconfirmoffRegister" id="btn_confirmoffRegister" > 
                    <p class="btnconfirmoffRegister-1">ยืนยัน</p>
                </button>

                <button type="button" class="canceloffRegister" id="cancel_offRegister">
                    <p class="canceloffRegister-1">ยกเลิก</p>
                </button>
            </div>  
            </form> 
        </dialog>


            <div class="frameactivitytime">
                <div class="frameactivitytime-1">
                    <div class="frmemsectionCreated">
                        <p class="messagesectionactivity">{{ $event->title }}</p>
                        <span class="messagesectionactivity-1">สร้างเมื่อ {{ $event->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="framemessageoffregister-time">
                        <p class="messageoffregister">ปิด Register ใน</p>
                        <h2 class="numbertime" id="number_time" data-seconds="{{ $remainingseconds }}">00:00</h2>
                    </div>
                </div>

                <button href="{{ url('admin/random_reward') }}" class="btn-randomreward" id="btn_randomreward" data-url="{{ url('admin/random_reward/' . $event->event_id) }}" {{ $isexpired ? '' : 'disabled' }}>
                    <img src="{{ asset('admin/img/รูปถ้วยรางวัลของปุ่มเริ่มสุ่มรางวัล.png') }}" alt="รูปถ้วยรางวัลของปุ่มเริ่มสุ่มรางวัล" class="img-trophy">
                    <p class="messagestartrandom">เริ่มสุ่มรางวัล</p>
                    <img src="{{ asset('admin/img/รูปลูกศรของปุ่มเริ่มสุ่มรางวัล.png') }}" alt="รูปลูกศรของปุ่มเริ่มสุ่มรางวัล" class="img-arrowstartrandom">
                </button>

                <div class="frame4frame">
                    <div class="framenumbermessageregister">
                        <h2 class="numberregister">{{ $event->registrations->count() }}</h2>
                        <p class="messageregister">ลงทะเบียนแล้ว</p>
                    </div>
                    <div class="framenumbermessagereceiveupto">
                        <h2 class="numberreceiveupto">{{ $event->max_participants }}</h2>
                        <p class="messagereceiveupto">รับสูงสุด</p>
                    </div>
                    <div class="framemessagenomessagestatus">
                        <h2 class="messageno">{{ ($event->status === 'open' && !$isexpired) ? 'เปิดอยู่' : 'ปิดแล้ว' }}</h2>
                        <p class="messagestatus">สถานะ</p>
                    </div>
                    <div class="framenumbertimemessagestimeoff">
                        <h2 class="numbertime-1">{{ \Carbon\Carbon::parse($event->register_close_at)->format('H:i') }} น.</h2>
                        <p class="messagestimeoff">เวลาปิด</p>
                    </div>
                </div>

                <div class="frameQRcoderegisteractivity">
                    <div class="frameQRcoderegister-1">
                        <div class="frmaemessageQRcoderegistermessagescan">
                            <p class="messageQRcoderegister">QR code ลงทะเบียน</p>
                            <div class="frmaemessagescan">
                                <p class="messagescan">Scan ได้เลย</p>
                            </div>
                        </div>
                        <hr class="lineQRcode">
                        <div class="img-QRcode">
                            {!! QrCode::size(300)->generate(url('user/register_event/' . $event->event_id)) !!}
                        </div>

                        <div class="framerecordshare">
                           <a href="{{ route('admin.activity.qrcode.download', $event->event_id) }}" class="btn-recordQrcode" id="btn_recordQrcode">
                                <img src="{{ asset('admin/img/รูปของปุ่มบันทึก.png') }}" alt="รูปของปุ่มบันทึก" class="img-recordQrcode">
                                <p class="message-recordQrcode">บันทึก</p>
                            </a>
                        </div>
                    </div>

                <div class="frameQRcoderegister-2">
                    <div class="messageactivity">
                        <p class="messageactivity-1">ข้อมูลกิจกรรม</p>
                        <div class="frmaemessagescan-1">
                            <p class="messagescan-1">ทั้งหมด</p>
                        </div>
                    </div>
                    <hr class="lineactivity">
                    <div class="framedateorganize">
                        <p class="messagedateorganize">วันที่จัดกิจกรรม</p>
                        <span class="dateorganize">{{ \Carbon\Carbon::parse($event->register_close_at)->format('d m Y') }}</span>
                    </div>
                    <hr class="lineactivity">
                    <div class="framedateorganize">
                        <p class="messagedateorganize">เวลาปิด Register</p>
                        <span class="dateorganize">{{ \Carbon\Carbon::parse($event->register_close_at)->format('H:i') }} น.</span>   
                    </div>
                    <hr class="lineactivity">
                    <div class="framedateorganize">
                        <p class="messagedateorganize">จำนวนสูงสุด</p>
                        <span class="dateorganize">{{ $event->max_participants }}</span>
                    </div>
                    <hr class="lineactivity">
                    <div class="framedateorganize">
                        <p class="messagedateorganize">รายการรางวัลทั้งหมด</p>
                        <span class="dateorganize"> 
                            @foreach($event->wheel->rewards as $reward)
                            {{ $reward->name }} {{ $reward->pivot->quantity_selected }}{{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        </span>
                    </div>
                </div>
            </div>

            <div class="framelistnamesregister">
                <div class="framelistnamesregister-1">
                    <div class="pointlistnamesregister"></div>
                    <p class="messagelistnamesregiste">รายชื่อผู้ลงทะเบียน</p>
                    <div class="framequantitypeople">
                        <p class="numberquantitypeople">{{ $event->registrations->count() }} คน</p>
                    </div>
                </div>
                <hr class="linequantitypeople">

                @foreach($event->registrations as $index => $registration)
                <div class="frameinformationparticipants">
                    <div class="framenumberpeople">
                        <p class="numberpeople">{{ $index + 1 }}</p>
                    </div>
                    <div class="frmaename-emailparticipants">
                        <p class="nameparticipants">{{ $registration->full_name }}</p>
                        <span class="emailparticipants">{{ $registration->email }}</span>
                    </div>
                    <div class="frametimeparticipants">
                        <p class="timeparticipants">{{ $registration->registered_at->format('H:i') }} น.</p>
                    </div>
                </div>
                <hr class="linequantitypeople">
                @endforeach
            </div>
        </div>

    </div>

</div>

<script src="{{ asset('admin/js/JavaScriptAdmin.js') }}"></script>
</body>
</html>