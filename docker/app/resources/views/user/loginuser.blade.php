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
        <img src="{{ asset('user/img/โลโก้buuไม่มีพื้นหลัง.png') }}" alt="โลโก้แนวนอน" width="150" class="buulogonobg">
            <div class="descripppy">
                <h2 class="logintext1">เข้าสู่ระบบ</h2>
                <h5 class="logintext2">กรุณาเข้าสู่ระบบเพื่อใช้งานระบบ</h5>
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
                <label for="usrname-log-in" class="usrname-log-topic">ชื่อผู้ใช้</label><br>
                <input type="text" class="usrname-log-in" id="usrname-log" name="username"  value="{{ old('username') }}" placeholder="ระบุusernameของคุณ" required>
            </div>
            {{-- รหัสผ่าน --}}
            <div class="passwdlog-main-box">
                <label for="passwd-log-in" class="passwd-log-topic">รหัสผ่าน</label><br>
                <input type="password" class="passwd-log-in" id="passwd-log" name="password" placeholder="ระบุรหัสผ่านของคุณ" required>
            </div>
            {{-- จดจำรหัสผ่าน --}}
            <div class="remember-main-box">
                <label class="remember-txt">
                    <input type="checkbox" class="check-remember-box" name="remember">
                    <span>จดจำฉัน</span>
                </label>
            </div>
        {{-- ปุ่มlogin --}}
        <div class="submit-log-mainbox">
            <button type="submit" class="login-btn">
                <span>เข้าสู่ระบบ</span>
                <img src="{{ asset('user/img/ลูกสรขวา.png') }}" alt="right-arrow" class="icon-arrow">
            </button>
        </div>
    </form>
    </div>
</body>
</html>