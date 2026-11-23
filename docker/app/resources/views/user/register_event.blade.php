<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงทะเบียนเข้าร่วมกิจกรรม</title>
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}?v={{ filemtime(public_path('user/css/style.css')) }}">
    <link rel="stylesheet" href="{{ asset('user/css/theme-user.css') }}?v={{ filemtime(public_path('user/css/theme-user.css')) }}">
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
            <div class="sectionactivity-1">
                <span class="sectionactivity">{{ $event->title }}</span>
                <span class="messageregisterreward">ลงทะเบียนก่อนหมดเวลาเพื่อสิทธิ์ลุ้นรางวัล</span>
            </div>
            <div class="frametimeactivityreward">
                <h1 class="numbertime" id="number_time" data-seconds="{{ $remainingseconds }}">00:00</h1>
            </div>
        </div>

        @if($alreadyRegistered)
        <div class="frameimgregister_event">
            <div class="frameimgregister_event-1">
                <img src="{{ asset('user/img/รูปติกถูกหน้าลงทะเบียน.png') }}" alt="รูปติกถูกหน้าลงทะเบียน" class="imgregister_event">
                <div class="messageregister_event">
                    <span class="messageregister_event-1">ลงทะเบียนเข้าร่วมเรียบร้อย</span>
                    <span class="messageregister_event-2">คุณมีสิทธิ์ลุ้นรางวัลเมื่อปิดลงทะเบียน</span>
                </div>
            </div>
        </div>

            @if(auth()->check() && auth()->user()->role === 'user')
                <a href="{{ route('user.home') }}" class="btn-backhome">กลับไปหน้าหลัก</a>
            @elseif(!auth()->check())
                <a href="{{ route('login') }}" class="btn-backhome">เข้าสู่ระบบ</a>
            @endif
        @else
        <form id="framedata_framework" action="{{ route('user.register.store', $event->event_id) }}" method="POST">
            @csrf
            <div class="framedataframework">
                <p class="messagedata_framework">กรอกข้อมูลเพื่อลงทะเบียน</p>
                @if(($extraLeft ?? 0) > 0)
                    <p class="savesuccessimage-errordataframework" style="color:#1F7A47;">คุณได้รับสิทธิ์ลงทะเบียนเพิ่มอีก {{ $extraLeft }} ครั้ง กดปุ่มด้านล่างได้เลย</p>
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
                @error('full_name')
                    <p class="savesuccessimage-error-2">{{ $message }}</p>
                @enderror
                @if($nameLocked ?? false)
                    {{-- ลงเพิ่ม: ล็อกชื่อไว้เป็นชื่อเดิม คลิกหรือพิมพ์ไม่ได้ (controller ใช้ชื่อเดิมจากฐานข้อมูลเอง) --}}
                    <input type="text" class="dataframeworkfullname" value="{{ $prefillName }}" id="dataframe_workfullname" disabled>
                @else
                    <input type="text" name="full_name" class="dataframeworkfullname" value="{{ old('full_name', $prefillName ?? '') }}" placeholder="กรอกชื่อ-นามสกุล" autocomplete="name" id="dataframe_workfullname">
                @endif

                <button type="submit" class="btn-registerparticipate">
                    <p class="messageregisterparticipate">ลงทะเบียนเข้าร่วม</p>
                </button>
            </div>
        </form>
        @endif


               <div class="framepersonRegistrant">
            @php
                // รวมการลงทะเบียนของคนเดียวกันไว้แถวเดียว แบบเดียวกับหน้ารายละเอียดกิจกรรมของ admin
                $people = $event->registrations->groupBy(fn ($r) => $r->user_id
                    ? 'u'.$r->user_id
                    : ($r->guest_token ? 'g'.$r->guest_token : 'r'.$r->registration_id));
            @endphp
            <div class="framepersonRegistrantnumberpeople">
                <p class="pointtopicpage"></p>
                <span class="messagepersonRegistrant">ผู้ลงทะเบียนแล้ว</span>
                <div class="frmaenumberpeople">
                    <p class="messagenumberpeople">{{ $people->count() }} คน</p>
                </div>
            </div>
            <hr class="linepersonRegistrant">
            @forelse($people as $rows)
            @php
                $first  = $rows->first();
                $rights = $rows->count();
                $isMine = $rows->pluck('registration_id')->intersect($myRegistrationIds ?? [])->isNotEmpty();
            @endphp
            <div class="framefullname-timepersonRegistrant">
                <div class="numbertopicpagfullnamee">
                    <p class="messatopicpagfullnamee">{{ $loop->iteration }}</p>
                </div>
                <div class="fullnameRegistrant">
                    <p class="fullnameRegistrant-1">{{ $first->full_name }}@if($isMine) (คุณ)@endif</p>
                    @if($rights > 1)
                        <span class="rights-badge">{{ $rights }} สิทธิ์</span>
                    @endif
                </div>
                <div class="timepersonRegistrant">
                    <span class="timepersonRegistrant-1">{{ $first->registered_at?->format('H:i') }} น.</span>
                </div>
            </div>
            <hr class="linepersonRegistrant-1">
            @empty
            <div class="reg-empty">
                <p class="reg-empty1">ยังไม่มีผู้ลงทะเบียน เป็นคนแรกเลย</p>
            </div>
            @endforelse
        </div>


    </div>
</div>
    
    <script src="{{ asset('user/js/JavaScript.js') }}"></script>
</body>
</html>