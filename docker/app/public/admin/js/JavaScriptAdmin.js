//เอาไว้บอกว่าให้สร้าง html ให้เสร็จก่อนแล้วค่อยมาเรียกใช่ js
document.addEventListener('DOMContentLoaded', function(){
//ส่วนของหน้า dashboard.blade.php
// ข้อมูลจำลองสำหรับแสดงผลกราฟ
const mockData = {
    day: {
        chartdatanumber: [88, 89, 91, 68, 34, 73, 47, 83, 97, 34, 97, 84, 73, 53],
        storageboxmessageX: ["1","2","3","4","5","6","7","8","9","10","11","12","13","วันนี้"],
        maxY: 200 
    },
    week: {
        chartdatanumber: [150, 210, 260, 150, 300, 400, 450, 500],
        storageboxmessageX: ["1", "2", "3", "4", "5", "6", "7", "สัปดาห์นี้"],
        maxY: 600 
    },
    month: {
        chartdatanumber: [420, 450, 950, 620, 850, 900],
        storageboxmessageX: ["มค", "กพ", "มีค", "เมย", "พค", "มิย"],
        maxY: 1000
    }
};

//ส่วนของหน้า assessment.blade.php
//ปุ่มกดรายการกิจกรรมของหน้า assessment.blade.php
const butactivity = document.getElementById('btn_activity')

if (butactivity){
butactivity.addEventListener('click', function() {
    document.getElementById('frame_grey').classList.add('active');
    document.getElementById('frame_evaluation').classList.remove('active');
    document.getElementById('btn_activity').classList.add('active');
    document.getElementById('btn_rate').classList.remove('active');
    document.getElementById('number_activity').classList.add('active');
    document.getElementById('number_rate').classList.remove('active');
    document.getElementById('assign_evaluation').close();
    moveBulb(document.getElementById('btn_activity'));
});
}

//ปุ่มกดแบบประเมินของหน้า assessment.blade.php
const btnrate = document.getElementById('btn_rate')

if(btnrate){
btnrate.addEventListener('click', function(){
    document.getElementById('frame_evaluation').classList.add('active');
    document.getElementById('frame_grey').classList.remove('active');
    document.getElementById('btn_rate').classList.add('active');
    document.getElementById('btn_activity').classList.remove('active');
    document.getElementById('number_rate').classList.add('active');
    document.getElementById('number_activity').classList.remove('active');
    moveBulb(document.getElementById('btn_rate'));
});
}

//สั่งให้หลอดหน้ารายการกิจกรรมคำตามที่เรากดของหน้า assessment.blade.php
function moveBulb(button) {
    const bule = document.getElementById('bulb_yellow');
    bule.style.marginLeft = button.offsetLeft + 'px';
}

//การเป็นตัวเลขอัตโนมัตของรายการกิจกรรม
function updatenumberactivity(){
    //การเช็คว่ามีid นี้อยู่จริงมั้ยถ้ามีให้ทำต่อถ้าไม่มีให้ข้ามไป
    const activitiesnumberassessment = document.getElementById('activities_number_assessment');
    if(!activitiesnumberassessment){
        return
    }

    const frameactivityassessment = document.querySelectorAll('.frame-activity-assessment');

    let allactivities = 0;
    let closed1 = 0;
    let open1 = 0;

    for (let i = 0; i < frameactivityassessment.length; i++) {
        const frameactivity = frameactivityassessment[i];
        const frameactivity1 = frameactivity.dataset.status;

            allactivities++;
        if (frameactivity1 === 'open'){
            open1++;
        }else if (frameactivity1 === 'closed'){
            closed1++;
        }else {
            console.warn('พบสถานะที่ไม่รู้จัก', frameactivity1, frameactivity);
        }
    }

    //ตัวเลขเปลี่ยนอัตโนมัตของ กิจกรรมทั้งหมด ปิดแล้ว เปิดอยู่
    activitiesnumberassessment.textContent= allactivities
    const closedassessment1 = document.getElementById('Closed_assessment_1');
    closedassessment1.textContent= closed1
    const openassessment1 = document.getElementById('open_assessment_1');
    openassessment1.textContent = open1

    //ตัวเลขเปลี่ยนอัตโนมัตของรายการกิจกรรม
    const numberactivity = document.getElementById('number_activity');
    numberactivity.textContent = allactivities
}
updatenumberactivity();



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
    btnassignassessment.addEventListener('click', function(){
        document.getElementById('assign_evaluation').show();
    })
}

//ปุ่มกดปิด popup มอบหมายแบบประเมิน  assessment.blade.php
const closebutton = document.getElementById('close_button');

if (closebutton){
    closebutton.addEventListener('click', function(){
        document.getElementById('assign_evaluation').close();
    });
}


//การกดปุ่มยืนยันตอนเลือกทุกอย่างเสร็จใน popup มอบหมายแบบประเมิน assessment.blade.php
const Evaluationformid = document.getElementById('Evaluation_formid');
const btnconfirmevaluation = document.getElementById('btn_confirm_evaluation');
const checkboxgivemanager = document.querySelectorAll('.checkboxgivemanager');

    function updatastatusbtnconfirmevaluation(){
        const Evaluationformid_1  = Evaluationformid.value;


        let selectedcountname = 0;
        
        for (let i = 0; i < checkboxgivemanager.length; i++){
            const checkboxgivemanager_1 = checkboxgivemanager[i];
            if (checkboxgivemanager_1.checked){
                selectedcountname++;
            }
        }
        if (Evaluationformid_1 !== '' &&  selectedcountname > 0){
            btnconfirmevaluation.disabled = false;
        }else{
            btnconfirmevaluation.disabled = true;
        }
}
if(Evaluationformid && btnconfirmevaluation){
Evaluationformid.addEventListener('change', updatastatusbtnconfirmevaluation);
checkboxgivemanager.forEach(function (checkbox){
    checkbox.addEventListener('change', updatastatusbtnconfirmevaluation);
});

updatastatusbtnconfirmevaluation()
}

//ปุ่มเอาไว้กดยกเลิกข้อความในpopup มอบหมายแบบประเมิน
const btncancelevaluation1 = document.getElementById('btn_cancel_evaluation1');

if (btncancelevaluation1){
    btncancelevaluation1.addEventListener('click', function(){
       document.getElementById('frame-choose-evaluation').reset();
        updatastatusbtnconfirmevaluation();
    });
}


//ส่วนของหน้า profile.blade.php
//ปุ่มเปิดpopupเปลี่ยนรูปโปรไฟล์ หน้า profile.blade.php
const btnopen_1 = document.getElementById('btn_open_1');

if(btnopen_1){
    btnopen_1.addEventListener('click', function(){
        document.getElementById('image-popup').show();
        document.getElementById('popup_btn_Change').close();
        document.getElementById('popup_btn_edit').close();
    });
}

//ปุ่มปิดpopupเปลี่ยนรูปโปรไฟล์ หน้า profile.blade.php
const btnclose_1 = document.getElementById('btn_close_1');

if(btnclose_1){
    btnclose_1.addEventListener('click', function(){
        document.getElementById('image-popup').close();
    });
}

//ปุ่มเปิดpopupแก้ไขข้อมูล หน้า profile.blade.php
const editinformation = document.getElementById('Edit_information')

if(editinformation){
    editinformation.addEventListener('click', function(){
        document.getElementById('popup_btn_edit').show();
        document.getElementById('image-popup').close();
        document.getElementById('popup_btn_Change').close();    
});
}

//ปุ่มปิดpopupแก้ไขข้อมูล หน้า profile.blade.php
const btncloseedit = document.getElementById ('btn_close_Edit');

if(btncloseedit){
    btncloseedit.addEventListener('click', function(){
        document.getElementById('popup_btn_edit').close();
    });
}

//ปุ่มเปิดpopupเปลี่ยนรหัสผ่าน หน้า profile.blade.php
const Changepassword = document.getElementById('Change_password');

if(Changepassword){
    Changepassword.addEventListener('click', function(){
        document.getElementById('popup_btn_Change').show();
        document.getElementById('popup_btn_edit').close();
        document.getElementById('image-popup').close();
    });
}

//ปุ่มปิดpopupเปลี่ยนรหัสผ่าน หน้า profile.blade.php
const btnclosechange = document.getElementById('btn_close_change');

if(btnclosechange){
    btnclosechange.addEventListener('click', function(){
        document.getElementById('popup_btn_Change').close();
    });
}

//ปุ่มกดเปลี่ยนโฟล์เดอร์ในเครื่องคอมเรา
const btnselectfile1 = document.getElementById('btn_select_file_1');

if(btnselectfile1){
    btnselectfile1.addEventListener('click', function(){
        document.getElementById('uploadphoto').click();
    });
}

//เอาไว้เวลาโหลดหน้าแล้วปุ่ม popup จะไม่ปิด
const imagepopup = document.getElementById('image-popup');

if(imagepopup && imagepopup.dataset.open === 'true'){
    imagepopup.show();
}










});