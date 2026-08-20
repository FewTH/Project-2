<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูล</title>
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="icon" href="{{ asset('user/img/Logo.png') }}">
</head>
<body>
    <!-- ชื่อผู้ใช้งาน -->
<div class="btn-user-wrapper-1">
    <a href="{{ url('user/profile') }}" class="btn-user">
        <img src="{{ asset('user/img/user.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
        <span>User</span>
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
        <a href="{{ url('user/home') }}" class="btn-Home-1">
            <img src="{{ asset('user/img/Home.png') }}" alt="รูปบ้าน" class="btn-Home-img-1">
            <span>หน้าหลัก</span>
        </a>
        <a href="{{ url('user/spin') }}" class="btn-Random-1">
            <img src="{{ asset('user/img/Random.png') }}" alt="รูปสุ่มของรางวัล" class="btn-Random-img-1">
            <span>สุ่มของรางวัล</span>
        </a>
        <a href="{{ url('user/contact') }}" class="btn-Contact-1">
            <img src="{{ asset('user/img/Contact.png') }}" alt="รูปติดต่อเรา" class="btn-Contact-img-1">
            <span>ติดต่อเรา</span>
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
<div class="main-content-edit_information">
    <!--กรอบแก้ไขข้อมูลส่วนตัว-->
    <div class="frameeditinformation">
         <div class="arrow-2">
        <a href="{{ url('user/profile') }}" class="arrow-1">←</a>
        </div>
        <img src="{{ asset('user/img/รูปการแก้ไขข้อมูล.png') }}" alt="รูปการแก้ไขข้อมูล" class="img-edit-information-1">
        <h1 class="sectioneditinformation">แก้ไขข้อมูล</h1>
        <p class="messageditinformation">แก้ไขข้อมูลเดิมของคุณได้ที่นี่</p>
        <div class="savesuccess" id="save_success">
            <p class="savesuccess-1"> ✓ บันทึกข้อมูลสำเร็จแล้ว </p>
        </div>
        <div class="username-1">
            <label class="type-username-1" for="Type_name_1">ชื่อผู้ใช้</label> <br>
            <input type="text" class="input-username-1" id="Type_name_1" placeholder="User01">
        </div>
        <div class="FirstName-LastName-1">
            <label class="FirstNameLastName-1" for="Enter_firstname_lastname_1">ชื่อ-นามสกุล</label> <br>
            <input type="text" class="input-FirstName-LastName-1" id="Enter_firstname_lastname_1" placeholder="นายนารี ใจดี">
        </div>
        <div class="email-user-1">
            <label class="typeemail-user-1" for="Compose_email_1"> อีเมล </label> <br>
            <input type="text" class="input-email-user-1" id="Compose_email_1" placeholder="User01@gmail.com">
            <p class="pleasecompleteemail" id="please_complete_email">กรุณากรอกอีเมลให้ถูกต้อง เช่น Admin02@gmail.com</p>
        </div>
        <div class="phone_number-1">
            <label class="typephone_number-1" for="Enter_phonenumber_1"> เบอร์โทร </label> <br>
            <input type="text" class="input-phonenumber-1" id="Enter_phonenumber_1" placeholder="081-123-xxxx">
            <p class="pleasewearnumber" id="please_wear_number">กรุณาใส่เบอร์ให้ให้ถูกต้อง เช่น 1234567890</p>
        </div>
        <div class="save-data-btn-cancel">
            <div class="save-data-1"  id="save-data-2">
            <button class="save-data-2">บันทึกข้อมูล</button>
        </div>
        <div class="btn-cancel-1"  id="btn_cancel_2">
            <button class="btn-cancel-2">ยกเลิก</button>
        </div>
        </div>
    </div>
</div>
<script src="{{ asset('user/js/JavaScript.js') }}"></script>
</body>
</html>