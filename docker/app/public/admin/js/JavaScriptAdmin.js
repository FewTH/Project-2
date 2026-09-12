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
        openDialog(document.getElementById('assign_evaluation'));
    })
}

//ปุ่มกดปิด popup มอบหมายแบบประเมิน  assessment.blade.php
const closebutton = document.getElementById('close_button');

if (closebutton){
    closebutton.addEventListener('click', function(){
        closeDialog(document.getElementById('assign_evaluation'));
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


//ช่องค้นหารายชื่อกิจกรรม ในหน้า assessment.blade.php
const framesearchactivity = document.getElementById('frame_search_activity');

if(framesearchactivity){
    framesearchactivity.addEventListener('keyup', function(){
        
        const keyword = framesearchactivity.value.trim().toLowerCase();
        const frameactivityassessment = document.querySelectorAll('.frame-activity-assessment');

        frameactivityassessment.forEach(function (card){
            const headingname = card.querySelector('.headingactivity');
            if (!headingname)
                return;

            const  headingname1 = headingname.textContent.trim().toLowerCase();

            if(headingname1.includes(keyword)){
                card.style.display = '';
            }else{
                card.style.display = 'none';
            }
        });

    })
}





//ส่วนของหน้า create_activity.blade.php กับ edit_activity.blade.php
//ปุ่มกดแสดงเพิ่มเติมและแสดงน้อยลงของรางวัล ในหน้า create_activity.blade.php และ edit_activity.blade.php
const showmore = document.getElementById('show_more');
const showless = document.getElementById('show_less');

if(showmore && showless){
    showmore.addEventListener('click', function(){
        const btnshowmore = document.querySelectorAll('.btn-showmore');

        btnshowmore.forEach(function (showmore1){
            showmore1.style.display = 'flex';
        });
        showmore.style.display = 'none';
        showless.style.display = 'flex';
    });

    showless.addEventListener('click', function(){
        const btnshowmore = document.querySelectorAll('.btn-showmore');
        btnshowmore.forEach(function (showmore1){
            showmore1.style.display = 'none';
        });
        showmore.style.display = 'flex';
        showless.style.display = 'none';
    });

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


//ฟังก์ชันเอาไว้วาดวงล้อและหมุนตามเปอร์เซ็นต์ของรางวัล
function createwheel(canvasId, items) {
    const canvas = document.getElementById(canvasId);

    //ถ้าไม่เจอ canvas เลย ก็ไม่ต้องทำต่อ
    if (!canvas) {
        return null;
    }

    //ถ้าไม่มี items เลยตั้งแต่แรก ให้เป็น array ว่างแทน null/undefined กันโค้ดข้างล่าง error
    if (!items) {
        items = [];
    }

    const ctx = canvas.getContext('2d');

    //หาจุดกึ่งกลางของวงกลม และรัศมี
    const centerX = canvas.width / 2;
    const centerY = canvas.height / 2;

    //ไม่ให้ชนกับขอบ
    const radius = centerX - 5;

    //รัศมีของวงกลมสีขาว (รู) ตรงกลางวงล้อ ตามหน้าตาที่ออกแบบไว้
    const holeRadius = radius * 0.22;

    //สีของวงล้อสุ่มทั้ง 2 วง
    const colorList = ['#4A90D9', '#2ecc71', '#f1c40f', '#e67e22', '#e74c3c', '#e91e8c', '#9b59b6', '#5dade2'];

    //รวมเปอร์เซ็นต์ทั้งหมดไว้ก่อน เอาไปคำนวณสัดส่วนของแต่ละชิ้น
    let totalpercent = 0;
    for (let i = 0; i < items.length; i++) {
        totalpercent = totalpercent + items[i].percent;
    }

    //ฟังก์ชันตัดข้อความยาวๆให้ขึ้นบรรทัดใหม่ ไม่ให้ล้นออกจากชิ้นวงล้อ
    //ทำทีละขั้น: 1) แยกข้อความเป็นคำๆ 2) ลองต่อคำทีละคำ 3) ถ้ายาวเกินให้ขึ้นบรรทัดใหม่
    function wraptext(text, maxwidth) {
        const words = text.split(' ');
        const lines = [];
        let currentline = '';

        for (let i = 0; i < words.length; i++) {
            const oneword = words[i];

            //ลองเอาบรรทัดปัจจุบัน มาต่อกับคำใหม่ดูก่อนว่ายาวแค่ไหน
            let testline = '';
            if (currentline === '') {
                testline = oneword;
            } else {
                testline = currentline + ' ' + oneword;
            }

            const testwidth = ctx.measureText(testline).width;

            //ถ้าต่อแล้วยาวเกิน และก่อนหน้านี้มีข้อความอยู่แล้ว ให้ขึ้นบรรทัดใหม่
            if (testwidth > maxwidth && currentline !== '') {
                lines.push(currentline);
                currentline = oneword;
            } else {
                currentline = testline;
            }
        }

        //อย่าลืมเก็บบรรทัดสุดท้ายที่เหลือค้างอยู่ด้วย
        if (currentline !== '') {
            lines.push(currentline);
        }

        //ถ้ายังมีคำเดียวที่ยาวเกินไปอยู่ ให้ตัดเป็นตัวอักษรแทน
        const finallines = [];

        for (let i = 0; i < lines.length; i++) {
            const oneline = lines[i];
            const linewidth = ctx.measureText(oneline).width;

            //ถ้าบรรทัดนี้ไม่ยาวเกินอยู่แล้ว ก็เก็บไปเลยไม่ต้องตัดอะไร
            if (linewidth <= maxwidth) {
                finallines.push(oneline);
                continue;
            }

            //ถ้ายาวเกิน ให้ตัดทีละตัวอักษรแทน
            let piece = '';
            for (let c = 0; c < oneline.length; c++) {
                const onechar = oneline[c];
                const testpiece = piece + onechar;
                const piecewidth = ctx.measureText(testpiece).width;

                if (piecewidth > maxwidth && piece !== '') {
                    finallines.push(piece);
                    piece = onechar;
                } else {
                    piece = testpiece;
                }
            }
            if (piece !== '') {
                finallines.push(piece);
            }
        }

        return finallines;
    }


    //ฟังก์ชันวาดวงล้อ เรียกใหม่ทุกครั้งตอนหมุน เพื่อให้เห็น animation
    function draw(currentrotation) {

        //ถ้าไม่ส่งมุมมา ให้เริ่มที่ 0
        if (currentrotation === undefined) {
            currentrotation = 0;
        }

        //ล้างภาพเก่าก่อนวาดใหม่
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        //ถ้าไม่มีข้อมูลให้สุ่มแล้ว (หมดหรือยังไม่เคยมีเลย) วาดวงกลมสีขาวเต็มวงค้างไว้แทนพื้นที่ว่าง
        if (items.length === 0) {
            ctx.beginPath();
            ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);
            ctx.fillStyle = 'white';
            ctx.fill();
            return;
        }

        let anglesofar = currentrotation;

        for (let i = 0; i < items.length; i++) {

            const item = items[i];

            //คำนวณว่าชิ้นนี้ควรกว้างเท่าไหร่
            const slicesize = (item.percent / totalpercent) * 2 * Math.PI;
            const midangle = anglesofar + slicesize / 2;

            //วาดชิ้นส่วนวงล้อ
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.arc(centerX, centerY, radius, anglesofar, anglesofar + slicesize);
            ctx.closePath();

            //เลือกสีของชิ้นนี้ ถ้าจำนวนสีไม่พอ ก็จะวนกลับไปใช้สีแรกอีกรอบ
            const colorindex = i % colorList.length;
            ctx.fillStyle = colorList[colorindex];
            ctx.fill();


            //เขียนข้อความลงไปในชิ้นส่วนวงล้อ (แนวนอนเสมอ ไม่หมุนตามชิ้นวงล้อ ตามหน้าตาที่ออกแบบไว้)
            const textradius = (radius + holeRadius) / 2;
            const textx = centerX + Math.cos(midangle) * textradius;
            const texty = centerY + Math.sin(midangle) * textradius;

            ctx.fillStyle = 'white';
            ctx.font = 'bold 20px sans-serif';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';

            //ถ้าชิ้นนี้มีจำนวนคงเหลือ (quantity) ให้ต่อท้ายชื่อไปด้วย เช่น "สมุด (2)"
            let displaylabel = item.label;
            if (item.quantity !== undefined) {
                displaylabel = item.label + ' (' + item.quantity + ')';
            }

            //คำนวณความกว้างสูงสุดที่ข้อความควรมีตามขนาดของชิ้นวงล้อ แล้วตัดบรรทัดถ้ายาวเกิน
            let maxtextwidth = slicesize * textradius * 0.85;
            if (maxtextwidth < 40) {
                maxtextwidth = 40;
            }

            const lines = wraptext(displaylabel, maxtextwidth);

            const lineheight = 18;
            const starty = texty - ((lines.length - 1) * lineheight) / 2;

            for (let lineindex = 0; lineindex < lines.length; lineindex++) {
                const oneline = lines[lineindex];
                const oneliney = starty + lineindex * lineheight;
                ctx.fillText(oneline, textx, oneliney);
            }

            //ขยับไปวาดชิ้นส่วนวงล้อถัดไป
            anglesofar = anglesofar + slicesize;
        }

        //วาดวงกลมสีขาวทับตรงกลาง ให้ดูเป็นรูโดนัทตามหน้าตาที่ออกแบบไว้
        ctx.beginPath();
        ctx.arc(centerX, centerY, holeRadius, 0, 2 * Math.PI);
        ctx.fillStyle = 'white';
        ctx.fill();
    }


    //ฟังก์ชันสุ่มว่าจะได้ชิ้นไหน โดยดูจากเปอร์เซ็นต์
    //หลักการ: สุ่มเลขขึ้นมาเลขนึงในช่วง 0 ถึง totalpercent แล้วไล่บวกเปอร์เซ็นต์ของแต่ละชิ้นไปเรื่อยๆ
    //ชิ้นไหนที่บวกแล้วเลขสุ่มตกอยู่ในช่วงนั้น ก็คือชิ้นที่ถูกสุ่มได้
    function pickrandomitem() {
        const randomnumber = Math.random() * totalpercent;
        let countup = 0;

        for (let i = 0; i < items.length; i++) {
            countup = countup + items[i].percent;

            if (randomnumber <= countup) {
                return items[i];
            }
        }

        //เผื่อกรณีปัดเศษพลาด ให้เอาตัวสุดท้ายไปเลย
        const lastindex = items.length - 1;
        return items[lastindex];
    }


    //ฟังก์ชันหมุนวงล้อ พอหมุนเสร็จแล้วจะเรียก callback ที่ชื่อ onfinish พร้อมส่งผู้ชนะกลับไปให้
    function spin(onfinish) {

        //สุ่มไว้ล่วงหน้าเลยว่าใครชนะ แล้วค่อยหมุนวงล้อไปให้หยุดตรงจุดนั้น
        const winner = pickrandomitem();

        //หามุมเริ่มต้นของชิ้นที่ชนะ โดยไล่บวกขนาดของชิ้นก่อนหน้าไปเรื่อยๆ จนเจอชิ้นที่ชนะ
        let anglebeforewinner = 0;
        for (let i = 0; i < items.length; i++) {
            if (items[i] === winner) {
                break;
            }
            const onesliceofar = (items[i].percent / totalpercent) * 2 * Math.PI;
            anglebeforewinner = anglebeforewinner + onesliceofar;
        }

        const winnerslicesize = (winner.percent / totalpercent) * 2 * Math.PI;
        const winnermiddleangle = anglebeforewinner + (winnerslicesize / 2);

        //หมุนหลายรอบก่อน แล้วค่อยไปหยุดตรงชิ้นที่ชนะ (ลบด้วย PI/2 เพราะเข็มชี้อยู่ด้านบน)
        const spinrounds = 5;
        const finalangle = (spinrounds * 2 * Math.PI) + (-Math.PI / 2 - winnermiddleangle);

        const spinduration = 4000; //หมุน 4 วินาที
        let starttime = null;

        function animate(timestamp) {

            //ครั้งแรกที่ฟังก์ชันนี้ทำงาน ให้จำเวลาเริ่มต้นไว้ก่อน
            if (starttime === null) {
                starttime = timestamp;
            }

            const timepassed = timestamp - starttime;
            let progress = timepassed / spinduration;

            if (progress > 1) {
                progress = 1;
            }

            //ทำให้ช่วงท้ายค่อยๆ ช้าลง ดูเป็นธรรมชาติกว่าหมุนเร็วคงที่
            const slowdown = 1 - Math.pow(1 - progress, 3);

            draw(finalangle * slowdown);

            if (progress < 1) {
                //ยังหมุนไม่เสร็จ วาดเฟรมถัดไป
                requestAnimationFrame(animate);
            } else {
                //หมุนเสร็จแล้ว บอกผลลัพธ์กลับไป
                if (onfinish) {
                    onfinish(winner);
                }
            }
        }

        requestAnimationFrame(animate);
    }


    //ฟังก์ชันเอาไว้ลดจำนวนของรางวัลที่สุ่มได้ลง 1 ถ้าหมดแล้วให้ลบออกจากวงล้อเลย
    function reduceandremove(winneritem) {

        //ถ้าไม่มี quantity เก็บไว้ (เช่นวงล้อรายชื่อ) ก็ไม่ต้องทำอะไร
        if (winneritem.quantity === undefined) {
            return;
        }

        winneritem.quantity = winneritem.quantity - 1;

        //ถ้าหมดแล้ว ให้ลบชิ้นนี้ออกจาก items เลย
        if (winneritem.quantity <= 0) {
            const index = items.indexOf(winneritem);
            if (index !== -1) {
                items.splice(index, 1);
            }

            //คำนวณ totalpercent ใหม่จากของที่เหลือ กันสัดส่วนวงล้อเพี้ยน
            totalpercent = 0;
            for (let i = 0; i < items.length; i++) {
                totalpercent = totalpercent + items[i].percent;
            }
        }

        //วาดวงล้อใหม่ให้ตรงกับข้อมูลล่าสุด (ตัวเลขลดลง หรือชิ้นหายไปแล้ว)
        draw(0);
    }


    //ฟังก์ชันเอาไว้ลบรายชื่อที่ถูกสุ่มได้ออกจากวงล้อเลยทันที (ใช้กับวงล้อรายชื่อ ที่สุ่มได้แค่ครั้งเดียวต่อคน)
    function removeitem(winneritem) {

        const index = items.indexOf(winneritem);
        if (index !== -1) {
            items.splice(index, 1);
        }

        //คำนวณ totalpercent ใหม่จากของที่เหลือ กันสัดส่วนวงล้อเพี้ยน
        totalpercent = 0;
        for (let i = 0; i < items.length; i++) {
            totalpercent = totalpercent + items[i].percent;
        }

        //วาดวงล้อใหม่ให้ตรงกับข้อมูลล่าสุด (ชื่อที่สุ่มไปแล้วหายไปแล้ว)
        draw(0);
    }


    //วาดวงล้อครั้งแรกไว้ก่อน (ยังไม่หมุน)
    draw(0);

    //ส่งฟังก์ชัน spin, reduceandremove และ removeitem ออกไปให้ข้างนอกเรียกใช้ได้
    return {
        spin: spin,
        reduceandremove: reduceandremove,
        removeitem: removeitem
    };
}


//สร้างวงล้อทั้ง 2 วงตอนโหลดหน้าเสร็จ
//nameData กับ rewardData มาจาก script ที่ฝังไว้ในไฟล์ blade ก่อนไฟล์นี้
if (typeof nameData !== 'undefined') {
    namewheel = createwheel('name_canvas', nameData);
}

if (typeof rewardData !== 'undefined') {
    rewardwheel = createwheel('reward_canvas', rewardData);
}


//ปุ่มกดเริ่มสุ่มรางวัล
const btnStartRandom = document.getElementById('btn_startRandomreward');

if (btnStartRandom) {

    btnStartRandom.addEventListener('click', function () {

        //เช็ค toggle ปิด/เปิดของแต่ละวงล้อ ว่าตอนนี้เปิดให้สุ่มอันไหนบ้าง
        const nametoggle = document.getElementById('btn_on_offlistnamesRandom');
        const rewardtoggle = document.getElementById('btn_no_offrandomreward');

        //เช็คทีละเงื่อนไขว่าวงล้อรายชื่อควรหมุนมั้ย
        //ต้องเปิด toggle ไว้ + มีวงล้ออยู่จริง + ยังมีรายชื่อเหลือให้สุ่ม
        let shouldspinname = false;
        if (nametoggle && nametoggle.checked) {
            if (namewheel && nameData.length > 0) {
                shouldspinname = true;
            }
        }

        //เช็คทีละเงื่อนไขว่าวงล้อของรางวัลควรหมุนมั้ย
        //ต้องเปิด toggle ไว้ + มีวงล้ออยู่จริง + ยังมีของรางวัลเหลือให้สุ่ม
        let shouldspinreward = false;
        if (rewardtoggle && rewardtoggle.checked) {
            if (rewardwheel && rewardData.length > 0) {
                shouldspinreward = true;
            }
        }

        //ถ้าไม่มีวงล้อไหนให้สุ่มเลย ก็ไม่ต้องทำอะไรต่อ
        if (!shouldspinname && !shouldspinreward) {
            return;
        }

        //ปิดปุ่มไว้กันคนกดซ้ำระหว่างวงล้อกำลังหมุน
        btnStartRandom.disabled = true;

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

            //รอให้ครบตามจำนวนวงล้อที่สั่งหมุนในรอบนี้ ค่อยแสดงผลรวม
            if (finishedwheelcount !== totalwheelstospin) {
                return;
            }

            btnStartRandom.disabled = false;

            //ลบ/ลดจำนวนเฉพาะวงล้อที่สุ่มได้ผลจริงในรอบนี้
            if (nameresult) {
                namewheel.removeitem(nameresult);
            }
            if (rewardresult) {
                rewardwheel.reduceandremove(rewardresult);
            }

            //บันทึกผลจริงที่ backend ทันทีที่มีผลอย่างน้อย 1 วง ไม่ว่าจะสุ่มวงเดียวหรือทั้งคู่ก็ตาม
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

                fetch(`/admin/random-reward/${eventId}/save-result`, {
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
                    .catch(function (error) {
                        console.error('บันทึกผลไม่สำเร็จ:', error);
                    });
            }

            showwinnerpopup(nameresult, rewardresult);
        }

        //สั่งหมุนเฉพาะวงล้อที่เปิด toggle ไว้เท่านั้น
        if (shouldspinname) {
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

    const popup = document.getElementById('popup_luckywinner');
    if (!popup) {
        //เผื่อไม่มี popup ในหน้า ก็ยัง fallback เป็น alert() เดิมไว้กันพัง
        let namelabel = '-';
        if (nameresult) {
            namelabel = nameresult.label;
        }

        let rewardlabel = '-';
        if (rewardresult) {
            rewardlabel = rewardresult.label;
        }

        alert('ผู้โชคดี: ' + namelabel + '\nได้รับรางวัล: ' + rewardlabel);
        return;
    }

    //ถ้ารอบนี้ไม่ได้สุ่มรายชื่อ (toggle ปิดอยู่) ให้โชว์ข้อความแทนว่าไม่มีรายชื่อ
    let nametext = '-- ไม่มีรายชื่อ --';
    if (nameresult) {
        nametext = nameresult.label;
    }

    //ถ้ารอบนี้ไม่ได้สุ่มของรางวัล (toggle ปิดอยู่) ให้โชว์ข้อความแทนว่าไม่มีของรางวัล
    let rewardtext = '-- ไม่มีของรางวัล --';
    if (rewardresult) {
        rewardtext = rewardresult.label;
    }

    document.getElementById('messageuser_popupluckywinner_1').textContent = nametext;
    document.getElementById('message_rewardreceived_2').textContent = rewardtext;

    //ใช้ openDialog ที่มี animation อยู่แล้วในไฟล์นี้
    openDialog(popup);
}

//ปุ่มกดปิด popup ผู้โชคดี
const offpopupluckywinner = document.getElementById('off-popupluckywinner');

if (offpopupluckywinner) {
    offpopupluckywinner.addEventListener('click', function () {
        closeDialog(document.getElementById('popup_luckywinner'));
    });
}   

//ฟังก์ชันเอาไว้ทำให้วงล้อจางลงเมื่อกด toggle ปิด และกลับมาชัดเมื่อกด toggle เปิด
function updatewheeldimstate(toggleId, canvasId) {
    const toggle = document.getElementById(toggleId);
    const canvas = document.getElementById(canvasId);

    if (!toggle || !canvas) {
        return;
    }

    function refreshdim() {
        if (toggle.checked) {
            canvas.classList.remove('wheel-disabled');
        } else {
            canvas.classList.add('wheel-disabled');
        }
    }

    //เช็คสถานะทันทีตอนโหลดหน้า เผื่อ toggle ถูกปิดไว้ตั้งแต่แรก
    refreshdim();

    //เช็คใหม่ทุกครั้งที่มีการกด toggle
    toggle.addEventListener('change', refreshdim);
}

//ผูกไว้กับวงล้อรายชื่อ และวงล้อของรางวัล
updatewheeldimstate('btn_on_offlistnamesRandom', 'name_canvas');
updatewheeldimstate('btn_no_offrandomreward', 'reward_canvas');




});