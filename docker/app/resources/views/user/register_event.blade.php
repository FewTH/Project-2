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


<!--เอาไว้ควบคุมส่วนกลางของเว็บปิดล่างสุด-->
<div class="main-content-register">

    <div class="framebigregisterevent">
        <div class="img-buuburaphauniversity">
            <img src="{{ asset('user/img/รูปโลโก้buuburaphauniversity.png') }}" alt="รูปโลโก้buuburaphauniversity">
        </div>

        <div class="frmaesectionactivity">
            <p class="sectionactivity">{{ $event->title }}</p>
            <span class="messageregisterreward">ลงทะเบียนก่อนหมดเวลาเพื่อสิทธิ์ลุ้นรางวัล!</span>
            <div class="frametimeactivityreward">
                <h1 class="numbertime" id="number_time" data-seconds="{{ $remainingseconds }}">00:00</h1>
            </div>
        </div>

        <form id="framedata_framework" action="{{ route('user.register.store', $event->event_id) }}" method="POST">
            @csrf
            <div class="framedataframework">
                <p class="messagedata_framework">กรอกข้อมูลเพื่อลงทะเบียน</p>

                @if(session('success'))
                <div class="savesuccessdataframework">
                    <p class="savesuccessdataframework-1"> {{ session('success') }}</p>
                </div>
                @endif

                @error('status')
                        <p class="savesuccessimage-errordataframework">{{ $message }}</p>
                @enderror

                @error('limitmax')
                        <p class="savesuccessimage-errordataframework">{{ $message }}</p>
                @enderror


                <label class="framedataframeworkname" for="dataframe_workfullname">
                    <p class="messagename">ชื่อ-นามสกุล</p>
                    <span class="asteriskdataframe">*</span> 
                </label>
                <input type="text" name="full_name" class="dataframeworkfullname" value="{{ old('full_name') }}" placeholder="กรอกชื่อ-นามสกุล" autocomplete="name" id="dataframe_workfullname">
                    @error('full_name')
                            <p class="savesuccessimage-error-1">{{ $message }}</p>
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