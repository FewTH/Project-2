<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/theme-user.css') }}">
    <title>BUUGIFT</title>
    {{-- แถบเมนูซ้ายใช้ style จาก style.css + theme-user.css (คลาส container-home / btn-Sidebar-home / btn-Home1 / btn-logout1)
         ส่วนที่เหลือของหน้านี้ใช้ style ในตัวเอง (คลาสขึ้นต้นด้วย bg-) --}}
    <style>
        :root{
            --ink:#1f1d36; --ink-2:#2b2849; --wine:#5a1f3a; --crimson:#e11d48;
            --gold:#d9a512; --gold-soft:#fbf1cf; --paper:#f4f5fa; --card:#fff;
            --text:#1b1a2e; --muted:#6b6a80; --line:#e8e8f0;
        }
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:var(--font);color:var(--text);min-height:100vh;min-width:0;
            background:radial-gradient(900px 500px at 85% -5%,#f3dbe6 0,transparent 60%),var(--paper);}
        a{text-decoration:none;color:inherit}

        /* ---------- main ---------- */
        .bg-main{margin-left:280px;min-height:100vh}
        .bg-top{height:57px;display:flex;align-items:center;justify-content:flex-end;padding:0 35px 0 28px;
            background:rgba(255,255,255,.72);-webkit-backdrop-filter:saturate(180%) blur(16px);backdrop-filter:saturate(180%) blur(16px);
            border-bottom:1px solid rgba(20,22,40,.06);box-shadow:0 6px 20px rgba(20,22,40,.06); position:sticky;top:0;z-index:10}
        .bg-user{display:flex;align-items:center;gap:15px;font-size:16px;font-weight:600;color:var(--heading);transition:color .2s ease}
        .bg-user:hover{color:var(--primary)}
        .bg-user img{width:42px;height:42px;border-radius:50%;object-fit:cover;border:2px solid var(--primary);background:#f2f2f2}
        .bg-wrap{padding:26px 32px 48px}

        /* ---------- hero ---------- */
        .bg-hero{position:relative;overflow:hidden;border-radius:26px;color:#fff;
            padding:44px 48px;min-height:290px;display:grid;grid-template-columns:1.2fr .8fr;align-items:center;
            background:linear-gradient(120deg,var(--ink) 0%,var(--wine) 100%);
            box-shadow:0 18px 40px -18px rgba(90,31,58,.55)}
        .bg-hero h1{font-size:40px;line-height:1.25;font-weight:700;margin-bottom:10px}
        .bg-hero p{color:#e7d9e3;font-size:16px;max-width:460px;line-height:1.7;margin-bottom:26px}
        .bg-cta{display:inline-flex;align-items:center;gap:10px;background:var(--gold);color:#2a1d00;
            padding:14px 28px;border-radius:999px;font-weight:600;font-size:16px;
            box-shadow:0 10px 22px -8px rgba(217,165,18,.7);transition:transform .15s}
        .bg-cta:hover{transform:translateY(-2px)}
        .bg-cta svg{width:20px;height:20px}
        .bg-hero-stats{display:flex;gap:34px;margin-top:30px}
        .bg-hero-stats b{display:block;font-size:26px;font-weight:700;color:var(--gold)}
        .bg-hero-stats span{font-size:13px;color:#d9c7d3}

        /* วงล้อสุ่มรางวัล - จุดเด่นของหน้า */
        .bg-wheel-box{position:relative;justify-self:center;width:260px;height:260px}
        .bg-wheel{width:100%;height:100%;border-radius:50%;
            background:conic-gradient(var(--gold) 0 45deg,#fff 0 90deg,var(--crimson) 0 135deg,#fff 0 180deg,
                var(--gold) 0 225deg,#fff 0 270deg,var(--crimson) 0 315deg,#fff 0 360deg);
            border:10px solid #f6d36b;box-shadow:0 0 0 6px rgba(255,255,255,.12),0 24px 50px -10px rgba(0,0,0,.5);
            animation:bg-spin 14s linear infinite}
        .bg-wheel-hub{position:absolute;inset:50% auto auto 50%;transform:translate(-50%,-50%);
            width:70px;height:70px;border-radius:50%;background:var(--ink);border:5px solid #f6d36b;
            display:grid;place-items:center}
        .bg-wheel-hub svg{width:32px;height:32px;color:var(--gold)}
        .bg-pointer{position:absolute;top:-14px;left:50%;transform:translateX(-50%);width:0;height:0;
            border-left:15px solid transparent;border-right:15px solid transparent;border-top:30px solid #fff;
            filter:drop-shadow(0 4px 4px rgba(0,0,0,.35));z-index:2}
        @keyframes bg-spin{to{transform:rotate(360deg)}}

        /* ---------- section ---------- */
        .bg-sec{margin-top:28px}
        .bg-sec-head{display:flex;align-items:baseline;justify-content:space-between;margin-bottom:14px}
        .bg-sec-head h2{font-size:20px;font-weight:600}
        .bg-sec-head small{color:var(--muted);font-size:13px}

        /* ---------- ของรางวัลยอดนิยม ---------- */
        .bg-pop{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}
        .bg-prize{position:relative;background:var(--card);border-radius:20px;padding:26px 22px 22px;
            display:flex;align-items:center;gap:18px;border:1px solid var(--line);
            box-shadow:0 8px 24px -16px rgba(31,29,54,.35)}
        .bg-prize-ico{flex:none;width:72px;height:72px;border-radius:20px;display:grid;place-items:center;
            background:var(--gold-soft);color:#b98600}
        .bg-prize-ico svg{width:38px;height:38px}
        .bg-prize h3{font-size:17px;font-weight:600;line-height:1.35}
        .bg-prize p{font-size:13px;color:var(--muted);margin-top:4px}
        .bg-rank{position:absolute;top:-12px;left:18px;font-size:12px;font-weight:700;padding:4px 14px;border-radius:999px;color:#fff;background:#8b8aa3}
        .bg-prize.r1{border-color:#f0d27a}
        .bg-prize.r1 .bg-rank{background:var(--gold);color:#2a1d00}
        .bg-prize.r2 .bg-rank{background:#8f93a8}
        .bg-prize.r3 .bg-rank{background:#b9774a}
        .bg-empty{grid-column:1/-1;text-align:center;padding:34px;color:var(--muted);background:var(--card);border-radius:20px;border:1px dashed var(--line)}

        /* ---------- สองคอลัมน์ล่าง ---------- */
        .bg-cols{display:grid;grid-template-columns:1fr 1fr;gap:20px;align-items:start}
        .bg-panel{background:var(--card);border-radius:20px;border:1px solid var(--line);overflow:hidden;
            box-shadow:0 8px 24px -16px rgba(31,29,54,.35)}
        .bg-panel-head{display:flex;align-items:center;gap:10px;padding:16px 22px;font-weight:600;font-size:16px;
            background:#f8f8fc;border-bottom:1px solid var(--line)}
        .bg-panel-head svg{width:20px;height:20px;color:var(--wine)}
        .bg-row{display:flex;align-items:center;gap:14px;padding:14px 22px;border-bottom:1px solid var(--line)}
        .bg-row:last-child{border-bottom:0}
        .bg-dot{flex:none;width:34px;height:34px;border-radius:50%;background:#eef0fb;color:var(--ink-2);
            display:grid;place-items:center;font-size:14px;font-weight:600}
        .bg-dot.gift{background:var(--gold-soft);color:#b98600}
        .bg-dot svg{width:18px;height:18px}
        .bg-row .t{flex:1;font-size:15px;font-weight:500}
        .bg-row .d{font-size:12.5px;color:var(--muted)}
        .bg-tag{font-size:12px;font-weight:500;padding:4px 12px;border-radius:999px;background:#e6f6ec;color:#17794a}
        .bg-none{padding:38px 22px;text-align:center;color:var(--muted)}
        .bg-none a{display:inline-block;margin-top:12px;padding:9px 20px;border-radius:999px;background:var(--wine);color:#fff;font-size:14px;font-weight:500}

        @media (max-width:1100px){
            .bg-hero{grid-template-columns:1fr}.bg-wheel-box{display:none}
            .bg-pop,.bg-cols{grid-template-columns:1fr}
        }
        /* มือถือ: theme-user.css ย้ายเมนูซ้ายไปเป็นแถบล่างจอ เนื้อหาจึงต้องเต็มจอและเว้นล่างไว้ */
        @media (max-width:900px){
            .bg-main{margin-left:0;padding-bottom:84px}
            .bg-top{height:56px;padding:0 16px}
            .bg-user{font-size:15px;gap:10px}
            .bg-user img{width:36px;height:36px}
        }
        @media (max-width:760px){
            .bg-hero{padding:30px 24px}.bg-hero h1{font-size:30px}
        }
        @media (prefers-reduced-motion:reduce){.bg-wheel{animation:none}.bg-cta{transition:none}}
        a:focus-visible{outline:3px solid var(--gold);outline-offset:2px}
    </style>
</head>
<body>

<!-- ================= Sidebar (ใช้ style จาก style.css + theme-user.css) ================= -->
<aside class="container-home">
    <div class="img-Logo-home">
        <img src="{{ asset('user/img/Logo.png') }}" alt="โลโก้มหาวิทยาลัยบูรพา" class="Logo-img">
    </div>

    <div class="btn-Sidebar-home">
        <a href="{{ url('user/home') }}" class="btn-Home1">
            <img src="{{ asset('user/img/homelogo1.png') }}" alt="">
            หน้าหลัก
        </a>
        <a href="{{ url('user/spin') }}">
            <img src="{{ asset('user/img/Random.png') }}" alt="">
            สุ่มของรางวัล
        </a>
        <a href="{{ url('user/contact') }}">
            <img src="{{ asset('user/img/Contact.png') }}" alt="">
            ติดต่อเรา
        </a>
    </div>

    <div class="btn-logout-wrapper1">
        <a href="{{ url('user/loginuser') }}" class="btn-logout1">
            <img src="{{ asset('user/img/รูปปุ่มกดออก.png') }}" alt="รูปออกจากระบบ" class="btn-logout-img4">
            ออกจากระบบ
        </a>
    </div>
</aside>

<!-- ================= Main ================= -->
<div class="bg-main">
    <header class="bg-top">
        <a href="{{ url('user/profile') }}" class="bg-user">
            @if($user?->profile_image)
                <img src="{{ asset('storage/'.$user->profile_image) }}" alt="รูปผู้ใช้งาน">
            @else
                <img src="{{ asset('user/img/รูปuser.png') }}" alt="รูปผู้ใช้งาน">
            @endif
            <span>{{ $user?->name ?? 'User' }}</span>
        </a>
    </header>

    <main class="bg-wrap">

        <!-- Hero -->
        <section class="bg-hero">
            <div>
                <h1>ยินดีต้อนรับสู่ระบบสุ่มของรางวัล</h1>
                <p>ทำแบบประเมินให้ครบ แล้วนำสิทธิ์มาสุ่มรับของรางวัลได้ที่นี่</p>
                <a href="{{ url('user/spin') }}" class="bg-cta">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13"/><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/><path d="M7.5 8a2.5 2.5 0 0 1 0-5C11 3 12 8 12 8s1-5 4.5-5a2.5 2.5 0 0 1 0 5"/></svg>
                    ดูผลการสุ่มเลย
                </a>
                <div class="bg-hero-stats">
                    <div><b>{{ $latestAssessments->count() }}</b><span>แบบประเมินที่ทำแล้ว</span></div>
                    <div><b>{{ $winReward->count() }}</b><span>รางวัลที่ได้รับ</span></div>
                </div>
            </div>

            <div class="bg-wheel-box" aria-hidden="true">
                <div class="bg-pointer"></div>
                <div class="bg-wheel"></div>
                <div class="bg-wheel-hub">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.9 6.3 6.9.7-5.2 4.6 1.5 6.8L12 16.9 5.9 20.4l1.5-6.8L2.2 9l6.9-.7z"/></svg>
                </div>
            </div>
        </section>

        <!-- ของรางวัลยอดนิยม -->
        <section class="bg-sec">
            <div class="bg-sec-head">
                <h2>ของรางวัลยอดนิยม</h2>
                <small>ถูกสุ่มได้บ่อยที่สุด</small>
            </div>
            <div class="bg-pop">
                @forelse($popularRewards as $index => $reward)
                    <div class="bg-prize r{{ $index + 1 }}">
                        <span class="bg-rank">อันดับ {{ $index + 1 }}</span>
                        <div class="bg-prize-ico">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13"/><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/><path d="M7.5 8a2.5 2.5 0 0 1 0-5C11 3 12 8 12 8s1-5 4.5-5a2.5 2.5 0 0 1 0 5"/></svg>
                        </div>
                        <div>
                            <h3>{{ $reward->name }}</h3>
                            <p>ของรางวัลยอดนิยม</p>
                        </div>
                    </div>
                @empty
                    <div class="bg-empty">ยังไม่มีข้อมูลของรางวัล</div>
                @endforelse
            </div>
        </section>

        <!-- แบบประเมิน + ของรางวัลที่เคยได้ -->
        <section class="bg-sec bg-cols">
            <div class="bg-panel">
                <div class="bg-panel-head">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    แบบประเมินที่ทำล่าสุด
                </div>
                @forelse($latestAssessments as $item)
                    <div class="bg-row">
                        <div class="bg-dot">{{ $loop->iteration }}</div>
                        <div class="t">{{ $item->name }}</div>
                        <span class="bg-tag">สุ่มแล้ว</span>
                    </div>
                @empty
                    <div class="bg-none">
                        ยังไม่มีประวัติการทำแบบประเมิน
                    </div>
                @endforelse
            </div>

            <div class="bg-panel">
                <div class="bg-panel-head">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.5 13.5L17 22l-5-3-5 3 1.5-8.5"/></svg>
                    ของรางวัลที่เคยได้รับ
                </div>
                @forelse($winReward as $item)
                    <div class="bg-row">
                        <div class="bg-dot gift">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13"/><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/></svg>
                        </div>
                        <div class="t">{{ $item->reward->name ?? 'ของรางวัล' }}</div>
                        <div class="d">ได้รับเมื่อ {{ $item->created_at ? $item->created_at->format('d/m/Y') : '-' }}</div>
                    </div>
                @empty
                    <div class="bg-none">
                        ท่านยังไม่เคยได้รับรางวัล
                        <br><a href="{{ url('user/spin') }}">ไปดูผลการสุ่มแรก</a>
                    </div>
                @endforelse
            </div>
        </section>

    </main>
</div>

</body>
</html>