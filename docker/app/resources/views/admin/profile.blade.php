<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรไฟล์</title>
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="icon" href="{{ asset('admin/img/Logo.png') }}">
</head>
<body>
<!-- ชื่อผู้ใช้งาน -->
<div class="btn-user-wrapper-1">
    <a href="{{ url('admin/profile') }}" class="btn-user">
        <img src="{{ asset('admin/img/user.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        <span>Admin</span>
    </a>
</div>
<div class="container-1">
    <!-- โลโกมหาลัย -->
    <div class="img-Logo">
       <img src="{{ asset('admin/img/Logo.png') }}" alt="รูปโลโกมหาลัย" class="Logo-img">
    </div>
    <!-- ปุ่มเมนู -->
    <div class="btn-Sidebar">
        <a href="{{ url('admin/dashboard') }}" class="btn-Dashboard-1">
            <img src="{{ asset('admin/img/แดชบอร์ด.png') }}" alt="รูปแดชบอร์ด" class="btn-Dashboard-img-1">
            <span>แดชบอร์ด</span>
        </a>
        <a href="{{ url('admin/managereward') }}" class="btn-Manage_Rewards-1">
            <img src="{{ asset('admin/img/รูปจัดการรางวัล.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Manage_Rewards-img-1">
            <span>จัดการรางวัล</span>
        </a>
        <a href="{{ url('admin/manageuser') }}" class="btn-Manage_users-1">
            <img src="{{ asset('admin/img/รูปจัดการผู้ใช้.png') }}" alt="รูปติดต่อเรา" class="btn-Manage_users-img-1">
            <span>จัดการผู้ใช้</span>
        </a>
        <a href="{{ url('admin/managespin') }}" class="btn-Managewheel-1">
            <img src="{{ asset('admin/img/รูปจัดการวงล้อสุ่ม.png') }}" alt="รูปติดต่อเรา" class="btn-Managewheel-img-1">
            <span>จัดการวงล้อสุ่ม</span>
        </a>
        <a href="{{ url('admin/assessment') }}" class="btn-Assessment-1">
            <img src="{{ asset('admin/img/รูปแบบประเมินกิจกรรม.png') }}" alt="รูปติดต่อเรา" class="btn-Assessment-img-1">
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
            <img src="{{ asset('admin/img/รูปuser.png') }}" alt="รูปภาพผู้ใช้" class="photo_user-img" id="photo_user_img_1">
        </div>
        <!--ปุ่มไว้กดเปลี่ยนรูปมี popup เด้งขึ้นมา-->
        <div class="Change_image">
            <button class="btn-open" id="btn_open_1">
                <img src="{{ asset('admin/img/รูปกล้อง.png') }}" alt="รูปกล้อง">
                <span class="Nameprofile"> เปลี่ยนรูปโปรไฟล์ </span>
            </button>
        </div>  
    <div class="useremailstatus">
        <!--ชื่อ-->
        <div class="name">
            <h2 id="username">Admin02</h2>
        </div>
        <!--อีเมล-->
        <div class="email">
            <p id="email_user">Admin02@gmail.com</p>
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
            <img src="{{ asset('admin/img/รูปลูกเต๋า.png') }}" alt="รูปลูกเต๋า" class="random_all-img">
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
            <img src="{{ asset('admin/img/รูปกล่องของรางวัล.png') }}" alt="รูปกล่องของรางวัล" class="Reward_Box-img">
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
    <dialog id="image-popup" class="popup-box">
        <img src="{{ asset('admin/img/รูปกล้องตรงเปลี่ยนรูปโปรไฟล์.png') }}" alt="รูปกล้องตรงเปลี่ยนรูปโปรไฟล์" class="img-Camera-icon"  id="img_Camera_icon">
        <h2 class="Change-photo">เปลี่ยนรูปโปรไฟล์</h2>
        <p class="choosephotonew">เลือกรูปภาพใหม่จากเครื่องของคุณ</p>
        <p class="file_size_5MB">ขนาดไฟล์ไม่เกิน 5MB</p>
        <input type="file" id="uploadphoto" accept="image/jpeg,image/png,image/webp">
        <p id="uploaderror" class="upload_error">ไฟล์ใหญ่เกินไป กรุณาเลือกไฟล์ที่มีขนาดไม่เกิน 5MB</p>
        <div class="btn-select-file-1">
            <div class="btn-select-file" id="btn_select_file_1">
                <button class="btn-select-file-2">เลือกรูปภาพ</button>
            </div>
            <div class="btn-close" id="btn_close_1">
                <button class="btn-close-1" >ยกเลิก</button>
            </div>
        </div>
    </dialog>
</div>

<!--ข้อมูลผู้ใช้-->
<div class="User_Information">
    <!--ข้อมูลส่วนตัว-->
    <div class="personal_information">
        <h3>ข้อมูลส่วนตัว</h3>
        <div class="btn-Edit-information-1"  id="Edit_information">
            <button class="btn-Edit-information-2"> แก้ไขข้อมูล </button>
        </div>
    </div>
    <form onsubmit="return false">
    <!--ชื่อผู้ใช้-->
    <div class="username">
        <label class="Type_username"> ชื่อผู้ใช้ </label> 
        <input type="text" id="Type_name" value="Admin02" class="input-username" autocomplete="username" disabled>
    </div>
    <!--ชื่อ-นามสกุล-->
    <div class="FirstName-LastName">
        <label class="FirstNameLastName"> ชื่อ-นามสกุล </label>
        <input type="text" id="Enter_firstname_lastname" value="นายนารี ใจดี" class="input-FirstName-LastName" autocomplete="name" disabled>
    </div>
    <!--อีเมลผู้ใช้-->
    <div class="email-user">
        <label class="typeemail-user"> อีเมล </label>
        <input type="text" id="Compose_email"  value="Admin02@gmail.com" class="input-email-user" autocomplete="email" disabled>
    </div>
    <!--เบอร์โทร-->
    <div class="phone_number">
        <label class="typephone_number"> เบอร์โทร </label>
        <input type="text" id="Enter_phonenumber" value="081-123-xxxx" class="input-phonenumber"  autocomplete="tel" disabled>
    </div>
    </form>
</div>

<!--เปลี่ยนรหัสผ่าน-->
<div class="Change_password">
    <div class="password">
        <h3>รหัสผ่าน/เปลี่ยนรหัสผ่าน</h3>
    </div>
    <form onsubmit="return false">
        <input type="text" name="username" value="Admin02" autocomplete="username" class="hidden-username-1">
    <!--รหัสผ่านปัจจุบัน-->
    <div class="Current_password">
        <label class="typeCurrent_password">รหัสผ่านปัจจุบัน</label>
        <input type="password" id="Enter_password" value="12345678" class="input-Current_password" autocomplete="current-password" disabled>
    </div>
    <!--เปลี่ยนครั้งล่าสุด-->
    <div class="Last_updated">
        <label class="typelast_updated">เปลี่ยนรหัสครั้งล่าสุด</label>
        <input type="text" id="Update_password" value="01/01/2026" class="input-Last_updated" disabled>
    </div>
    </form>
     <!--ปุ่มเปลี่ยนหัสผ่าน-->
        <div class="Password-Change-Button" id="Change_password">
            <button class="btn-Change-password"> เปลี่ยนรหัสผ่าน </button>
        </div>
</div>
    <!--popupแก้ไขข้อมูลส่วนตัว-->
     <div class="popup-btn-edit" >
        <dialog id="popup_btn_edit" class="popup-btn-edit-1">
            <img src="{{ asset('admin/img/รูปการแก้ไขข้อมูล.png') }}" alt="รูปการแก้ไขข้อมูล" class="img-edit-information">
            <h2 class="confirm-edit">แก้ไขข้อมูล</h2>
            <p class="message-confirm-edit">คุณต้องการแก้ไขข้อมูลนี้หรือไม่?</p>
        <div class="btn_editinformation">
            <div class="btn-Edit-information-profile">
                <a href="{{ url('admin/edit_information') }}" class="btn-Edit-information-profile-1">ยืนยัน</a>
            </div>
            <div class="btn-close-Edit" id="btn_close_Edit">
                <button class="btn-close-Edit-1">ยกเลิก</button>
            </div>
        </div>
        </dialog>
    </div>
    <!--popupเปลี่ยนรหัสผ่าน-->
    <div class="popup-btn-Change" >
        <dialog id="popup_btn_Change" class="popup-btn-Change-1">
            <img src="{{ asset('admin/img/รูปเปลี่ยนรหัสผ่าน.png') }}" alt="รูปเปลี่ยนรหัสผ่าน" class="img-change-password">
            <h2 class="change-password">เปลี่ยนรหัสผ่าน</h2>
            <p class="message-change-password">คุณต้องการเปลี่ยนรหัสผ่านนี้หรือไม่?</p>
        <div class="btn_changepassword">
            <div class="btn-change-password" id="btn_change_password">
                <a href="{{ url('admin/change_password') }}" class="btn-change-password-1" >ยืนยัน</a>
            </div>
            <div class="btn-close-change"  id="btn_close_change"> 
                <button class="btn-close-change-1">ยกเลิก</button>
            </div>
        </div>
        </dialog>
    </div>
</div>
<script src="{{ asset('admin/js/JavaScriptAdmin.js') }}"></script>
</body>
</html>