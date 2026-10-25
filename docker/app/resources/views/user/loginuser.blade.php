<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>BUUGIFT</title>
</head>
<body class="login-body">
    <!-- โลโก้ด้านบน -->
    <div class="toplogo">
        <img src="{{ asset('user/img/โลโก้วงกลม.png') }}" alt="โลโก้วงกลม" width="60" class="buucirclelogo">
    </div>

<div class="login-box-1">
    <!-- กรอบlogin -->
     <div class="login-box">
        <div class="buulogonobg">
            <img src="{{ asset('user/img/โลโก้buuไม่มีพื้นหลัง.png') }}" alt="โลโก้แนวนอน" width="150" class="img-buulogonobg">
        </div>
            <div class="descripppy">
                <span class="logintext1">เข้าสู่ระบบ</span>
                <span class="logintext2">กรุณาเข้าสู่ระบบเพื่อใช้งานระบบ</span>
            </div>
        @if ($errors->any())
        <div class="login-error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        
        <form action="{{route('login.submit')}}" method="POST">
            @csrf
            {{-- username --}}
            <div class="namelog-main-box">
                <label for="usrname-log" class="usrname-log-topic">ชื่อผู้ใช้</label>
                <div class="img-userlogin-1">
                    <input type="text" class="usrname-log-in" id="usrname-log" name="username"  value="{{ old('username') }}" placeholder="ระบุ Username ของคุณ" required>
                    <img src="{{ asset('user/img/รูปuserของหน้า login.png') }}" alt="รูปuserของหน้า login" class="img-userlogin">
                </div>
            </div>
            {{-- รหัสผ่าน --}}
            <div class="namelog-main-box">
                <label for="passwd-log" class="usrname-log-topic">รหัสผ่าน</label>
                <div class="img-userlogin-1">
                    <input type="password" class="usrname-log-in" id="passwd-log" name="password" placeholder="ระบุ Password ของคุณ" required>
                    <img src="{{ asset('user/img/รูปล็อกของหน้า login.png') }}" alt="รูปล็อกของหน้า" class="img-userlogin">
                    <button type="button" class="img-eye" id="img_eye_2">
                        <i class="fa-regular fa-eye" id="icon_eye_2"></i>
                    </button>
                </div>
            </div>
            {{-- จดจำรหัสผ่าน --}}
            <div class="remember-main-box">
                <input type="checkbox" class="check-remember-box" name="remember">
                <span>จดจำฉัน</span>
            </div>
        {{-- ปุ่มlogin --}}
        <div class="submit-log-mainbox">
            <button type="submit" class="login-btn">
                <span class="login-btn-1">เข้าสู่ระบบ</span>
                <img src="{{ asset('user/img/ลูกสรขวา.png') }}" alt="right-arrow" class="icon-arrow">
            </button>
        </div>
    </form>
    </div>
</div>
    <script src="{{ asset('user/js/JavaScript.js') }}"></script>
</body>
</html>