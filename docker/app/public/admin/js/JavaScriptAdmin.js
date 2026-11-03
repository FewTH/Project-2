//ส่วนของหน้า create_activity.blade.php
//ปุ่มบวกลบตัวเลขลองเลือกของรางวัล
function addnumberquantity(inputId, maxLimit){
    let inputid = document.getElementById(inputId);

    if (parseInt(inputid.value) < maxLimit){
        inputid.value = parseInt(inputid.value) + 1;
    }
}
function deletenumberquantity(inputId){
    let inputid = document.getElementById(inputId);

    if (parseInt(inputid.value) > 1){
        inputid.value = parseInt(inputid.value) - 1;
    }
}

//ต้องกดปุ่มติ๊กถูกถึงจะเลือกของรางวัลได้
function checkmarkbutton(rewardId){
    const checkbox = document.getElementById('active_' + rewardId);
    const qtyinput = document.getElementById('qty_' + rewardId);

    if (checkbox && qtyinput){
        qtyinput.disabled = !checkbox.checked;
    }
}



//เอาไว้บอกว่าให้สร้าง html ให้เสร็จก่อนแล้วค่อยมาเรียกใช่ js
document.addEventListener('DOMContentLoaded', function(){
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

//ปุ่มกดแบบประเมินของหน้า assessment.blade.php
const btnrate = document.getElementById('btn_rate');

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

//สั่งให้หลอดหน้ารายการกิจกรรมคำตามที่เรากดของหน้า assessment.blade.php
function moveBulb(button) {
    const bule = document.getElementById('bulb_yellow');
    bule.style.marginLeft = button.offsetLeft + 'px';
}
const activeTabBtn = document.querySelector('#btn_activity.active, #btn_rate.active');
if (activeTabBtn) moveBulb(activeTabBtn);

// //การเป็นตัวเลขอัตโนมัตของรายการกิจกรรม
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
const evaluationFormSelect = document.getElementById('Evaluation_formid');
const checkboxContainer = document.querySelector('.frame-checkbox-name');
const evaluationFormelement = document.getElementById('frame-choose-evaluation');
const assignEvaluationModal = document.getElementById('assign_evaluation');
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


//ปุ่มกดเปิด popup มอบหมายแบบประเมิน  assessment.blade.php
const btnassignassessment = document.getElementById('btn_assign_assessment');

if (btnassignassessment){
    btnassignassessment.addEventListener('click', async function(){
    try {
        // เรียกแบบประเมินที่ยังไม่ผูกแบบประเมิน
        const res = await fetch('/admin/assessments/unassigned');
        if (!res.ok) throw new Error('ไม่สามารถดึงข้อมูลได้');
        const data = await res.json();

        // เพิ่มข้อมูลแบบประเมินลงใน dropdown 
        evaluationFormSelect.innerHTML = '<option value="" disabled selected>- เลือกแบบประเมิน -</option>';
        data.assessments.forEach(a => {
          const option = document.createElement('option');
          option.value = a.id;
          option.textContent = a.name;
          evaluationFormSelect.appendChild(option);  
        });

        // เพิ่มรายชื่อmanager ลงใน popup
        checkboxContainer.innerHTML = '';
        if(data.managers.length === 0){
            checkboxContainer.innerHTML = '<p style="color: gray; font-size: 14px;">ไม่พบผู้จัดการในระบบ</p>';
        }else{
            data.managers.forEach(m => {
            const label = document.createElement('label');
                label.className = 'message-checkbox-name';

            const input = document.createElement('input');
                input.type = 'radio';
                input.className = 'checkboxgivemanager';
                input.name = 'manager';
                input.value = m.id;

            label.append(input, ' ' + m.name);
                checkboxContainer.appendChild(label);
            });
        }
        // รีเซ็ตปุ่ม
        updatastatusbtnconfirmevaluation();

        // เปิด dialog
        openDialog(assignEvaluationModal);
    }catch (err) {
        alert('ไม่สามารถโหลดข้อมูลได้')
        console.error(err);
    }
        // openDialog(document.getElementById('assign_evaluation'));
    });
}
//ปุ่มกดปิด popup มอบหมายแบบประเมิน  assessment.blade.php
const closebutton = document.getElementById('close_button');

if (closebutton){
    closebutton.addEventListener('click', function(){
        closeDialog(assignEvaluationModal);
    });
}


//การกดปุ่มยืนยันตอนเลือกทุกอย่างเสร็จใน popup มอบหมายแบบประเมิน assessment.blade.php
// const Evaluationformid = document.getElementById('Evaluation_formid');
const btnconfirmevaluation = document.getElementById('btn_confirm_evaluation');
// const checkboxgivemanager = document.querySelectorAll('.checkboxgivemanager');

    function updatastatusbtnconfirmevaluation(){
        // const Evaluationformid_1  = Evaluationformid.value;
        const assessmentId  = evaluationFormSelect.value;
        const checkboxes = document.querySelectorAll('.checkboxgivemanager');

        let selectedCount = 0;
        
        // for (let i = 0; i < checkboxgivemanager.length; i++){
        //     const checkboxgivemanager_1 = checkboxgivemanager[i];
        //     if (checkboxgivemanager_1.checked){
        //         selectedcountname++;
        //     }
        // }

        checkboxes.forEach(cb => {
            if (cb.checked) selectedCount++;
        });

        if (assessmentId !== '' &&  selectedCount > 0){
            btnconfirmevaluation.disabled = false;
        }else{
            btnconfirmevaluation.disabled = true;
        }
}
// if(Evaluationformid && btnconfirmevaluation){
// Evaluationformid.addEventListener('change', updatastatusbtnconfirmevaluation);
// checkboxgivemanager.forEach(function (checkbox){
//     checkbox.addEventListener('change', updatastatusbtnconfirmevaluation);
// });

// updatastatusbtnconfirmevaluation()
// }

// คอยจับการเปลี่ยนแปลงของตัวcheckbox
if (evaluationFormSelect) {
    evaluationFormSelect.addEventListener('change', updatastatusbtnconfirmevaluation);
}
document.addEventListener('change', function(e){
    if (e.target && e.target.classList.contains('checkboxgivemanager')){
        updatastatusbtnconfirmevaluation();
    }
});

//ปุ่มเอาไว้กดยกเลิกข้อความในpopup มอบหมายแบบประเมิน
const btncancelevaluation1 = document.getElementById('btn_cancel_evaluation1');

if (btncancelevaluation1){
    btncancelevaluation1.addEventListener('click', function(){
       evaluationFormelement.reset();
        updatastatusbtnconfirmevaluation();
    });
}

// ปุ่มยืนยันการมอบหมายแล้วบันทึกลงดาต้าเบส
if (evaluationFormelement) {
    evaluationFormelement.addEventListener('submit', async function(e){
        e.preventDefault();

        const assessmentId = evaluationFormSelect.value;
        const checkedManager = document.querySelector('.checkboxgivemanager:checked');

        // ถ้าไม่มีการเลือกแบบประเมินหรือmanager เลยจะแจ้งเตือนข้อความนี้
        if (!assessmentId || !checkedManager){
            alert('โปรดเลือกแบบประเมินและผู้รับผิดชอบ');
            return;
        }
        // ดึงค่าหลังจากการเช็คว่ามีค่าแล้วแน่นอน
        const managerId = checkedManager.value;

        try {
        const res = await fetch('/admin/assessments/assign',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body:JSON.stringify({
                assessment_id: assessmentId,
                manager_id: managerId
            })
        });
        // กรณีที่เพิ่มผู้รับผิดชอบสำเร็จจะแจ้งข้อความนี้มา
        const data = await res.json();
        if (data.success){
            alert('มอบหมายแบบประเมินสำเร็จ');
            closeDialog(assignEvaluationModal);
            window.location.reload(); //รีเฟชจอครั้งนึงเพื่ออัปเดตข้อมูลพวกแบบประเมินกับรายชื่อ
        } else {
            alert('เกิดข้อผิดพลาด: '+(data.message || 'ไม่ทราบสาเหตุ'));
        }
        } catch (err) {
            alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่');
            console.error(err);
        }
    });  
}
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

// if(framesearchactivity){
//     framesearchactivity.addEventListener('keyup', function(){
        
//         const keyword = framesearchactivity.value.trim().toLowerCase();
//         const frameactivityassessment = document.querySelectorAll('.frame-activity-assessment');

//         frameactivityassessment.forEach(function (card){
//             const headingname = card.querySelector('.headingactivity');
//             if (!headingname)
//                 return;

//             const  headingname1 = headingname.textContent.trim().toLowerCase();
//             const match = headingname1.includes(keyword);

//             if(match){
//                 card.style.display = '';
//                 requestAnimationFrame(function(){
//                     card.classList.remove('is-hidden');
//                 });

//             }else{
//                 card.classList.add('is-hidden');
//                 setTimeout(function(){
//                     if (card.classList.contains('is-hidden')){
//                         card.style.display = 'none';
//                     }
//                 }, 250);
//             }
//         });

//     });
// }

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
// จำแท็บไว้ใน URL เวลากดสลับเอง จะได้ไม่หายตอนรีเฟรชหรือ reload หลังมอบหมาย
function setTabUrl(tab) {
    const url = new URL(window.location);
    url.searchParams.set('tab', tab);
    history.replaceState(null, '', url);
}

//สั่งให้หลอดหน้ารายการกิจกรรมคำตามที่เรากดของหน้า assessment.blade.php
function moveBulb(button) {
    const bule = document.getElementById('bulb_yellow');
    if (bule) bule.style.marginLeft = button.offsetLeft + 'px';
}





//ส่วนของหน้า create_activity.blade.php กับ edit_activity.blade.php
//ปุ่มกดแสดงเพิ่มเติมและแสดงน้อยลงของรางวัล ในหน้า create_activity.blade.php และ edit_activity.blade.php
const showmore = document.getElementById('show_more');
const showless = document.getElementById('show_less');

if(showmore && showless){
    showmore.addEventListener('click', function(){
        const btnshowmore = document.querySelectorAll('.btn-showmore');

        btnshowmore.forEach(function (showmore1, i){
            showmore1.style.transitionDelay = (i * 0.03) + 's';
            showmore1.classList.add('is-open');
        });
        showmore.style.display = 'none';
        showless.style.display = 'flex';
    });

    showless.addEventListener('click', function(){
        const btnshowmore = document.querySelectorAll('.btn-showmore');
        btnshowmore.forEach(function (showmore1){
            showmore1.style.transitionDelay = '0s';
            showmore1.classList.remove('is-open');
        });
        showmore.style.display = 'flex';
        showless.style.display = 'none';
    });

}


//ช่องติ๊กจำกัดจำนวนผู้เข้าร่วม ในหน้า create_activity.blade.php และ edit_activity.blade.php
//ไม่ติ๊ก = ไม่จำกัดจำนวนคน (ช่องว่างเปล่าเป็น null พิมพ์ไม่ได้) ถ้าติ๊ก = พิมพ์ตัวเลขได้ (เริ่มที่ 1)
const limitcheckbox = document.getElementById('limit_enabled');
const limitinput = document.getElementById('frame_number_quantity');

//ฟังก์ชันเอาไว้เปลี่ยนหน้าตาของช่องตัวเลข ตามสถานะที่ติ๊กอยู่
function updatelimitparticipants(){
    if (limitcheckbox.checked){
        //ติ๊กแล้ว เปิดให้พิมพ์ได้ ถ้าช่องยังว่างอยู่ให้เริ่มที่ 1
        limitinput.disabled = false;
        if (limitinput.value === ''){
            limitinput.value = 1;
        }
        limitinput.placeholder = '';
    } else {
        //ไม่ติ๊ก ล้างค่าให้ว่างแล้วล็อกไว้ ช่องจะโชว์คำว่า ไม่จำกัด แทน
        limitinput.value = '';
        limitinput.disabled = true;
        limitinput.placeholder = 'ไม่จำกัด';
    }
}

//เช็คว่ามีช่องพวกนี้อยู่ในหน้านี้จริงมั้ย ถ้าไม่มีให้ข้ามไป
if (limitcheckbox && limitinput){

    limitcheckbox.addEventListener('change', function(){
        updatelimitparticipants();
    });

    //ตั้งค่าหน้าตาให้ตรงกับสถานะตอนเปิดหน้าครั้งแรก
    updatelimitparticipants();
}



//ส่วนของหน้า view_details.blade.php
//ปุ่มเอาไว้ให้ปุ่ม button ที่ไม่ใช่ <a> สามารถกดเปลี่ยนหน้าได้
const btnrandomreward = document.getElementById('btn_randomreward');

if(btnrandomreward){
    btnrandomreward.addEventListener('click', function(){
        window.location.href = btnrandomreward.dataset.url;
    });
}


//ใช้สำหลับนับเวลาส่วนของเวลาปิดRegisterของหน้ารายละเอียดกิจกรรม
const numbertime = document.getElementById('number_time');

if (numbertime){
    let time = Number(numbertime.dataset.seconds);

    const timeoffregister = setInterval(function (){

        if(time <= 0){
            clearInterval(timeoffregister);
            numbertime.innerHTML = '00:00';

            // เปิดปุ่มเริ่มสุ่มรางวัลทันทีที่หมดเวลา
            const btnrandomreward = document.getElementById('btn_randomreward');
            if(btnrandomreward){
                btnrandomreward.disabled = false;
            }

        }else{
            let hour = Math.floor(time / 3600);
            let minute = Math.floor ((time % 3600) / 60);
            let second = Math.floor((time % 60));

            if(hour < 10){
                hour = '0' + hour;
            }
            if(minute < 10){
                minute = '0' + minute;
            }
            if(second < 10){
                second = '0' + second;
            }
            
            if(hour > 0){
                numbertime.innerHTML = hour + ':' + minute + ':' + second;
            }else{
                numbertime.innerHTML = minute+ ':' + second;
            }

            time--;

        }

    }, 1000);
}

//ปุ่มกดเปิดpopup ปิด Register
const offRegister = document.getElementById('off_Register');

if(offRegister){
    offRegister.addEventListener('click', function(){
        openDialog(document.getElementById('popupoff_Register'));
    });
}

//ปุ่มกดปิดpopup ปิด Register
const canceloffRegister = document.getElementById('cancel_offRegister');

if(canceloffRegister){
    canceloffRegister.addEventListener('click', function(){
        closeDialog(document.getElementById('popupoff_Register'));
    });
}


//ปุ่มกดเปิดpopip ลบกิจกรรม
const deleteRegister = document.getElementById('delete_Register');

if(deleteRegister){
    deleteRegister.addEventListener('click', function(){
        openDialog(document.getElementById('popup_deleteRegister'));
    });
}


////ปุ่มกดปิดpopip ลบกิจกรรม
const btncanceldeletion = document.getElementById('btn_canceldeletion');

if(btncanceldeletion){
    btncanceldeletion.addEventListener('click', function(){
        closeDialog(document.getElementById('popup_deleteRegister'))
    });
}


//ปุ่มกดขยาย QR code ให้เป็นรูปใหญ่ ของหน้า view_details.blade.php
const btnenlargeqr = document.getElementById('btn_enlarge_qr');
const popupenlargeqr = document.getElementById('popup_enlarge_qr');
const enlargeqrbox = document.getElementById('enlarge_qr_box');
const qrsmall = document.querySelector('.img-QRcode svg');

//ถ้าหน้านี้ไม่มีปุ่มหรือ QR ให้ข้ามไป (กันหน้าอื่นที่ใช้ไฟล์ js เดียวกันพัง)
if (btnenlargeqr && popupenlargeqr && enlargeqrbox && qrsmall){

    //ฟังก์ชันเปิด popup: ก๊อปปี้ QR ตัวเล็กมาใส่ในกรอบแล้วเปิดขึ้นมา
    function openenlargeqr(){
        const qrbig = qrsmall.cloneNode(true);

        //เอาขนาดตายตัวออก ให้ QR ขยายตามกรอบที่ CSS กำหนด
        qrbig.removeAttribute('width');
        qrbig.removeAttribute('height');

        enlargeqrbox.innerHTML = '';
        enlargeqrbox.appendChild(qrbig);

        openDialog(popupenlargeqr);
    }

    //กดปุ่ม "ขยาย QR" หรือกดที่รูป QR ก็ขยายได้
    btnenlargeqr.addEventListener('click', openenlargeqr);

    //ปุ่มกากบาทปิด popup
    const btncloseenlargeqr = document.getElementById('btn_close_enlarge_qr');
    if (btncloseenlargeqr){
        btncloseenlargeqr.addEventListener('click', function(){
            closeDialog(popupenlargeqr);
        });
    }

    //กดพื้นที่มืดด้านนอกกล่องก็ปิดได้
    popupenlargeqr.addEventListener('click', function(event){
        if (event.target === popupenlargeqr){
            closeDialog(popupenlargeqr);
        }
    });
}


//ปุ่มขยาย QR แบบประเมิน ใช้ popup เดียวกับ QR ลงทะเบียน
const btnenlargeassessmentqr = document.getElementById('btn_enlarge_assessment_qr');
const assessmentqrsmall = document.querySelector('#assessment_qr_small svg');

if (btnenlargeassessmentqr && assessmentqrsmall && popupenlargeqr && enlargeqrbox){
    btnenlargeassessmentqr.addEventListener('click', function(){
        const qrbig = assessmentqrsmall.cloneNode(true);
        qrbig.removeAttribute('width');
        qrbig.removeAttribute('height');

        //เปลี่ยนหัวข้อ popup ให้ตรงกับ QR แบบประเมิน
        const titleelement = popupenlargeqr.querySelector('.titleenlargeQR');
        const subtitleelement = popupenlargeqr.querySelector('.subtitleenlargeQR');
        if (titleelement){
            titleelement.textContent = 'แบบประเมิน';
        }
        if (subtitleelement){
            subtitleelement.textContent = 'สแกน QR code เพื่อทำแบบประเมิน';
        }

        enlargeqrbox.innerHTML = '';
        enlargeqrbox.appendChild(qrbig);
        openDialog(popupenlargeqr);
    });
}


//ช่องค้นหาชื่อผู้ลงทะเบียน ในหน้า view_details.blade.php
const searchregistration = document.getElementById('search_registration');

//ฟังก์ชันกรองแถวรายชื่อตามคำที่พิมพ์ (ซ่อนแถวที่ไม่ตรงพร้อมเส้นคั่นของมัน)
function filterregistration(){
    if (!searchregistration){
        return;
    }

    const keyword = searchregistration.value.trim().toLowerCase();
    const rows = document.querySelectorAll('#registration_list .frameinformationparticipants');

    rows.forEach(function (row){
        const nameelement = row.querySelector('.nameparticipants');
        if (!nameelement){
            return;
        }

        const match = nameelement.textContent.trim().toLowerCase().includes(keyword);
        row.classList.toggle('is-hidden', !match);

        //เส้นคั่นใต้แถวต้องซ่อนตามไปด้วย
        const line = row.nextElementSibling;
        if (line && line.tagName === 'HR'){
            line.style.display = match ? '' : 'none';
        }
    });
}

if (searchregistration){
    searchregistration.addEventListener('input', filterregistration);
}


//เอาไว้อัปเดตรายชื่อผู้ลงทะเบียนของหน้า view_details.blade.php แบบเรียวทาม
const registrationlist = document.getElementById('registration_list');

if (registrationlist){

    //จำค่าล่าสุดที่เห็น ไว้เทียบว่ามีคนลงเพิ่มหรือยัง
    let lastcount = null;
    let lastid = null;

    //ฟังก์ชันดึงหน้าเดิมมาใหม่ แล้วเอาเฉพาะส่วนรายชื่อกับตัวเลขมาแทนของเดิม
    async function loadregistrationlist(){
        try {
            const res = await fetch(window.location.href, { cache: 'no-store' });
            if (!res.ok){
                return;
            }

            const html = await res.text();
            const newdoc = new DOMParser().parseFromString(html, 'text/html');

            const newlist = newdoc.getElementById('registration_list');
            if (newlist){
                registrationlist.innerHTML = newlist.innerHTML;
            }

            //เปลี่ยนตัวเลข "X คน" ในหัวกล่องรายชื่อ
            const newquantity = newdoc.querySelector('.numberquantitypeople');
            const oldquantity = document.querySelector('.numberquantitypeople');
            if (newquantity && oldquantity){
                oldquantity.textContent = newquantity.textContent;
            }

            //เปลี่ยนตัวเลข "ลงทะเบียนแล้ว" ด้านบน
            const newnumber = newdoc.querySelector('.numberregister');
            const oldnumber = document.querySelector('.numberregister');
            if (newnumber && oldnumber){
                oldnumber.textContent = newnumber.textContent;
            }

            //โหลดรายชื่อใหม่แล้ว ให้กรองตามคำที่ค้นหาค้างอยู่อีกรอบ
            filterregistration();
        } catch (err){
            console.warn('อัปเดตรายชื่อไม่สำเร็จ', err);
        }
    }

    //ฟังก์ชันถามเซิร์ฟเวอร์แบบเบา ๆ ว่ามีคนลงเพิ่มมั้ย ถ้ามีค่อยดึงรายชื่อใหม่
    async function checkregistrationchange(){

        //ถ้ากำลังเปิด popup อยู่ ไม่ต้องอัปเดต กันหน้าสะดุด
        if (document.querySelector('dialog[open]')){
            return;
        }

        try {
            const res = await fetch(registrationlist.dataset.countUrl, {
                headers: { 'Accept': 'application/json' },
                cache: 'no-store'
            });
            if (!res.ok){
                return;
            }

            const data = await res.json();

            //ครั้งแรกแค่จำค่าไว้ ครั้งต่อไปถ้าค่าเปลี่ยนค่อยโหลดรายชื่อใหม่
            if (lastcount !== null && (data.count !== lastcount || data.last !== lastid)){
                await loadregistrationlist();
            }
            lastcount = data.count;
            lastid = data.last;

        } catch (err){
            console.warn('เช็กจำนวนผู้ลงทะเบียนไม่สำเร็จ', err);
        }
    }

    //เช็กทุก 1 วินาที (ข้อมูลที่ส่งมีนิดเดียว ไม่หนักเซิร์ฟเวอร์)
    setInterval(checkregistrationchange, 1000);

    //กลับมาเปิดแท็บนี้อีกครั้ง ให้เช็กทันทีไม่ต้องรอรอบถัดไป
    document.addEventListener('visibilitychange', function(){
        if (!document.hidden){
            checkregistrationchange();
        }
    });
}





//ส่วนของหน้า profile.blade.php
/*ฟังชันเอาไว้ไปดึงใช้ของปุ่มเปิด ปิด popupให้มีAnimation*/
function openDialog(dialog) {

    dialog.showModal();
    document.body.classList.add('no-scroll');

    requestAnimationFrame(function(){
        dialog.classList.add('show');
  
    });
}

function closeDialog(dialog) {
    
    dialog.classList.remove('show');

    setTimeout(function(){
        dialog.close();

        const nothaveunlock = document.querySelector('dialog[open]');
        if(!nothaveunlock){
            document.body.classList.remove('no-scroll');
        }
    }, 200); 
}
//ปุ่มเปิดpopupเปลี่ยนรูปโปรไฟล์ หน้า profile.blade.php
const btnopen_1 = document.getElementById('btn_open_1');

if(btnopen_1){
    btnopen_1.addEventListener('click', function(){
        openDialog(document.getElementById('image-popup'));
        closeDialog(document.getElementById('popup_btn_Change'));
        closeDialog(document.getElementById('popup_btn_edit'));
    });
}

//ปุ่มปิดpopupเปลี่ยนรูปโปรไฟล์ หน้า profile.blade.php
const btnclose_1 = document.getElementById('btn_close_1');

if(btnclose_1){
    btnclose_1.addEventListener('click', function(){
        closeDialog(document.getElementById('image-popup'));
    });
}

//ปุ่มเปิดpopupแก้ไขข้อมูล หน้า profile.blade.php
const editinformation = document.getElementById('Edit_information')

if(editinformation){
    editinformation.addEventListener('click', function(){
        openDialog(document.getElementById('popup_btn_edit'));
        closeDialog(document.getElementById('image-popup'));
        closeDialog(document.getElementById('popup_btn_Change'));     
});
}

//ปุ่มปิดpopupแก้ไขข้อมูล หน้า profile.blade.php
const btncloseedit = document.getElementById ('btn_close_Edit');

if(btncloseedit){
    btncloseedit.addEventListener('click', function(){
        closeDialog(document.getElementById('popup_btn_edit'));
    });
}

//ปุ่มเปิดpopupเปลี่ยนรหัสผ่าน หน้า profile.blade.php
const Changepassword = document.getElementById('Change_password');

if(Changepassword){
    Changepassword.addEventListener('click', function(){
        openDialog(document.getElementById('popup_btn_Change'));
        closeDialog(document.getElementById('popup_btn_edit'));
        closeDialog(document.getElementById('image-popup'));
    });
}

//ปุ่มปิดpopupเปลี่ยนรหัสผ่าน หน้า profile.blade.php
const btnclosechange = document.getElementById('btn_close_change');

if(btnclosechange){
    btnclosechange.addEventListener('click', function(){
        closeDialog(document.getElementById('popup_btn_Change'));
    });
}

//เอาไว้เวลาโหลดหน้าแล้วปุ่ม popup จะไม่ปิด
const imagepopup = document.getElementById('image-popup');

if(imagepopup && imagepopup.dataset.open === 'true'){
    openDialog(imagepopup);
}


//ปุ่มเปิด/ปิดเอาไว้ดูรหัสผ่านปัจจุบัน
const imgeye1 = document.getElementById('img_eye_1');
const iconeye1 = document.getElementById('icon_eye_1');
const TypeCurrentpassword1 = document.getElementById('Type_Current_password_1');

if(imgeye1 && TypeCurrentpassword1 && iconeye1){
    imgeye1.addEventListener('click', function(){
        const ispassword1 = TypeCurrentpassword1.type === 'password';
        TypeCurrentpassword1.type = ispassword1 ? 'text' : 'password';
        iconeye1.className = ispassword1 ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye' ;
    });
}
//ปุ่มเปิด/ปิดเอาไว้ดูรหัสผ่านใหม่
const imgeye2 = document.getElementById('img_eye_2');
const iconeye2 = document.getElementById('icon_eye_2');
const Typepasswordcurrent1 = document.getElementById('Type_passwordcurrent_1');

if(imgeye2 && Typepasswordcurrent1 && iconeye2){
    imgeye2.addEventListener('click', function(){
        const ispassword2 = Typepasswordcurrent1.type === 'password';
        Typepasswordcurrent1.type = ispassword2 ? 'text' : 'password';
        iconeye2.className = ispassword2 ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye' ;
    });
}

//เมื่อกดเลือกรูปโปรไฟล์เสร็จ ก็จะส่งไปบอก ProfileController ทันทีว่ากดบันทึกได้เลยนะ
const uploadPhotoInput = document.getElementById('uploadphoto');
    const profileForm = document.getElementById('profileForm');

    if (uploadPhotoInput && profileForm) {
        uploadPhotoInput.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                profileForm.submit(); 
            }
        });
    }















//ส่วนของหน้า random_reward.blade.php
//เก็บวงล้อไว้ในตัวแปรนี้ก่อน ถ้าไม่มีวงล้อเลยให้เป็น null ไปก่อน
let namewheel = null;
let rewardwheel = null;


//ฟังก์ชันสร้างแถบสุ่มแนวนอนแบบเว็บเปิดกล่อง CS:GO (แทนวงล้อกลมแบบเดิม)
//ใช้ชื่อ createwheel และคืนค่า spin / reduceandremove / removeitem เหมือนเดิม
//โค้ดปุ่มสุ่ม popup ผู้โชคดี และปุ่มเปิด/ปิด ข้างล่างเลยใช้ต่อได้โดยไม่ต้องแก้
function createwheel(containerId, items) {
    const container = document.getElementById(containerId);

    //เช็คว่ามีกล่องแถบสุ่มอยู่จริงมั้ย
    if (!container) {
        return null;
    }

    //ค่าตั้งต้นของแถบสุ่ม ปรับได้ตามชอบ
    const CARD_WIDTH = 130;        //ความกว้างการ์ด 1 ใบ (px)
    const CARD_GAP = 10;           //ช่องว่างระหว่างการ์ด (px)
    const STEP = CARD_WIDTH + CARD_GAP;
    const SPIN_CARDS = 55;         //เลื่อนผ่านการ์ดกี่ใบก่อนหยุด ยิ่งเยอะยิ่งเลื่อนไกลและเร็ว
    const SPIN_DURATION = 5000;    //เวลาเลื่อน (มิลลิวินาที)
    const SETTLE_DURATION = 450;   //เวลาค่อยๆ เลื่อนเข้ากลางการ์ดหลังหยุด
    const IDLE_CARDS = 41;         //จำนวนการ์ดตอนยังไม่กดสุ่ม

    //ถ้ารายการมี quantity แปลว่าเป็นวงล้อของรางวัล จะใช้สีตามความหายาก
    const isreward = items.some(function (item) {
        return item.quantity !== undefined;
    });

    //สีของวงล้อรายชื่อ (ชุดเดียวกับวงล้อเดิม)
    const colorList = ['#4A90D9', '#2ecc71', '#f1c40f', '#e67e22', '#e74c3c', '#e91e8c', '#9b59b6', '#5dade2'];

    //สีตามความหายากแบบ CS:GO ยิ่งโอกาสออกน้อยยิ่งได้สีหายาก (maxshare คือ % โอกาสออก)
    const raritylist = [
        { maxshare: 3,   color: '#FFD700' }, //ทอง
        { maxshare: 10,  color: '#EB4B4B' }, //แดง
        { maxshare: 20,  color: '#D32CE6' }, //ชมพู
        { maxshare: 40,  color: '#8847FF' }, //ม่วง
        { maxshare: 100, color: '#4B69FF' }  //น้ำเงิน
    ];

    //ไอคอนบนการ์ด
    const ICON_USER = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg>';
    const ICON_GIFT = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="8" width="18" height="4" rx="1"/><path d="M5 12v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-8"/><path d="M12 8v13"/><path d="M12 8S10.5 3 8 3a2.5 2.5 0 0 0 0 5"/><path d="M12 8s1.5-5 4-5a2.5 2.5 0 0 1 0 5"/></svg>';


    //สร้างโครงของแถบสุ่มข้างในกล่อง
    container.innerHTML = '';
    container.classList.add('roulette');
    container.style.setProperty('--card-width', CARD_WIDTH + 'px');
    container.style.setProperty('--card-gap', CARD_GAP + 'px');

    //ช่องมองที่ตัดการ์ดส่วนเกินออก
    const viewport = document.createElement('div');
    viewport.className = 'roulette-viewport';

    //แถบที่เรียงการ์ดไว้ เลื่อนซ้ายขวาด้วย transform
    const track = document.createElement('div');
    track.className = 'roulette-track';
    viewport.appendChild(track);

    //เส้นกลางกับลูกศรบนล่าง
    const line = document.createElement('div');
    line.className = 'roulette-line';

    const markertop = document.createElement('div');
    markertop.className = 'roulette-marker roulette-marker-top';

    const markerbottom = document.createElement('div');
    markerbottom.className = 'roulette-marker roulette-marker-bottom';

    //ข้อความตอนไม่มีรายการให้สุ่ม
    const emptytext = document.createElement('p');
    emptytext.className = 'roulette-empty';
    if (isreward) {
        emptytext.textContent = 'ไม่มีของรางวัลให้สุ่ม';
    } else {
        emptytext.textContent = 'ไม่มีรายชื่อให้สุ่ม';
    }

    container.append(viewport, line, markertop, markerbottom, emptytext);


    //ตัวแปรเก็บสถานะของแถบ
    let totalpercent = 0;
    let cards = [];         //การ์ดที่อยู่ในแถบตอนนี้ เก็บเป็น {element, item}
    let centerindex = 0;    //ลำดับการ์ดที่อยู่ตรงลูกศรตอนนี้
    let currentx = 0;       //ตำแหน่งแถบล่าสุด
    let isspinning = false;


    //รวมเปอร์เซ็นต์ของทุกรายการ (แปลงเป็นตัวเลขก่อน กันค่าจาก database มาเป็นข้อความ)
    function recalctotal() {
        totalpercent = 0;
        for (let i = 0; i < items.length; i++) {
            totalpercent = totalpercent + (Number(items[i].percent) || 0);
        }
    }

    //กำหนดสีให้แต่ละรายการครั้งเดียวตอนเริ่ม สีจะได้ไม่เปลี่ยนไปมาตอนของบางชิ้นหมด
    recalctotal();
    for (let i = 0; i < items.length; i++) {
        const item = items[i];
        let color = colorList[i % colorList.length];

        if (isreward && totalpercent > 0) {
            const share = ((Number(item.percent) || 0) / totalpercent) * 100;
            for (let r = 0; r < raritylist.length; r++) {
                if (share <= raritylist[r].maxshare) {
                    color = raritylist[r].color;
                    break;
                }
            }
        }

        item.roulettecolor = color;
    }


    //ข้อความจำนวนที่เหลือบนการ์ดของรางวัล
    function quantitytext(quantity) {
        if (quantity > 0) {
            return 'เหลือ ' + quantity;
        }
        return 'หมดแล้ว';
    }

    //สร้างการ์ด 1 ใบ
    function makecard(item) {
        const card = document.createElement('div');
        card.className = 'roulette-card';
        card.style.setProperty('--rarity', item.roulettecolor);

        const icon = document.createElement('div');
        icon.className = 'roulette-card-icon';

        //ถ้ามีรูปส่งมาด้วย (item.image) ให้ใช้รูปแทนไอคอน
        if (item.image) {
            const img = document.createElement('img');
            img.src = item.image;
            img.alt = '';
            icon.appendChild(img);
        } else if (isreward) {
            icon.innerHTML = ICON_GIFT;
        } else {
            icon.innerHTML = ICON_USER;
        }

        //ใส่ชื่อด้วย textContent กันชื่อที่มีอักขระแปลกๆ ทำให้หน้าพัง
        const name = document.createElement('p');
        name.className = 'roulette-card-name';
        name.textContent = item.label;
        name.title = item.label;

        card.append(icon, name);

        if (item.quantity !== undefined) {
            const quantity = document.createElement('p');
            quantity.className = 'roulette-card-qty';
            quantity.textContent = quantitytext(item.quantity);
            card.appendChild(quantity);
        }

        return card;
    }

    //เอารายการไปสร้างเป็นการ์ดเรียงในแถบ
    function filltrack(list) {
        const fragment = document.createDocumentFragment();
        cards = [];

        for (let i = 0; i < list.length; i++) {
            const element = makecard(list[i]);
            cards.push({ element: element, item: list[i] });
            fragment.appendChild(element);
        }

        track.innerHTML = '';
        track.appendChild(fragment);
    }

    //คำนวณว่าต้องเลื่อนแถบไปเท่าไหร่ ให้การ์ดลำดับ index อยู่ตรงลูกศรพอดี
    //offset คือระยะเยื้องจากกลางการ์ด ใช้ตอนหยุดให้ดูไม่ตรงกลางเป๊ะทุกครั้ง
    function positionof(index, offset) {
        return viewport.clientWidth / 2 - (index * STEP + CARD_WIDTH / 2) - offset;
    }

    //เลื่อนแถบไปตำแหน่ง x
    function movetrack(x) {
        currentx = x;
        track.style.transform = 'translate3d(' + x + 'px, 0, 0)';
    }


    //ฟังก์ชันสุ่มว่าจะได้ชิ้นไหน โดยดูจากเปอร์เซ็นต์ (หลักการเดียวกับวงล้อเดิม)
    function pickrandomitem() {
        const randomnumber = Math.random() * totalpercent;
        let countup = 0;

        for (let i = 0; i < items.length; i++) {
            countup = countup + (Number(items[i].percent) || 0);

            if (randomnumber < countup) {
                return items[i];
            }
        }

        //เผื่อกรณีปัดเศษพลาดให้เอาตัวสุดท้ายไปเลย
        return items[items.length - 1];
    }


    //วาดแถบตอนยังไม่กดสุ่ม เรียงทุกรายการวนไปเรื่อยๆ ให้เห็นครบทุกชิ้น
    function renderidle() {
        if (items.length === 0) {
            container.classList.add('is-empty');
            return;
        }

        const list = [];
        for (let i = 0; i < IDLE_CARDS; i++) {
            list.push(items[i % items.length]);
        }

        filltrack(list);
        centerindex = Math.floor(IDLE_CARDS / 2);
        movetrack(positionof(centerindex, 0));
    }


    //ฟังก์ชันสุ่ม พอเลื่อนเสร็จจะเรียก onfinish พร้อมส่งผู้ชนะกลับไปให้ (เหมือนวงล้อเดิม)
    function spin(onfinish) {

        //ไม่มีรายการเหลือแล้ว ให้ตอบกลับเป็น null ไปเลย ปุ่มสุ่มจะได้ไม่ค้าง
        if (items.length === 0) {
            if (onfinish) {
                onfinish(null);
            }
            return;
        }

        isspinning = true;

        //ได้ผลสุ่มตั้งแต่ตรงนี้แล้ว การเลื่อนแถบเป็นแค่ animation เหมือนวงล้อเดิม
        const winner = pickrandomitem();

        //นับว่าครึ่งจอมองเห็นการ์ดได้กี่ใบ
        const sidecount = Math.ceil(viewport.clientWidth / 2 / STEP) + 1;
        const startindex = sidecount;
        const winnerindex = startindex + SPIN_CARDS;
        const totalcards = winnerindex + sidecount + 5;

        //สร้างแถบใหม่: ช่วงต้นก๊อปการ์ดที่เห็นอยู่ตอนนี้มาวาง ภาพจะต่อเนื่องไม่กระตุก
        //ช่วงกลางสุ่มตามเปอร์เซ็นต์ (ของหายากจะโผล่ให้เห็นน้อย) แล้ววางผู้ชนะไว้ที่ winnerindex
        const list = [];
        for (let i = 0; i < totalcards; i++) {
            const oldcard = cards[centerindex - startindex + i];

            if (i === winnerindex) {
                list.push(winner);
            } else if (i <= startindex * 2 && oldcard) {
                list.push(oldcard.item);
            } else {
                list.push(pickrandomitem());
            }
        }

        filltrack(list);
        movetrack(positionof(startindex, 0));

        //สุ่มจุดหยุดให้เยื้องซ้ายหรือขวานิดหน่อย แต่ยังอยู่ในการ์ดใบเดียวกัน
        const maxoffset = CARD_WIDTH / 2 - 12;
        const randomoffset = (Math.random() * 2 - 1) * maxoffset;

        const startx = currentx;
        const endx = positionof(winnerindex, randomoffset);
        let starttime = null;

        function animate(timestamp) {

            //ครั้งแรกที่ฟังก์ชันนี้ทำงาน ให้จำเวลาเริ่มต้นไว้ก่อน
            if (starttime === null) {
                starttime = timestamp;
            }

            let progress = (timestamp - starttime) / SPIN_DURATION;
            if (progress > 1) {
                progress = 1;
            }

            //เร็วตอนแรก แล้วค่อยๆ ช้าลงตอนท้าย
            const slowdown = 1 - Math.pow(1 - progress, 3);
            movetrack(startx + (endx - startx) * slowdown);

            if (progress < 1) {
                requestAnimationFrame(animate);
            } else {
                settle();
            }
        }

        //หยุดแล้วค่อยๆ เลื่อนเข้ากลางการ์ดผู้ชนะ
        function settle() {
            const fromx = currentx;
            const tox = positionof(winnerindex, 0);
            let settlestart = null;

            function step(timestamp) {
                if (settlestart === null) {
                    settlestart = timestamp;
                }

                let progress = (timestamp - settlestart) / SETTLE_DURATION;
                if (progress > 1) {
                    progress = 1;
                }

                let smooth = 0;
                if (progress < 0.5) {
                    smooth = 2 * progress * progress;
                } else {
                    smooth = 1 - Math.pow(-2 * progress + 2, 2) / 2;
                }

                movetrack(fromx + (tox - fromx) * smooth);

                if (progress < 1) {
                    requestAnimationFrame(step);
                } else {
                    finish();
                }
            }

            requestAnimationFrame(step);
        }

        //เลื่อนเสร็จแล้ว ไฮไลต์การ์ดผู้ชนะ แล้วบอกผลลัพธ์กลับไป
        function finish() {
            centerindex = winnerindex;
            isspinning = false;
            cards[winnerindex].element.classList.add('is-winner');

            if (onfinish) {
                onfinish(winner);
            }
        }

        requestAnimationFrame(animate);
    }


    //ลบรายการออกจาก items แล้วคำนวณเปอร์เซ็นต์ใหม่
    function removefromitems(item) {
        const index = items.indexOf(item);
        if (index !== -1) {
            items.splice(index, 1);
        }

        recalctotal();

        //แถบยังโชว์ผลล่าสุดค้างไว้ ถ้าไม่เหลือรายการแล้วค่อยขึ้นข้อความบอก
        if (items.length === 0) {
            container.classList.add('is-empty');
        }
    }


    //ฟังก์ชันลดจำนวนของรางวัลที่สุ่มได้ลง 1 ถ้าหมดแล้วให้เอาออกจากการสุ่ม ใช้กับวงล้อของรางวัล
    function reduceandremove(winneritem) {

        //ถ้าไม่มี quantity (เช่นวงล้อรายชื่อ) ก็ไม่ต้องทำอะไร
        if (winneritem.quantity === undefined) {
            return;
        }

        winneritem.quantity = winneritem.quantity - 1;

        //อัปเดตตัวเลข "เหลือ" บนการ์ดทุกใบที่เป็นของรางวัลชิ้นนี้
        for (let i = 0; i < cards.length; i++) {
            if (cards[i].item === winneritem) {
                const quantity = cards[i].element.querySelector('.roulette-card-qty');
                if (quantity) {
                    quantity.textContent = quantitytext(winneritem.quantity);
                }
            }
        }

        if (winneritem.quantity <= 0) {
            removefromitems(winneritem);
        }
    }


    //ฟังก์ชันเอารายชื่อที่ถูกสุ่มแล้วออกจากการสุ่มรอบต่อไป ใช้กับวงล้อรายชื่อ
    function removeitem(winneritem) {
        removefromitems(winneritem);
    }


    //ย่อขยายหน้าจอแล้วให้การ์ดที่ได้ยังอยู่ตรงลูกศร
    window.addEventListener('resize', function () {
        if (!isspinning && cards.length > 0) {
            movetrack(positionof(centerindex, 0));
        }
    });


    //วาดแถบครั้งแรกไว้ก่อนตอนยังไม่กดสุ่ม
    renderidle();


    //ส่งฟังก์ชันออกไปให้ข้างนอกเรียกใช้ได้ (ชื่อเดิมทั้งหมด)
    return {
        spin: spin,
        reduceandremove: reduceandremove,
        removeitem: removeitem
    };
}


//เช็คว่ารายชื่อกับของรางวัลที่ได้รับจาก blade.php มีอยู่จริงมั้ยถ้ามีจริงก็จะเอาข้อมูลมาสร้างวงล้อสุ่ม
if (typeof nameData !== 'undefined') {
    namewheel = createwheel('name_canvas', nameData);
}
if (typeof rewardData !== 'undefined') {
    rewardwheel = createwheel('reward_canvas', rewardData);
}

//เอาผู้โชคดีที่เพิ่มสุ่มได้ไปใส่บนสุดของรายการผู้โชคดีล่าสุด 6 คน โดยไม่ต้องรีเฟรชหน้า
function addlatestwinner(nameresult, rewardresult) {
    const latestwinnerslist = document.getElementById('latest_winners_list');

    //ถ้าไม่มีกรอบรายการหรือรอบนนี้สุ่มแต่ของรางวัลไม่มีรายชื่อก็ไม่ต้องทำอะไรเลย
    if(!latestwinnerslist || !nameresult){
        return;
    }

    //ถ้ามีข้อความ ยังไม่มีผู้โชคดี อยู่ให้ลบออกก่อน
    const warnnothaveluckywinner = latestwinnerslist.querySelector('.warnnothaveluckywinner');
    if (warnnothaveluckywinner){
        warnnothaveluckywinner.remove();
    }

    //ถ้ารอบนี้ปิดสุ่มของรางวัลไว้ ให้โชว์ขีดแทนชื่อรางวัล
    let rewardtext = '-';
    if(rewardresult) {
        rewardtext = rewardresult.label;
    }

    //สร้างแุถวผู้โชคดีใหม่ เลขลำดับจะใส่ทีหลังตอนเรียงเลย
    const framenameluckywinner = document.createElement('div');
    framenameluckywinner.className = 'framenameluckywinner';
    framenameluckywinner.innerHTML = '<div class="framenumberluckywinner"><p class="framenumberluckywinner-1"></p></div>' + '<p class="nameluckywinner"></p>' + '<div class="framePrizes"><p class="rawardname"></p></div>';

    //ใส่ชื่อกับรางวัลด้วย textContent กันชื่อที่มีอังขระแปลกๆทำให้หน้าพัง
    framenameluckywinner.querySelector('.nameluckywinner').textContent = nameresult.label;
    framenameluckywinner.querySelector('.rawardname').textContent = rewardtext;

    //เส้นคั่นใต้แถว
    const linesectionluckywinner = document.createElement('hr');
    linesectionluckywinner.className = 'linesectionluckywinner';

    //เอาแถวใหม่ไปไว้บนสุด โดยให้เส้นคั่นอยู่ใต้แถว
    latestwinnerslist.prepend(linesectionluckywinner);
    latestwinnerslist.prepend(framenameluckywinner);

    //เก็บไว้แค่ 6 คนล่าสุด คนที่เกินให้ลบทิ้งพร้อมเส้นคั่นของมัน
    const allwinnerrows = latestwinnerslist.querySelectorAll('.framenameluckywinner');

    for (let i = 0; i < allwinnerrows.length; i++){
        const winnerrow = allwinnerrows[i];

        if (i >= 6){
            winnerrow.nextElementSibling.remove();
            winnerrow.remove();

        }else{
            //แถวที่ยังอยู่ ใส่เลขลำดังใหม่ 1 2 3
            winnerrow.querySelector('.framenumberluckywinner-1').textContent = i + 1;
        }
    }

}






//ปุ่มกดเริ่มสุ่มรางวัล
const btnstartRandom = document.getElementById('btn_startRandomreward');

if (btnstartRandom) {

    btnstartRandom.addEventListener('click', function () {

        //เช็คปิด/เปิดของแต่ละวงล้อ ว่าตอนนี้เปิดให้สุ่มอันไหนบ้าง
        const btnonofflistnamesRandom = document.getElementById('btn_on_offlistnamesRandom');
        const btnnooffrandomreward = document.getElementById('btn_no_offrandomreward');


        //ตั้งค่าเริ่มต้นไว้ก่อน flase วงล้อรายชื่อ
        let shouldspinname = false;
        if (btnonofflistnamesRandom && btnonofflistnamesRandom.checked) {
            if (namewheel && nameData.length > 0) {
                shouldspinname = true;
            }
        }

        //ตั้งค่าเริ่มต้นไว้ก่อน flase วงล้อของรางวัล
        let shouldspinreward = false;
        if (btnnooffrandomreward && btnnooffrandomreward.checked) {
            if (rewardwheel && rewardData.length > 0) {
                shouldspinreward = true;
            }
        }

        //ถ้าไม่มีวงล้อไหนให้สุ่มเลย ก็ไม่ต้องทำอะไรต่อ
        if (!shouldspinname && !shouldspinreward) {
            return;
        }

        //ปิดปุ่มไว้กันคนกดซ้ำระหว่างวงล้อกำลังหมุน
        btnstartRandom.disabled = true;

        //ตัวแปรไว้เก็บผลลัพธ์ของแต่ละวง
        let nameresult = null;
        let rewardresult = null;
        let finishedwheelcount = 0;

        //นับไว้ว่ารอบนี้ต้องรอกี่วงล้อหมุนเสร็จ (อาจจะแค่วงเดียว หรือทั้ง 2 วง)
        let totalwheelstospin = 0;
        if (shouldspinname) {
            totalwheelstospin = totalwheelstospin + 1;
        }
        if (shouldspinreward) {
            totalwheelstospin = totalwheelstospin + 1;
        }

        //ฟังก์ชันนี้จะถูกเรียกทุกครั้งที่วงล้อวงใดวงหนึ่งหมุนเสร็จ
        function onewheelfinished() {

            finishedwheelcount = finishedwheelcount + 1;

            //เช็คว่าหมุนครบยังถ้าครบแล้วก็ให้เปิดใช้งานปุ่ม
            if (finishedwheelcount !== totalwheelstospin) {
                return;
            }

            btnstartRandom.disabled = false;

            //ลบชิ้นส่วนรายชื่อไปเลย
            if (nameresult) {
                namewheel.removeitem(nameresult);
            }
            //ลดจำนวนทีละ1และเช็คว่าหมดยังถ้าหมดแล้วค่อยลบออกจากชิ้นส่วนของรางวัล
            if (rewardresult) {
                rewardwheel.reduceandremove(rewardresult);
            }

            //เช็คว่ารอบนี้มีผลการสุ่มเกิดขึ้นจริงอย่างน้อย 1 อย่างมั้ย
            let hasanyresult = false;
            if (nameresult || rewardresult) {
                hasanyresult = true;
            }

            if (hasanyresult) {

                //เตรียมค่าที่จะส่งไปให้ backend ก่อน ถ้าไม่มีผลของวงไหน ให้ส่งเป็น null
                let registrationIdToSend = null;
                if (nameresult) {
                    registrationIdToSend = nameresult.id;
                }

                let rewardIdToSend = null;
                if (rewardresult) {
                    rewardIdToSend = rewardresult.id;
                }

                const roleprefix = window.location.pathname.split('/')[1];
                fetch(`/${roleprefix}/random-reward/${eventId}/save-result`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        registration_id: registrationIdToSend,
                        reward_id: rewardIdToSend
                    })
                })
            }
            //เอาผู้โชคดีไปใส่ในรายการด้านล่างทันที
            addlatestwinner(nameresult, rewardresult);

            //พอสุ่มเสร็จpopupก็จะเปิดออกมา
            showwinnerpopup(nameresult, rewardresult);
        }

        //สั่งหมุนเฉพาะวงล้อที่เปิดไว้เท่านั้น
        if (shouldspinname) {
            //สั่งหมุนวงล้อ พร้อมส่ง callback function เข้าไป
            namewheel.spin(function (winner) {
                nameresult = winner;
                onewheelfinished();
            });
        }

        if (shouldspinreward) {
            rewardwheel.spin(function (winner) {
                rewardresult = winner;
                onewheelfinished();
            });
        }
    });
}

//ฟังก์ชันเปิด popup แสดงผู้โชคดีหลังวงล้อหมุนเสร็จ แทนการใช้ alert()
function showwinnerpopup(nameresult, rewardresult) {

    const popupluckywinner = document.getElementById('popup_luckywinner');

    //ถ้ารอบนี้ไม่ได้สุ่มรายชื่อเพราะปิดอยู่ ให้โชว์ข้อความแทนว่าไม่มีรายชื่อ
    let nametext = '-- ไม่มีรายชื่อ --';
    if (nameresult) {
        nametext = nameresult.label;
    }

    let rewardtext = '-- ไม่มีของรางวัล --';
    if (rewardresult) {
        rewardtext = rewardresult.label;
    }

    document.getElementById('messageuser_popupluckywinner_1').textContent = nametext;
    document.getElementById('message_rewardreceived_2').textContent = rewardtext;

    openDialog(popupluckywinner);
}

//ปุ่มกดปิด popup ผู้โชคดี
const offpopupluckywinner = document.getElementById('off-popupluckywinner');

if (offpopupluckywinner) {
    offpopupluckywinner.addEventListener('click', function () {
        closeDialog(document.getElementById('popup_luckywinner'));
    });
}

//ฟังก์ชันเอาไว้ทำให้วงล้อจางลงเมื่อกด ปิด และกลับมาชัดเมื่อกด เปิดของรายชื่อ
const btnonofflistnamesRandom = document.getElementById('btn_on_offlistnamesRandom');
const namecanvas = document.getElementById('name_canvas');

if(btnonofflistnamesRandom && namecanvas){
    function openoffwheellistname(){
        if(btnonofflistnamesRandom.checked){
            namecanvas.classList.remove('wheel-disabled');
        }else{
            namecanvas.classList.add('wheel-disabled');
        }
    }
    openoffwheellistname()
    btnonofflistnamesRandom.addEventListener('change', openoffwheellistname);
}

//ฟังก์ชันเอาไว้ทำให้วงล้อจางลงเมื่อกด ปิด และกลับมาชัดเมื่อกด เปิดของรางวัล
const btnnooffrandomreward = document.getElementById('btn_no_offrandomreward');
const rewardcanvas = document.getElementById('reward_canvas');

if(btnnooffrandomreward && rewardcanvas){
    function openoffwheellistreward(){
        if(btnnooffrandomreward.checked){
            rewardcanvas.classList.remove('wheel-disabled');
        } else{
            rewardcanvas.classList.add('wheel-disabled');
        }
    }
    openoffwheellistreward()
    btnnooffrandomreward.addEventListener('change', openoffwheellistreward);
}









//ส่วนของหน้า history_random.blade.php
//ปุ่มเปิด popup พบรายชื่อผู้ได้รับรางวัล
const btnopenpopupname = document.querySelectorAll('.btn-openpopupname');

    for (let i = 0; i < btnopenpopupname.length; i++){
        const btnopenpopupname1 = btnopenpopupname[i];

        btnopenpopupname1.addEventListener('click', function(){

            //เอาข้อมูลไปแสดงใน popup
            document.getElementById('popuplistname_name').textContent = btnopenpopupname1.dataset.name;
            document.getElementById('popuplistname_QrCode').textContent =  btnopenpopupname1.dataset.qr;
            document.getElementById('popuplistname_reward').textContent = btnopenpopupname1.dataset.reward;
            document.getElementById('messagenotyetreceiveitems_2').textContent = btnopenpopupname1.dataset.receivedAt;


            //บอกฟอร์มว่าตอนกดยืนยัน ให้ส่งข้อมูลมาที่แถวนี้
            document.getElementById('form_receive').action = btnopenpopupname1.dataset.action;

            const status = btnopenpopupname1.dataset.status;
            const btnsubmitpopuplistnameawardrecipient = document.getElementById('btn_submitpopuplistnameawardrecipient');
            const framenotyetreceiveitems = document.getElementById('framenotyet_receiveitems');
            const framenotyetreceiveitems1 = document.getElementById('framenotyet_receiveitems_1');
     

            if(status === 'received'){
                btnsubmitpopuplistnameawardrecipient.style.display = 'none';
                framenotyetreceiveitems.style.display = 'none';
                framenotyetreceiveitems1.style.display = '';
            }else {
                btnsubmitpopuplistnameawardrecipient.style.display = '';
                framenotyetreceiveitems.style.display = '';
                framenotyetreceiveitems1.style.display = 'none';
            }
            openDialog(document.getElementById('popuplistname_awardrecipient'))
        });
    }

//ปุ่มปิด popup พบรายชื่อผู้ได้รับรางวัล
const btnoffpopuplistnameawardrecipient = document.getElementById('btn_offpopuplistnameawardrecipient');

if (btnoffpopuplistnameawardrecipient){
    btnoffpopuplistnameawardrecipient.addEventListener('click', function(){
        closeDialog(document.getElementById('popuplistname_awardrecipient'));
    });
}

/*ปุ่มกดทั้งหมด*/
const buttonallsection = document.getElementById('button_allsection');

if (buttonallsection){
    buttonallsection.addEventListener('click', function(){
        document.getElementById('messagebutton_allsection').classList.add('active');
        document.getElementById('messagebutton_receivedsection').classList.remove('active');
        document.getElementById('messagebutton_notacceptingyetsection').classList.remove('active');
        document.getElementById('circlenumberbutton_allsection').classList.add('active');
        document.getElementById('circlenumberbutton_receivedsection').classList.remove('active');
        document.getElementById('circlenumberbutton_notacceptingyetsection').classList.remove('active');
        document.getElementById('numberbutton_allsection').classList.add('active');
        document.getElementById('numberbutton_receivedsection').classList.remove('active');
        document.getElementById('numberbutton_notacceptingyetsection').classList.remove('active');


        lineorange(document.getElementById('button_allsection'));

        allreceivednotreceivedhistory_random('all');
    });
}

/*ปุ่มกดรับแล้ว*/
const buttonreceivedsection = document.getElementById('button_receivedsection');

if (buttonreceivedsection){
    buttonreceivedsection.addEventListener('click', function(){
        document.getElementById('messagebutton_receivedsection').classList.add('active');
        document.getElementById('messagebutton_allsection').classList.remove('active');
        document.getElementById('messagebutton_notacceptingyetsection').classList.remove('active');
        document.getElementById('circlenumberbutton_receivedsection').classList.add('active');
        document.getElementById('circlenumberbutton_allsection').classList.remove('active');
        document.getElementById('circlenumberbutton_notacceptingyetsection').classList.remove('active');
        document.getElementById('numberbutton_receivedsection').classList.add('active');
        document.getElementById('numberbutton_allsection').classList.remove('active');
        document.getElementById('numberbutton_notacceptingyetsection').classList.remove('active');


        lineorange(document.getElementById('button_receivedsection'));

        allreceivednotreceivedhistory_random('received');
    });
}

/*ปุ่มกดยังไม่ได้รับ*/
const buttonnotacceptingyetsection = document.getElementById('button_notacceptingyetsection');


if(buttonnotacceptingyetsection){
    buttonnotacceptingyetsection.addEventListener('click', function(){
        document.getElementById('messagebutton_notacceptingyetsection').classList.add('active');
        document.getElementById('messagebutton_receivedsection').classList.remove('active');
        document.getElementById('messagebutton_allsection').classList.remove('active');
        document.getElementById('circlenumberbutton_notacceptingyetsection').classList.add('active');
        document.getElementById('circlenumberbutton_receivedsection').classList.remove('active');
        document.getElementById('circlenumberbutton_allsection').classList.remove('active');
        document.getElementById('numberbutton_notacceptingyetsection').classList.add('active');
        document.getElementById('numberbutton_receivedsection').classList.remove('active');
        document.getElementById('numberbutton_allsection').classList.remove('active');


        lineorange(document.getElementById('button_notacceptingyetsection'));

        allreceivednotreceivedhistory_random('not-received');
    });
}

//เส้นใต้ปุ่มกดให้มันขยับตาม
function lineorange(button1) {
    const orange = document.getElementById('yellow_linesection');
    orange.style.marginLeft = button1.offsetLeft + 'px';

}

//กดปุ่ม ทั้งหมด รับแล้ว ยังไม่รับแล้วให้สถานะไปแสดงในหน้านั้น
function allreceivednotreceivedhistory_random(status){

    const btnopenpopupname = document.querySelectorAll('.btn-openpopupname');

    for (let i = 0; i < btnopenpopupname.length; i++){
        const btnopenpopupname1 = btnopenpopupname[i];
        const btnopenpopupnamestatus = btnopenpopupname1.dataset.status;

        if(status === 'all'){
            btnopenpopupname1.style.display = '';
        } else if (btnopenpopupnamestatus === status){
            btnopenpopupname1.style.display = '';
        } else{
            btnopenpopupname1.style.display = 'none';
        }

    }
}

//นับจำนวนของคนที่ได้รางวัล ทั้งหมด รับแล้ว ยังไม้รับ
function updatenumberlistname(){

    const numberalllistname1 = document.getElementById('numberalllistname_1');
    if(!numberalllistname1){
        return;
    }


    const btnopenpopupname = document.querySelectorAll('.btn-openpopupname');

    let allhistoryrandom = 0;
    let receivedhistoryrandom = 0;
    let notreceivedhistoryrandom = 0;

    for (let i = 0; i < btnopenpopupname.length; i++){
        const btnopenpopupname1 = btnopenpopupname[i];
        const btnopenpopupnamestatus = btnopenpopupname1.dataset.status;

            allhistoryrandom++;
        if (btnopenpopupnamestatus === 'received'){
            receivedhistoryrandom++;
        } else if (btnopenpopupnamestatus === 'not-received'){
            notreceivedhistoryrandom++;
        }else{
            console.warn('พบสถานะที่ไม่รู้จัก', btnopenpopupnamestatus, btnopenpopupname1);
        }
        
    }

    //เปลี่ยนตัวเลขของกรอบเฉยๆที่ไม่ใช่ปุ่ม
    numberalllistname1.textContent = allhistoryrandom;
    const numberreceivelistname1 = document.getElementById('numberreceivelistname_1');
    numberreceivelistname1.textContent = receivedhistoryrandom;
    const numbernotacceptingyetlistname1 = document.getElementById('numbernotacceptingyetlistname_1');
    numbernotacceptingyetlistname1.textContent = notreceivedhistoryrandom;


    //อันนี้เปลี่ยนตัวเลขของปุ่มทั้งหมด รับแล้ว ยังไม่ได้รับ ให้มีตัวเลขข้อมูลจริงๆ
    const numberbuttonallsection = document.getElementById('numberbutton_allsection');
    numberbuttonallsection.textContent = allhistoryrandom;
    const numberbuttonreceivedsection = document.getElementById('numberbutton_receivedsection');
    numberbuttonreceivedsection.textContent = receivedhistoryrandom;
    const numberbuttonnotacceptingyetsection = document.getElementById('numberbutton_notacceptingyetsection');
    numberbuttonnotacceptingyetsection.textContent = notreceivedhistoryrandom;

}
updatenumberlistname()


//ฟังก์ชันเอาไว้เปลี่ยนสีกับข้อความสถานะของรางวัล ตอนกดยืนยันรับของ
function updatecolorwithmessagestatus(statusold, statusnew){
    let message = '';

    if (statusnew === 'received'){
        message = 'รับแล้ว';
    } else {
        message = 'ยังไม่รับ';
    }

    statusold.dataset.status = statusnew;

    const messagestatusrewardlistname1 = statusold.querySelector('.messagestatusreward-listname1');
    messagestatusrewardlistname1.textContent = message;
}

//ช่องค้นหา + สแกน Qrcode
const framesearchsenditgmail = document.getElementById('frame_searchsenditgmail');

if(framesearchsenditgmail){

    //โฟกัสช่องค้นหาอัตโนมัติตอนเปิดหน้า พร้อมยิงสแกนได้ทันที
    framesearchsenditgmail.focus();

    //พิมทีละตัว กรองรายชื่อที่แสดงในหน้า
    framesearchsenditgmail.addEventListener('input', function(){
        const framesearchsenditgmail1 = framesearchsenditgmail.value.trim().toLowerCase();
        const btnopenpopupname = document.querySelectorAll('.btn-openpopupname');

        for (let i = 0; i < btnopenpopupname.length; i++){
            const btnopenpopupname1 = btnopenpopupname[i];
            const listname_name = btnopenpopupname1.dataset.name.toLowerCase();
            const listname_qrcode = btnopenpopupname1.dataset.qr.toLowerCase();

            if (listname_name.includes(framesearchsenditgmail1) || listname_qrcode.includes(framesearchsenditgmail1)){
                btnopenpopupname1.style.display = '';
            } else{
                btnopenpopupname1.style.display = 'none';
            }
        }
    });
    framesearchsenditgmail.addEventListener('keydown', function(event){
    if(event.key === 'Enter'){
        //กันฟอร์มถูก submit โดยไม่ตั้งใจ
        event.preventDefault();

        const scanqrcode = framesearchsenditgmail.value.trim().toLowerCase();
        const btnopenpopupname = document.querySelectorAll('.btn-openpopupname');

        let found = null;

        for (let i = 0; i < btnopenpopupname.length; i++){
            const btnopenpopupname1 = btnopenpopupname[i];
            const listname_qrcode = btnopenpopupname1.dataset.qr.toLowerCase();

            if (listname_qrcode === scanqrcode){
                found = btnopenpopupname1;
                break;
            }
        }

        if (found){
            //เจอรหัสตรงกัน เปิด popup ให้เลยทันที
            found.click();
            //เคลียร์ช่องค้นหา เตรียมสแกนคนต่อไป
            framesearchsenditgmail.value = '';
        }else{
            framesearchsenditgmail.value = '';
        }
    }
});

}











//ส่วนของ button_senditgmail.blade.php
function updatenumberstatussendemail(){
    const numberallbuttonsenditgmail = document.getElementById('numberallbutton_senditgmail');
    if (!numberallbuttonsenditgmail){
        return;
    }


    const framemessagelistnamerecipientreward1 = document.querySelectorAll('.framemessagelistnamerecipientreward-1');

    let allemail = 0;
    let sentemail = 0;
    let failedemail = 0;

    for (let i = 0; i < framemessagelistnamerecipientreward1.length; i++){
        const framemessagelistnamerecipientreward2 = framemessagelistnamerecipientreward1[i];
        const framemessagelistnamerecipientreward3 = framemessagelistnamerecipientreward2.dataset.status;

        allemail++;

        if(framemessagelistnamerecipientreward3 === 'sent'){
            sentemail++;
        }else if (framemessagelistnamerecipientreward3 === 'failed'){
            failedemail++;
        }
    }    


    numberallbuttonsenditgmail.textContent = allemail;
    const numbersentbuttonsenditgmail = document.getElementById('numbersentbutton_senditgmail');
    numbersentbuttonsenditgmail.textContent = sentemail;
    const numberdeliveryfailedbuttonsenditgmail = document.getElementById('numberdeliveryfailedbutton_senditgmail');
    numberdeliveryfailedbuttonsenditgmail.textContent = failedemail;
}
updatenumberstatussendemail();







//ส่วนของหน้า dashboard.blade.php
//วาดกราฟเส้นการสุ่มตามช่วงเวลา
const graphcanvas = document.getElementById('graph');

if (graphcanvas && typeof chartLabels !== 'undefined'){

    //ค่าสูงสุดของแกน y และระยะห่างของเส้นตาราง แยกตามช่วง
    const yconfig = {
        day:   { max: 100,  step: 20 },
        week:  { max: 500,  step: 100 },
        month: { max: 1000, step: 200 }
    };
    const currentrange = (typeof chartRange !== 'undefined') ? chartRange : 'day';
    const ysetting = yconfig[currentrange] || yconfig.day;

    new Chart(graphcanvas, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'จำนวนการสุ่ม',
                data: chartValues,
                borderColor: '#10B981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.3,
                pointRadius: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: ysetting.max,
                    ticks: {
                        precision: 0,
                        stepSize: ysetting.step
                    }
                }
            }
        }
    });
}

//ปุ่มกดวันของหน้า dashboard
const btnday = document.getElementById('button-day')

if (btnday){
btnday.addEventListener('click', function() {
    window.location.href = '/admin/dashboard?range=day';
});
}

//ปุ่มกดสัปดาห์ของหน้า dashboard
const btnweek = document.getElementById('button-week')

if (btnweek){
btnweek.addEventListener('click', function() {
    window.location.href = '/admin/dashboard?range=week';
});
}

//ปุ่มกดเดือนของหน้า dashboard
const btnmonth = document.getElementById('button-month')

if (btnmonth){
btnmonth.addEventListener('click', function() {
    window.location.href = '/admin/dashboard?range=month';
});
}


});