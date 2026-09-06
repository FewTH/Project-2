<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เปลี่ยนรหัสผ่าน</title>
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="icon" href="{{ asset('user/img/Logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<!-- ชื่อผู้ใช้งาน -->
<div class="btn-user-wrapper-1">
    <a href="{{ url('user/profile') }}" class="btn-user">
            @if($user->profile_image)
            <img src="{{ asset('storage/'.$user->profile_image) }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
            @else
            <img src="{{ asset('user/img/รูปuser.png') }}" alt="รูปผู้ใช้งาน" class="btn-user-img" id="btn-user-wrapper-img">
            @endif
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
        <a href="{{ url('user/home') }}" class="btn-Home-2">
            <img src="{{ asset('user/img/Home.png') }}" alt="รูปบ้าน" class="btn-Home-img-2">
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
<div class="main-content-change-password">
    <!--กรอบเปลี่ยนรหัสผ่าน-->
    <div class="framechangepassword">
            <img src="{{ asset('user/img/รูปเปลี่ยนรหัสผ่าน.png') }}" alt="รูปเปลี่ยนรหัสผ่าน" class="img-change-password-1">
            <h1 class="sectionchangepassword">เปลี่ยนรหัสผ่าน</h1>
            <p class="messagchangepassword">เปลี่ยนรหัสผ่านใหม่ของคุณได้ที่นี่</p>

          <form id="savesuccesschangepassword_1" action="{{ url('user/change_password') }}" method="POST">
            @csrf
          @csrf
        @if (session('success'))
        <div class="savesuccesschangepassword" id="save_successchangepassword">
            <p class="savesuccess-changepassword"> {{ session('success') }} </p>
        </div>
        @endif
        <input type="text" name="username" value="{{ $user->username }}" autocomplete="username" class="usernamechangepassword">
        <div class="passwordcurrent-1">
            <label class="type-passwordcurrent-1" for="Type_Current_password_1">รหัสผ่านปัจจุบัน</label> <br>
            <div class="img-eye-password">
            <input type="password" class="input-passwordcurrent-1" id="Type_Current_password_1" name="current_password"  autocomplete="current-password">
            <button type="button" class="img-eye" id="img_eye_1">
                <i class="fa-regular fa-eye" id="icon_eye_1"></i>
            </button>
        </div>
            @error('current_password')
                <p class="savesuccesschangepassword-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="passwordcurrent">
            <label class="type-passwordcurrent-1" for="Type_passwordcurrent_1">เปลี่ยนรห้สผ่านใหม่</label> <br>
            <div class="img-eye-password">
            <input type="password" class="input-passwordcurrent-1" id="Type_passwordcurrent_1" name="new_password"  autocomplete="new-password">
            <button type="button" class="img-eye" id="img_eye_2">
                <i class="fa-regular fa-eye" id="icon_eye_2"></i>
            </button>
        </div>
             @error('new_password')
                <p class="savesuccesschangepassword-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="passwordlasttime">
            <label class="type-password-lasttime-1" for="Type_password-lasttime_1">เปลี่ยนรหัสผ่านครั้งล่าสุด</label> <br>
            <input type="text" class="input-password-lasttime-1" id="Type_password-lasttime_1" value="{{ $user->password_changed_at ? $user->password_changed_at->format('d/m/y') : ''}}" disabled>
        </div>
        <div class="save-password-btn-cancel">
        <div class="save-password-1" id="save-password-1">
            <button type="submit" class="save-password-2">บันทึกรหัสผ่าน</button>
        </div>
        <div class="btn-cancel-password" id="btn_cancel_password">
            <button type="reset" class="btn-cancel-password-1">ยกเลิก</button>
        </div>
        </div>
        </form>
    </div>
</div>
<script src="{{ asset('user/js/JavaScript.js') }}"></script>
</body>
</html>