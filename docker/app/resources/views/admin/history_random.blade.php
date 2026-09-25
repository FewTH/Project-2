<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อผู้ได้รับรางวัล</title>
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
        <h1>รายชื่อผู้ได้รับรางวัล</h1>
        <p class="messagelistactivities">{{ $assessment->name }}</p>
    </div>

    <!--กรอบใหญ่-->
    <div class="framebiglistname">

            <div class="framesearchbtn-senditgmail">
                <div class="framesearchsenditgmail-5">
                    <div class="framesearchsenditgmail">
                        <input type="text" id="frame_searchsenditgmail" class="btn-framesearchsenditgmail" placeholder="ค้นหาชื่อ หรือ รหัส QRCode">
                    </div>
                </div>
                <div class="btn-senditgmail">
                    <a href="{{ url('admin/button_senditgmail' ) }}" class="btn-senditgmail-1">
                        <img src="{{ asset('admin/img/รูปปุ่มกดเปลี่ยนหน้าของดูgmailที่จะส่ง.png') }}" alt="รูปปุ่มกดเปลี่ยนหน้าของดูgmailที่จะส่ง" class="img-btn-senditgmail">
                        <p class="messagebtn-senditgmail">ส่งอีเมลให้ผู้ได้รางวัล</p>
                    </a>
                </div>
            </div>


            <div class="frameallreceivednotacceptingyet">
                <div class="framealllistname">
                    <div class="numberalllistname">
                       <p class="numberalllistname-1" id="numberalllistname_1">0</p> 
                        <div class="imgnumberalllistname">
                            <img src="{{ asset('admin/img/รูปของทั้งหมดหน้ารายชื่อผู้ได้รับรางวัล.png') }}" alt="รูปของทั้งหมดหน้ารายชื่อผู้ได้รับรางวัล">
                        </div>
                    </div>
                    <span class="messagealllistname">ทั้งหมด</span>
                </div>

                <div class="framereceivedlistname">
                    <div class="numberreceivelistname">
                       <p class="numberreceivelistname-1" id="numberreceivelistname_1">0</p> 
                        <div class="imgnumberalllistname">
                            <img src="{{ asset('admin/img/รูปของรับแล้วหน้ารายชื่อผู้ได้รับรางวัล.png') }}" alt="รูปของรับแล้วหน้ารายชื่อผู้ได้รับรางวัล">
                        </div>
                    </div>
                    <span class="messagereceivelistname">รับแล้ว</span>
                </div>

                <div class="framernotacceptingyet">
                     <div class="numbernotacceptingyetlistname">
                       <p class="numbernotacceptingyetlistname-1" id="numbernotacceptingyetlistname_1">0</p> 
                        <div class="imgnumberalllistname">
                            <img src="{{ asset('admin/img/รูปของยังไม่ได้รับหน้ารายชื่อผู้ได้รับรางวัล.png') }}" alt="รูปของยังไม่ได้รับหน้ารายชื่อผู้ได้รับรางวัล">
                        </div>
                    </div>
                    <span class="messagenotacceptingyetlistname">ยังไม่รับ</span>
                </div>
            </div>


            <div class="framerlistnamerecipientreward">
                <div class="framersectionlistnamerecipientreward">
                    <img src="{{ asset('admin/img/รูปของหัวข้อรายชื่อผู้ได้รับรางวัล.png') }}" alt="รูปของหัวข้อรายชื่อผู้ได้รับรางวัล">
                    <p class="messagesectionlistnamerecipientreward">รายชื่อผู้ได้รับรางวัล</p>
                </div>
                <hr class="linesectionlistnamerecipientreward1">

                <div class="framebutton-sectionlistnamerecipientreward">
                    <button type="button" id="button_allsection" class="button-section">
                        <div class="framebutton-allsectionlistnamerecipientreward">
                            <p class="messagebutton-section active" id="messagebutton_allsection">ทั้งหมด</p>
                            <div class="circlenumberbutton-section active" id="circlenumberbutton_allsection">
                                <p class="numberbutton-section active" id="numberbutton_allsection">30</p>
                            </div>
                        </div>
                    </button>

                    <button type="button" id="button_receivedsection" class="button-section">
                        <div class="framebutton-allsectionlistnamerecipientreward">
                            <p class="messagebutton-section" id="messagebutton_receivedsection">รับแล้ว</p>
                            <div class="circlenumberbutton-section" id="circlenumberbutton_receivedsection">
                                <p class="numberbutton-section" id="numberbutton_receivedsection">12</p>
                            </div>
                        </div>
                    </button>

                     <button type="button" id="button_notacceptingyetsection" class="button-section">
                        <div class="framebutton-allsectionlistnamerecipientreward">
                            <p class="messagebutton-section" id="messagebutton_notacceptingyetsection">ยังไม่รับ</p>
                            <div class="circlenumberbutton-section" id="circlenumberbutton_notacceptingyetsection">
                                <p class="numberbutton-section" id="numberbutton_notacceptingyetsection">18</p>
                            </div>
                        </div>
                    </button>
                </div>

                
                <div class="graylinesection">
                    <div class="yellowlinesection" id="yellow_linesection"></div>
                </div>
                
                @foreach($spinresults as $index => $item)
                 <button class="btn-openpopupname"
                        data-status="{{ $item->receive_status === 'received' ? 'received' : 'not-received' }}"
                        data-name="{{ $item->winner_name }}"
                        data-qr="{{ $item->qr_code }}" 
                        data-reward="{{ $item->reward->name ?? '-' }}"
                        data-received-at="{{ $item->received_at ? $item->received_at->format('d/m/Y H:i') : '' }}"
                        data-action="{{ route('admin.spinresult.receive', $item->result_id) }}"
                        >

                    <div class="framecirclenumbername">
                        <p class="circlenumbername">{{ $index + 1}}</p>
                    </div>
                    <div class="username-listname">
                        <p class="messageusername-listname">{{ $item->winner_name }}</p>
                        <span class="messageusername-listname-1">{{ $item->qr_code }}</span>
                    </div>
                    <div class="framereward-listname">
                        <div class="framereward-listname-1">
                            <p class="messagereward-listname">{{ $item->reward->name ?? '-' }}</p>
                        </div>  
                        <div class="framerstatusreward-listname1" data-status="{{ $item->receive_status === 'received' ? 'received' : 'not-received' }}">
                            <p class="messagestatusreward-listname1">{{ $item->receive_status === 'received' ? 'รับแล้ว' : 'ยังไม่รับ' }}</p>
                        </div>
                        
                    </div>
                </button>

                @endforeach
            </div>
    </div>

    <dialog class="popuplistnameawardrecipient" id="popuplistname_awardrecipient">
        <div class="img-popuplistnameawardrecipient">
            <img src="{{ asset('admin/img/รูปของpopupรายชื่อผู้ได้รับรางวัล.png') }}" alt="รูปของpopupรายชื่อผู้ได้รับรางัวล" class="img-popuplistnameawardrecipient-1">
        </div>

        <div class="framemessagepopuplistnameawardrecipient" id="messagepopuplistname_awardrecipient">
            <p class="messagepopuplistnameawardrecipient-1">พบรายชื่อผู้รับรางวัล</p>
        </div>

        <div class="framenamerecipientreward">
            <img src="{{ asset('admin/img/รูปของชื่อผู้รับหน้าpopup.png') }}" alt="รูปของชื่อผู้รับหน้าpopup">
            <div class="framemessagenamerecipientreward">
                <p class="messagenamerecipientreward">ชื่อผู้รับ</p>
                <span class="messagenamerecipientreward-1" id="popuplistname_name">วิภา รักเรียน</span>
            </div>
        </div>

        <div class="frameQRcodepopup">
            <img src="{{ asset('admin/img/รูปของQRcodepopup.png') }}" alt="รูปของQRcodepopup">
            <div class="framemessageQRcodepopup">
                <p class="messagenamerecipientreward">รหัส QR Code</p>
                <span class="messagenamerecipientreward-1" id="popuplistname_QrCode">AB-2026-0008</span>
            </div>
        </div>
        
        <div class="frameprizesreceived">
            <div class="frameimgprizesreceived">
                <img src="{{ asset('admin/img/รูปถ้วยรางวัลของรางวัลที่ได้รับ popupผู้ได้รับรางวัล.png') }}" alt="รูปถ้วยรางวัลของรางวัลที่ได้รับ popupผู้ได้รับรางวัล">
            </div>
            <div class="framemessageprizesreceived">
                <p class="framemessage-prizesreceived">ของรางวัลที่ได้รับ</p>
                <span class="framemessage-prizesreceived-1" id="popuplistname_reward">ดินสอ</span>
            </div>
        </div>

        <hr class="lineframeQRcodepopup">

        <div class="framenotyetreceiveitems" id="framenotyet_receiveitems">
            <img src="{{ asset('admin/img/รูปนาฬิกายังไม่ได้รับของ.png') }}" alt="รูปนาฬิกายังไม่ได้รับของ">
            <p class="messagenotyetreceiveitems">ยังไม่ได้รับของ</p>
        </div>

        <div class="framenotyetreceiveitems-1" id="framenotyet_receiveitems_1">
            <img src="{{ asset('admin/img/รูปรับของแล้วของpopupพบรายชื่อผู้รับรางวัล.png') }}" alt="รูปรับของแล้วของpopupพบรายชื่อผู้รับรางวัล">
            <div class="messagenotyetreceiveitems-3">
                <p class="messagenotyetreceiveitems-1">รับของเมื่อ</p>
                <span class="messagenotyetreceiveitems-1" id="messagenotyetreceiveitems_2"></span>
            </div>
        </div>

    
    <form id="form_receive" method="POST">
        @csrf
        <div class="btn-off-submitpopuplistnameawardrecipient">
            <button type="button" class="btn-offpopuplistnameawardrecipient" id="btn_offpopuplistnameawardrecipient">
                <p class="messagebtn-offpopuplistnameawardrecipient">ปิด</p>
            </button>
            <button type="submit" class="btn-submitpopuplistnameawardrecipient" id="btn_submitpopuplistnameawardrecipient">
                <img src="{{ asset('admin/img/ติกถูกของปุ่มยืนยันรับของ.png') }}" alt="ติกถูกของปุ่มยืนยันรับของ" class="img-btn-submitpopuplistnameawardrecipient">
                <p class="messagebtn-submitpopuplistnameawardrecipient">ยืนยันรับของ</p>
            </button>
        </div>
    </form>
    </dialog>

</div>
<script src="{{ asset('admin/js/JavaScriptAdmin.js') }}"></script>
</body>
</html>