<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงทะเบียนเข้าร่วมกิจกรรม</title>
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="icon" href="{{ asset('user/img/Logo.png') }}">
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
<div class="main-content-register">
    <!-- ชื่อโปรไฟล์-->  
    <div class="My_Profile">
        <h1>ลงทะเบียนเข้าร่วมกิจกรรม</h1>
    </div>

    <div class="framebigregisterevent">
        <div class="img-buuburaphauniversity">
            <img src="{{ asset('user/img/รูปโลโก้buuburaphauniversity.png') }}" alt="รูปโลโก้buuburaphauniversity">
        </div>

        <div class="frmaesectionactivity">
            <p class="sectionactivity">{{ $event->title }}</p>
            <span class="messageregisterreward">ลงทะเบียนก่อนหมดเวลาเพื่อสิทธิ์ลุ้นรางวัล!</span>
            <div class="frametimeactivityreward">
                <h1 class="timeactivityrewards">10:00</h1>
            </div>
        </div>

        <form id="framedata_framework" action="{{ route('user.register.store', $event->event_id) }}" method="POST">
            @csrf
            <div class="framedataframework">
                <p class="messagedata_framework">กรอกข้อมูลเพื่อลงทะเบียน</p>

                @if(session('success'))
                <div class="successdataframework">{{ session('success') }}</div>
                @endif

                @error('status')
                        <p class="savesuccessimage-error">{{ $message }}</p>
                @enderror

                @error('limitmax')
                        <p class="savesuccessimage-error">{{ $message }}</p>
                @enderror


                <label class="framedataframeworkname" for="dataframe_workfullname">
                    <p class="messagename">ชื่อ-นามสกุล</p>
                    <span class="asteriskdataframe">*</span> 
                </label>
                <input type="text" name="full_name" class="dataframeworkfullname" value="{{ old('full_name') }}" placeholder="กรอกชื่อ-นามสกุล" autocomplete="name" id="dataframe_workfullname">
                @error('full_name')
                        <p class="savesuccessimage-error">{{ $message }}</p>
                @enderror

                <label class="framedataframeworkname" for="dataframe_workemail">
                    <p class="messagename">อีเมล</p>
                    <span class="asteriskdataframe">*</span>
                </label>
                <input type="email" name="email" class="dataframeworkfullname" value="{{ old('email') }}" placeholder="กรอบอีเมล" autocomplete="email" id="dataframe_workemail">
                @error('email')
                        <p class="savesuccessimage-error">{{ $message }}</p>
                @enderror
                
                <button type="submit" class="btn-registerparticipate">
                    <p class="messageregisterparticipate">ลงทะเบียนเข้าร่วม</p>
                </button>
            </div>
        </form>


        <div class="framepersonRegistrant">
            <div class="framepersonRegistrantnumberpeople">
                <p class="pointtopicpage"></p>
                <span class="messagepersonRegistrant">ผู้ลงทะเบียนแล้ว</span>
                <div class="frmaenumberpeople">
                    <p class="messagenumberpeople">{{ $event->registrations->count() }}คน</p>
                </div>
            </div>
            <hr class="linepersonRegistrant">
            @foreach($event->registrations as $index => $registration)
            <div class="framefullname-timepersonRegistrant">
                <div class="numbertopicpagfullnamee">
                    <p class="messatopicpagfullnamee">{{ $index + 1 }}</p>
                </div>
                <div class="fullnameRegistrant">
                    <p class="fullnameRegistrant-1">{{ $registration->full_name }}</p>
                    <span class="emailparticipants">{{ $registration->email }}</span>
                </div>
                <div class="timepersonRegistrant">
                    <span class="timepersonRegistrant-1">{{ $registration->registered_at->format('H:i') }} น.</span>
                </div>
            </div>
            <hr class="linepersonRegistrant-1">
            @endforeach
        </div>


    </div>
</div>
    
    <script src="{{ asset('user/js/JavaScript.js') }}"></script>
</body>
</html>