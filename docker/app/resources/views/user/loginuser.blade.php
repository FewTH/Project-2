<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <title>BUUGIFT</title>
</head>
<body class="login-body">
    <!-- โลโก้ด้านบน -->
    <div class="toplogo">
        <img src="{{ asset('user/img/โลโก้วงกลม.png') }}" alt="โลโก้วงกลม" width="60" class="buucirclelogo">
    </div>

    <!-- กรอบlogin -->
     <div class="login-box">
        <img src="{{ asset('user/img/buulogo.png') }}" alt="โลโก้แนวนอน" width="250" class="buulogonobg">
        <h2 class="logintext1">เข้าสู่ระบบ</h2>
        <h5 class="logintext2">กรุณาเข้าสู่ระบบเพื่อใช้งานระบบ</h5>

        <div class="inputacc">
            <h6 class="emailtext">อีเมลหรือชื่อผู้ใช้</h6>
            <input type="email" class="email-box">
            <h6 class="passtext">รหัสผ่าน</h6>
            <input type="password" class="passwd-box">
        </div>

    <div class="rememberbox">
        <label class="remember-me">
        <input type="checkbox" class="remember">
        <span>จดจำฉัน</span>
        </label>   
    <a href="#" class="forgot-password">ลืมรหัสผ่าน?</a>
    </div>

        <div class="submit-login">
            <button type="submit" class="login-btn">
                <span>เข้าสู่ระบบ</span>
                <img src="{{ asset('user/img/ลูกสรขวา.png') }}" alt="right-arrow" class="icon-arrow">
            </button>
        </div>
     </div>
</body>
</html>