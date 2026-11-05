//ส่วนของหน้า assessment.blade.php (manager)

//สั่งให้หลอดหน้ารายการกิจกรรมตามที่เรากด
function moveBulb(button) {
    const bule = document.getElementById('bulb_yellow');
    if (bule) bule.style.marginLeft = button.offsetLeft + 'px';
}

// จำแท็บไว้ใน URL เวลากดสลับเอง จะได้ไม่หายตอนรีเฟรช
function setTabUrl(tab) {
    const url = new URL(window.location);
    url.searchParams.set('tab', tab);
    history.replaceState(null, '', url);
}

//ปุ่มกดรายการกิจกรรม
const butactivity = document.getElementById('btn_activity');

if (butactivity) {
    butactivity.addEventListener('click', function () {
        document.getElementById('frame_grey').classList.add('active');
        document.getElementById('frame_evaluation').classList.remove('active');
        document.getElementById('btn_activity').classList.add('active');
        document.getElementById('btn_rate').classList.remove('active');
        document.getElementById('number_activity').classList.add('active');
        document.getElementById('number_rate').classList.remove('active');
        moveBulb(butactivity);
        setTabUrl('activity');
    });
}

//ปุ่มกดแบบประเมิน
const btnrate = document.getElementById('btn_rate');

if (btnrate) {
    btnrate.addEventListener('click', function () {
        document.getElementById('frame_evaluation').classList.add('active');
        document.getElementById('frame_grey').classList.remove('active');
        document.getElementById('btn_rate').classList.add('active');
        document.getElementById('btn_activity').classList.remove('active');
        document.getElementById('number_rate').classList.add('active');
        document.getElementById('number_activity').classList.remove('active');
        moveBulb(btnrate);
        setTabUrl('assessment');
    });
}

const activeTabBtn = document.querySelector('#btn_activity.active, #btn_rate.active');
if (activeTabBtn) moveBulb(activeTabBtn);

// ===== ค้นหา/กรองแบบประเมินทั้งระบบ (ส่งไปให้ controller กรอง) =====
function goAssessmentFilter(params) {
    const url = new URL(window.location.href);
    url.searchParams.set('tab', 'assessment');
    url.searchParams.delete('assessment_page');          // กลับไปหน้า 1 เสมอ
    Object.entries(params).forEach(([key, value]) => {
        if (value) url.searchParams.set(key, value);
        else url.searchParams.delete(key);
    });
    window.location.href = url.toString();
}

// ปุ่ม ทั้งหมด / ปิดแล้ว / เปิดอยู่
const statusButtons = {
    frameall_assessment: '',
    frameoff_assessment: 'closed',
    farmeon_assessment:  'open',
};
Object.entries(statusButtons).forEach(([id, status]) => {
    const btn = document.getElementById(id);
    if (btn) {
        btn.addEventListener('click', () => goAssessmentFilter({ assessment_status: status }));
    }
});

// ช่องค้นหาแบบประเมิน
const framesearchassessment = document.getElementById('frame_search_activity_2');
if (framesearchassessment) {
    let assessTimer;
    framesearchassessment.addEventListener('input', function () {
        clearTimeout(assessTimer);
        assessTimer = setTimeout(function () {
            goAssessmentFilter({ assessment_search: framesearchassessment.value.trim() });
        }, 400);
    });

    // หลังรีโหลด คืนเคอร์เซอร์ไว้ท้ายคำค้นหา
    if (framesearchassessment.value) {
        framesearchassessment.focus();
        const len = framesearchassessment.value.length;
        framesearchassessment.setSelectionRange(len, len);
    }
}

//ช่องค้นหารายชื่อกิจกรรม (ส่งฟอร์มไปค้นทั้งระบบ)
const framesearchactivity = document.getElementById('frame_search_activity');

if (framesearchactivity && framesearchactivity.form) {
    let searchTimer;
    framesearchactivity.addEventListener('input', function () {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(function () {
            framesearchactivity.form.submit();
        }, 250);
    });

    if (framesearchactivity.value) {
        framesearchactivity.focus();
        const len = framesearchactivity.value.length;
        framesearchactivity.setSelectionRange(len, len);
    }
}