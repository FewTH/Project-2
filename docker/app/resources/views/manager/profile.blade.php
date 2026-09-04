<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรไฟล์</title>
   <link rel="stylesheet" href="{{ asset('manager/css/style.css') }}">
   <link rel="icon" href="{{ asset('user/img/Logo.png') }}">
</head>
<body>
<!-- ชื่อผู้ใช้งาน -->
<div class="btn-user-wrapper-1">
    <a href="{{ url('manager/profile') }}" class="btn-user">
        @if($user->profile_image)
        <img src="{{ asset('storage/'.$user->profile_image) }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @else
        <img src="{{ asset('user/img/รูปuser.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        @endif
        <span>manager</span>
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
        <a href="{{ url('manager/รอเปลี่ยน') }}" class="btn-Random-1">
            <img src="{{ asset('manager/img/รูปปุ่มเมนูจัดการวงล้อสุ่ม.png') }}" alt="รูปปุ่มเมนูจัดการวงล้อสุ่ม" class="btn-Random-img-1">
            <span>จัดการวงล้อสุ่ม</span>
        </a>
        <a href="{{ url('manager/รอเปลี่ยน') }}" class="btn-Contact-1">
            <img src="{{ asset('manager/img/รูปปุ่มเมนูรายการกิจกรรม.png') }}" alt="รูปปุ่มเมนูรายการกิจกรรม" class="btn-Contact-img-1">
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
    <!-- ชื่อโปรไฟล์-->  
    <div class="My_Profile">
        <h1>โปรไฟล์ของฉัน</h1>
    </div>
<!--โปรไฟล์ปิดแท็กตรงชื่อจำนวนของรางวัล-->
<div class="Profile">
    <!--โปรไฟล์ฝั่งซ้ายปิดแท็กตรงกำลังใช้งาน-->
    <div class="profile-left">
        <!--รูปภาพผู้ใช้-->
        <div class="photo_user">
        @if ($user->profile_image)
            <img src="{{ asset('storage/'.$user->profile_image) }}" alt="รูปภาพผู้ใช้" class="photo_user-img-1" id="photo_user_img_2">
        @else
            <img src="{{ asset('user/img/รูปuser.png') }}" alt="รูปภาพผู้ใช้" class="photo_user-img" id="photo_user_img_1">
        @endif
        </div>
        <!--ปุ่มไว้กดเปลี่ยนรูปมี popup เด้งขึ้นมา-->
        <div class="Change_image">
            <button class="btn-open" id="btn_open_1">
                <img src="{{ asset('user/img/รูปกล้อง.png') }}" alt="รูปกล้อง">
                <span class="Nameprofile"> เปลี่ยนรูปโปรไฟล์ </span>
            </button>
        </div>  
        <div class="useremailstatus">
            <!--ชื่อ-->
            <div class="name">
                <h2 id="username">{{ $user->username }}</h2>
            </div>
            <!--อีเมล-->
            <div class="email">
                <p id="email_user">{{ $user->email }}</p>
            </div>
            <!--สถานะ-->
            <div class="In_use">
               <span>กำลังใช้งาน</span>
            </div>
        </div>
    </div> 
    <!-- ฝั่งขวาปิดแท็กตรงชื่อจำนวนของรางวัล--->
    <div class="profile-right">
        <div class="framerandom_all">
            <!--สุ่มทั้งหมด-->
            <div class="random_all"> 
                <img src="{{ asset('user/img/รูปลูกเต๋า.png') }}" alt="รูปลูกเต๋า" class="random_all-img">
            </div>
            <!--การสุ่มทั้งหมด-->
            <div class="Random_number">
                <h1 id="Random_numberaward">0</h1>
            </div>
            <!--ชื่อสุ่มทั้งหมด-->
            <div class="all_random">
                <h4>สุ่มทั้งหมด</h4>
            </div>
        </div>
        <div class="frameReward_Box">
            <!--รูปของรางวัล-->
            <div class="Reward_Box">
                <img src="{{ asset('user/img/รูปกล่องของรางวัล.png') }}" alt="รูปกล่องของรางวัล" class="Reward_Box-img">
            </div>
            <!--จำนวนรางวัลที่ได้-->
            <div class="Number_of_Reward">
                <h1 id="number_ofaward">0</h1>
            </div>
            <!--ชื่อจำนวนของรางวัล-->
            <div class="Award_Name">
                <h4>จำนวนรางวัลที่ได้</h4>
            </div>
        </div>
    </div>
</div>

<!--หน้า Pop-up สำหรับอัปโหลดรูป-->
<div class="popup">
     <dialog id="image-popup" class="popup-box" data-open="{{ session('open_popup') || session('error') || $errors->any() ? 'true' : 'false' }}">
        <form action="{{ url('manager/profile') }}" method="POST" enctype="multipart/form-data" id="profileForm">
        @csrf
       <button type="button" class="btn-close-1" id="btn_close_1">
            <p class="btn-close-popup">x</p>
        </button>
            
        <img src="{{ asset('user/img/รูปกล้องตรงเปลี่ยนรูปโปรไฟล์.png') }}" alt="รูปกล้องตรงเปลี่ยนรูปโปรไฟล์" class="img-Camera-icon"  id="img_Camera_icon">

        <h2 class="Change-photo">เปลี่ยนรูปโปรไฟล์</h2>
        <p class="choosephotonew">เลือกรูปภาพใหม่จากเครื่องของคุณ</p>

        @if (session('success'))
        <div class="savesuccessimage-1">
            <p class="savesuccess-image"> {{ session('success') }} </p>
        </div>    
        @endif
        @error('profile_image')
            <p class="savesuccessimage-error">{{ $message }}</p>
        @enderror
        <input type="file" name="profile_image" id="uploadphoto" accept="image/jpeg,image/png,image/webp">
        
            <!--ปุ่มเอาไว้เปลี่ยนอยู่โปรไฟล์อยู่ตรงนี้-->
            <label for="uploadphoto" class="btn-uploadphoto" >
                    <img src="{{ asset('user/img/รูปของปุ่มเอาไวอัพโหลดรูปโปรไฟล์.png') }}" alt="รูปของปุ่มเอาไวอัพโหลดรูปโปรไฟล์" class="img-btn-select-file">
                    <p class="message-uploadphoto">เลือกรูปภาพ</p>
                    <div class="message-uploadphoto-1-2">
                        <span class="message-uploadphoto-1">ต้องเป็นไฟล์ jpeg, png, webp</span>
                        <span class="message-uploadphoto-1">ขนาดของรูปภาพไม่เกิน 5 MB</span>
                    </div>
            </label>

        </form>
    </dialog>
</div>

<!--ข้อมูลผู้ใช้-->
<div class="User_Information">
    <!--ข้อมูลส่วนตัว-->
    <div class="personal_information">
        <h3>ข้อมูลส่วนตัว</h3>
        <div class="btn-Edit-information-1"  id="Edit_information" >
            <button class="btn-Edit-information-2"> แก้ไขข้อมูล </button>
        </div>
    </div>
    <form onsubmit="return false">
    <!--ชื่อผู้ใช้-->
   <div class="username">
        <label class="Type_username"> ชื่อผู้ใช้ </label> 
        <input type="text" id="Type_name" value="{{ $user->username }}" class="input-username" autocomplete="username" disabled>
    </div>
    <!--ชื่อ-นามสกุล-->
    <div class="FirstName-LastName">
        <label class="FirstNameLastName"> ชื่อ-นามสกุล </label>
        <input type="text" id="Enter_firstname_lastname" value="{{ $user->full_name }}" class="input-FirstName-LastName" autocomplete="name" disabled>
    </div>
    <!--อีเมลผู้ใช้-->
    <div class="email-user">
        <label class="typeemail-user"> อีเมล </label>
        <input type="email" id="Compose_email"  value="{{ $user->email }}" class="input-email-user" autocomplete="email" disabled>
    </div>
    <!--เบอร์โทร-->
    <div class="phone_number">
        <label class="typephone_number"> เบอร์โทร </label>
        <input type="tel" id="Enter_phonenumber" value="{{ $user->phone }}" class="input-phonenumber"  autocomplete="tel" disabled>
    </div>
    </form>
</div>

<!--เปลี่ยนรหัสผ่าน-->
<div class="Change_password">
    <div class="password">
        <h3>รหัสผ่าน/เปลี่ยนรหัสผ่าน</h3>
    </div>
     <form onsubmit="return false">
       <input type="text" name="username" value="{{ $user->username }}" autocomplete="username" class="hidden-username-1">
    <!--รหัสผ่านปัจจุบัน-->
    <div class="Current_password">
        <label class="typeCurrent_password">รหัสผ่านปัจจุบัน</label>
        <input type="password" id="Enter_password" value="********" class="input-Current_password" autocomplete="current-password" disabled>
    </div>
    <!--เปลี่ยนครั้งล่าสุด-->
    <div class="Last_updated">
        <label class="typelast_updated">เปลี่ยนรหัสครั้งล่าสุด</label>
        <input type="text" id="Update_password" value="{{ $user->password_changed_at ? $user->password_changed_at->format('d/m/y') : ''}}" class="input-Last_updated" disabled>
    </div>
    </form>
     <!--ปุ่มเปลี่ยนหัสผ่าน-->
        <div class="Password-Change-Button" id="Change_password">
            <button class="btn-Change-password"> เปลี่ยนรหัสผ่าน </button>
        </div>
</div>
    <!--popupแก้ไขข้อมูลส่วนตัว-->
    <div class="popup-btn-edit">
        <dialog id="popup_btn_edit" class="popup-btn-edit-1">
            <img src="{{ asset('user/img/รูปการแก้ไขข้อมูล.png') }}" alt="รูปการแก้ไขข้อมูล" class="img-edit-information">
            <h2 class="confirm-edit">แก้ไขข้อมูล</h2>
            <p class="message-confirm-edit">คุณต้องการแก้ไขข้อมูลนี้หรือไม่?</p>
        <div class="btn_editinformation">
            <div class="btn-Edit-information-profile" id="btn_Edit_information">
                <a href="{{ url('manager/edit_information') }}" class="btn-Edit-information-profile-1">ยืนยัน</a>
            </div>
            <div class="btn-close-Edit" id="btn_close_Edit">
               <button class="btn-close-Edit-1">ยกเลิก</button>
            </div>
        </div>
        </dialog>
    </div>
    <!--popupเปลี่ยนรหัสผ่าน-->
    <div class="popup-btn-Change">
        <dialog id="popup_btn_Change" class="popup-btn-Change-1">
            <img src="{{ asset('user/img/รูปเปลี่ยนรหัสผ่าน.png') }}" alt="รูปเปลี่ยนรหัสผ่าน" class="img-change-password">
            <h2 class="change-password">เปลี่ยนรหัสผ่าน</h2>
            <p class="message-change-password">คุณต้องการเปลี่ยนรหัสผ่านนี้หรือไม่?</p>
        <div class="btn_changepassword">
            <div class="btn-change-password" id="btn_change_password">
                <a href="{{ url('manager/change_password') }}" class="btn-change-password-1">ยืนยัน</a>
            </div>
            <div class="btn-close-change"  id="btn_close_change"> 
                <button class="btn-close-change-1">ยกเลิก</button>
            </div>
        </div>
        </dialog>
    </div>
    
</div>
<script src="{{ asset('manager/js/JavaScript.js') }}"></script>
</body>
</html>