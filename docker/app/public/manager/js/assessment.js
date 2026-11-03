//ส่วนของหน้า assessment.blade.php
//ปุ่มกดรายการกิจกรรมของหน้า assessment.blade.php
const butactivity = document.getElementById('btn_activity')

if (butactivity) {
    butactivity.addEventListener('click', function() {
        document.getElementById('frame_grey').classList.add('active');
        document.getElementById('frame_evaluation').classList.remove('active');
        document.getElementById('btn_activity').classList.add('active');
        document.getElementById('btn_rate').classList.remove('active');
        document.getElementById('number_activity').classList.add('active');
        document.getElementById('number_rate').classList.remove('active');
        document.getElementById('assign_evaluation')?.close();
        moveBulb(butactivity);
        setTabUrl('activity');
    });
}

// if (butactivity){
// butactivity.addEventListener('click', function() {
//     document.getElementById('frame_grey').classList.add('active');
//     document.getElementById('frame_evaluation').classList.remove('active');
//     document.getElementById('btn_activity').classList.add('active');
//     document.getElementById('btn_rate').classList.remove('active');
//     document.getElementById('number_activity').classList.add('active');
//     document.getElementById('number_rate').classList.remove('active');
//     moveBulb(document.getElementById('btn_activity'));
// });
// }

//ปุ่มกดแบบประเมินของหน้า assessment.blade.php
const btnrate = document.getElementById('btn_rate')

if (btnrate) {
    btnrate.addEventListener('click', function() {
        document.getElementById('frame_evaluation').classList.add('active');
        document.getElementById('frame_grey').classList.remove('active');
        document.getElementById('btn_rate').classList.add('active');
        document.getElementById('btn_activity').classList.remove('active');
        document.getElementById('number_rate').classList.add('active');
        document.getElementById('number_activity').classList.remove('active');
        moveBulb(btnrate);
        setTabUrl('assessment'); // เพิ่มใหม่
    });
}

// if(btnrate){
// btnrate.addEventListener('click', function(){
//     document.getElementById('frame_evaluation').classList.add('active');
//     document.getElementById('frame_grey').classList.remove('active');
//     document.getElementById('btn_rate').classList.add('active');
//     document.getElementById('btn_activity').classList.remove('active');
//     document.getElementById('number_rate').classList.add('active');
//     document.getElementById('number_activity').classList.remove('active');
//     moveBulb(document.getElementById('btn_rate'));
// });
// }

//สั่งให้หลอดหน้ารายการกิจกรรมคำตามที่เรากดของหน้า assessment.blade.php
// function moveBulb(button) {
//     const bule = document.getElementById('bulb_yellow');
//     bule.style.marginLeft = button.offsetLeft + 'px';
// }
function moveBulb(button) {
    const bule = document.getElementById('bulb_yellow');
    bule.style.marginLeft = button.offsetLeft + 'px';
}
const activeTabBtn = document.querySelector('#btn_activity.active, #btn_rate.active');
if (activeTabBtn) moveBulb(activeTabBtn);


//การเป็นตัวเลขอัตโนมัตของรายการกิจกรรม
// function updatenumberactivity(){
//     //การเช็คว่ามีid นี้อยู่จริงมั้ยถ้ามีให้ทำต่อถ้าไม่มีให้ข้ามไป
//     const activitiesnumberassessment = document.getElementById('activities_number_assessment');
//     if(!activitiesnumberassessment){
//         return
//     }

//     const frameactivityassessment = document.querySelectorAll('.frame-activity-assessment');

//     let allactivities = 0;
//     let closed1 = 0;
//     let open1 = 0;

//     for (let i = 0; i < frameactivityassessment.length; i++) {
//         const frameactivity = frameactivityassessment[i];
//         const frameactivity1 = frameactivity.dataset.status;

//             allactivities++;
//         if (frameactivity1 === 'open'){
//             open1++;
//         }else if (frameactivity1 === 'closed'){
//             closed1++;
//         }else {
//             console.warn('พบสถานะที่ไม่รู้จัก', frameactivity1, frameactivity);
//         }
//     }

//     //ตัวเลขเปลี่ยนอัตโนมัตของ กิจกรรมทั้งหมด ปิดแล้ว เปิดอยู่
//     activitiesnumberassessment.textContent= allactivities
//     const closedassessment1 = document.getElementById('Closed_assessment_1');
//     closedassessment1.textContent= closed1
//     const openassessment1 = document.getElementById('open_assessment_1');
//     openassessment1.textContent = open1

//     //ตัวเลขเปลี่ยนอัตโนมัตของรายการกิจกรรม
//     const numberactivity = document.getElementById('number_activity');
//     numberactivity.textContent = allactivities
// }
// updatenumberactivity();






//ปุ่มทั้งหมดของหน้า assessment.blade.php
const frameallassessment =  document.getElementById('frameall_assessment');

if(frameallassessment){
    frameallassessment.addEventListener('click', function(){
        document.getElementById('frameall_assessment').classList.add('active');
        document.getElementById('frameoff_assessment').classList.remove('active');
        document.getElementById('farmeon_assessment').classList.remove('active');
        document.getElementById('all_assessment').classList.add('active');
        document.getElementById('off_assessment').classList.remove('active');
        document.getElementById('on_assessment').classList.remove('active');
        document.getElementById('allnumber_assessment').classList.add('active');
        document.getElementById('offnumber_assessment').classList.remove('active');
        document.getElementById('onnumber_assessment').classList.remove('active');

        alloffnoassessment('all');
    });
}
// if(frameallassessment){
//     frameallassessment.addEventListener('click', function(){
//         document.getElementById('frameall_assessment').classList.add('active');
//         document.getElementById('frameoff_assessment').classList.remove('active');
//         document.getElementById('farmeon_assessment').classList.remove('active');
//         document.getElementById('all_assessment').classList.add('active');
//         document.getElementById('off_assessment').classList.remove('active');
//         document.getElementById('on_assessment').classList.remove('active');
//         document.getElementById('allnumber_assessment').classList.add('active');
//         document.getElementById('offnumber_assessment').classList.remove('active');
//         document.getElementById('onnumber_assessment').classList.remove('active');

//         alloffnoassessment('all');
//     });
// }

//ปุ่มปิดแล้วของหน้า assessment.blade.php
const frameoffassessment = document.getElementById('frameoff_assessment');

if(frameoffassessment){
    frameoffassessment.addEventListener('click', function(){
        document.getElementById('frameoff_assessment').classList.add('active');
        document.getElementById('frameall_assessment').classList.remove('active');
        document.getElementById('farmeon_assessment').classList.remove('active');
        document.getElementById('off_assessment').classList.add('active');
        document.getElementById('all_assessment').classList.remove('active');
        document.getElementById('on_assessment').classList.remove('active');
        document.getElementById('offnumber_assessment').classList.add('active');
        document.getElementById('allnumber_assessment').classList.remove('active');
        document.getElementById('onnumber_assessment').classList.remove('active');

        alloffnoassessment('closed');
    });
}

//ปุ่มเปิดอยู่ของหน้า assessment.blade.php
const frameonassessment = document.getElementById('farmeon_assessment')

if(frameonassessment){
    frameonassessment.addEventListener('click', function(){
        document.getElementById('farmeon_assessment').classList.add('active');
        document.getElementById('frameoff_assessment').classList.remove('active');
        document.getElementById('frameall_assessment').classList.remove('active');
        document.getElementById('on_assessment').classList.add('active');
        document.getElementById('off_assessment').classList.remove('active');
        document.getElementById('all_assessment').classList.remove('active');
        document.getElementById('onnumber_assessment').classList.add('active');
        document.getElementById('offnumber_assessment').classList.remove('active');
        document.getElementById('allnumber_assessment').classList.remove('active');

        alloffnoassessment('open');
    });
}
// if(frameonassessment){
//     frameonassessment.addEventListener('click', function(){
//         document.getElementById('farmeon_assessment').classList.add('active');
//         document.getElementById('frameoff_assessment').classList.remove('active');
//         document.getElementById('frameall_assessment').classList.remove('active');
//         document.getElementById('on_assessment').classList.add('active');
//         document.getElementById('off_assessment').classList.remove('active');
//         document.getElementById('all_assessment').classList.remove('active');
//         document.getElementById('onnumber_assessment').classList.add('active');
//         document.getElementById('offnumber_assessment').classList.remove('active');
//         document.getElementById('allnumber_assessment').classList.remove('active');

//         alloffnoassessment('open');
//     });
// }

//กดปุ่มทั้งหมด ปิดอยู่ เปิดแล้ว ให้มันเข้าไปอยู่ในสถานะปุ่มของตัวมันเอง assessment.blade.php
function alloffnoassessment(status){
    const lookforname = document.querySelectorAll('.sectionassessment');
    for (let i = 0; i < lookforname.length; i++) {
        const frame = lookforname[i];
        const framestatus = frame.dataset.status;
        if (status === 'all') {
            frame.style.display = '';
        } else if (framestatus === status) {
            frame.style.display = '';
        } else {
            frame.style.display = 'none';
        }
    }

}
// function alloffnoassessment(status){
//     const lookforname = document.querySelectorAll('.sectionassessment');
//     for (let i = 0; i < lookforname.length; i++) {
//         const frame = lookforname[i];
//         const framestatus = frame.dataset.status;
//         if (status === 'all') {
//             frame.style.display = '';
//         } else if (framestatus === status) {
//             frame.style.display = '';
//         } else {
//             frame.style.display = 'none';
//         }
//     }

// }

//เปลี่ยนค่าตัวเลขอัตโนมัตใน ปุ่มทั้งหมด ปุ่มปิดแล้ว เปิดอยู่ assessment.blade.php
function updatenumberassessment() {
    const allnumberassessment =  document.getElementById('allnumber_assessment');
     if (!allnumberassessment) {
        return;
    }

    const lookforname1 = document.querySelectorAll('.sectionassessment');
    
    let allnumber = 0;
    let opennumber = 0;
    let closednumber = 0;

    for (let i = 0; i < lookforname1.length; i++){
        const number = lookforname1[i];
        const numberstatus = number.dataset.status;

            allnumber++;
        if (numberstatus === 'open') {
            opennumber++;
        }else if (numberstatus === 'closed'){
            closednumber++;
        } else {
            console.warn('พบสถานะที่ไม่รู้จัก', numberstatus, number);
        }


    }
    
    //เปลี่ยนตัวแลขอัตโนมัตของปุ่ม ทั้งหมด ปิดแล้ว เปิดอยู่
    allnumberassessment.textContent='(' + allnumber + ')';
    const nonumberassessment = document.getElementById('onnumber_assessment');
    nonumberassessment.textContent='(' + opennumber + ')';
    const offnumberassessment = document.getElementById('offnumber_assessment');
    offnumberassessment.textContent='(' + closednumber  + ')';
     //เปลี่ยนตัวแลขอัตโนมัตของปุ่ม แบบประเมิน
    const numberrate = document.getElementById('number_rate');
    numberrate.textContent= allnumber;
}
updatenumberassessment();



//ช่องค้นหารายชื่อกิจกรรม ในหน้า assessment.blade.php
const framesearchactivity = document.getElementById('frame_search_activity');

if (framesearchactivity) {
    let searchTimer;
    framesearchactivity.addEventListener('input', function () {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(function () {
            framesearchactivity.form.submit();
        }, 250); // รอให้หยุดพิมพ์ วินาที
    });

    // หลังรีโหลด ให้เคอร์เซอร์กลับมาท้ายคำค้นหา
    if (framesearchactivity.value) {
        framesearchactivity.focus();
        const len = framesearchactivity.value.length;
        framesearchactivity.setSelectionRange(len, len);
    }
}

//ช่องค้นหารายชื่อแบบประเมิน ในหน้า assessment.blade.php
const framesearchassessment = document.getElementById('frame_search_activity_2');

if(framesearchassessment){
    framesearchassessment.addEventListener('keyup', function(){
        
        const keywordassessment = framesearchassessment.value.trim().toLowerCase();
        const frameactivityassessment = document.querySelectorAll('.sectionassessment');

        frameactivityassessment.forEach(function (card){
            const nameassessment = card.querySelector('.sectionassessment-1');
            if (!nameassessment)
                return;

            const  nameassessment1 = nameassessment.textContent.trim().toLowerCase();

            if(nameassessment1.includes(keywordassessment)){
                card.classList.remove('is-hidden');
            }else{
                card.classList.add('is-hidden');
            }
        });

    })
}