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

    //เช็คว่ามี canvas จริงมั้ย
    if (!canvas) {
        return null;
    }

    const ctx = canvas.getContext('2d');

    //หาจุดกึ่งกลางของวงกลม และรัศมี
    const centerX = canvas.width / 2;
    const centerY = canvas.height / 2;
    const radius = centerX - 8;
    //เอาไว้ให้มันขยายหรือลดวงล้อเล็กๆสีขาวข้างใน
    const holeRadius = radius * 0.22;

    //เก็บมุมหมุนล่าสุดของวงล้อนี้ไว้(แก้ปัญหาวงล้อเด้งกลับตำแหน่งเดิม)
    let wheelrotation = 0;

    //สีของวงล้อสุ่มทั้ง 2 วง
    const colorList = ['#4A90D9', '#2ecc71', '#f1c40f', '#e67e22', '#e74c3c', '#e91e8c', '#9b59b6', '#5dade2'];

    //เอาเปอร์เช็นต์ของทุกรายการที่กรอกไป แล้วมาบวกสะสมให้ครบทุกรายการเพื่อจะเอาไปคำนวนใช้งานได้จริง
    let totalpercent = 0;
    for (let i = 0; i < items.length; i++) {
        totalpercent = totalpercent + items[i].percent;
    }

    //ฟังก์ชันวาดวงล้อ เรียกใหม่ทุกครั้งตอนหมุน เพื่อให้เห็น animation
    function draw(currentrotation) {

        //ล้างภาพเก่าก่อนวาดใหม่
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        //ถ้ารายการหมดแล้วให้วาดวงกลมสีขาวเปล่าๆไว้แทนแล้ว return ออกมาเลยไม่ต้องทำต่อ
        if (items.length === 0) {
            ctx.beginPath();
            ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);
            ctx.fillStyle = 'white';
            ctx.fill();
            return;
        }

        //วาดทีละส่วนของวงล้อ เริ่มต้นวาดมุมปัจจุบันจะขยับไปเรื่อยๆทุกครั้งที่วาด
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

            //เอาไว้โชว์ชื่อกับจำนวนของรางวัล"
            let displaylabel = item.label;
            if (item.quantity !== undefined) {
                displaylabel = item.label + ' (' + item.quantity + ')';
            }

            //บันทึกค่าปัจจุบันไว้กู้คืนได้ทีหลัง
            ctx.save();
            //ย้ายจุดอ้างอิงไปที่ค่าตรงกลาง
            ctx.translate(centerX, centerY);
            ctx.rotate(midangle);

            ctx.fillStyle = 'white';
            ctx.textAlign = 'right';
            ctx.textBaseline = 'middle';

            
            //กันไม่ให้ตัวหนังสือสูงเกินความใหญ่ของชิ้นส่วนวงล้อแต่ละวง
            let maxfontbyheight = slicesize * (holeRadius + 40);
            if (maxfontbyheight > 20){
                maxfontbyheight = 20
            }

            ctx.font = 'bold ' + maxfontbyheight + 'px Chakra Petch, sans-serif';


                //เอาไว้ขยับข้อความไปข้างในวงจะไม่ได้ไม่ชนกรอบ
                ctx.fillText(displaylabel, radius - 25, 0);

            //คืนค่าสถานะ canvas กลับไปเป็นก่อนหน้าsave()
            ctx.restore();

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
    function pickrandomitem() {
        const randomnumber = Math.random() * totalpercent;
        let countup = 0;

        for (let i = 0; i < items.length; i++) {
            countup = countup + items[i].percent;

            if (randomnumber <= countup) {
                return items[i];
            }
        }

        //เผื่อกรณีปัดเศษพลาดให้เอาตัวสุดท้ายไปเลย
        const lastindex = items.length - 1;
        return items[lastindex];
    }


    //ฟังก์ชันหมุนวงล้อ พอหมุนเสร็จแล้วจะเรียก callback ที่ชื่อ onfinish พร้อมส่งผู้ชนะกลับไปให้
    function spin(onfinish) {

        //ความจริงคือได้ผลสุ่มตั้งแต่ตรงนี้แล้ว ที่วงล้อสุ่มเป็นแค่animationเฉยๆ
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

        //หมุน 5 รอบ
        const spinrounds = 5;

        //ทำให้ชีของรางวัลได้ตรงจุด
        const targetangle = -Math.PI/2  - winnermiddleangle;

        //หาระยะที่ต้องหมุนเพิ่มจากตำแหน่งปัจจุบัน ให้ไปตรงเป้าหมายพอดี
        let diff = (targetangle - wheelrotation) % (2 * Math.PI);
        if (diff < 0) {
            diff = diff + 2 * Math.PI;
        }

        //มุมเริ่มต้นของการหมุน
        const startrotation = wheelrotation;
        const finalangle = startrotation + (spinrounds * 2 * Math.PI) + diff;

        const spinduration = 3000;
        //ทำเวลาเป็นnullไว้ก่อนถ้ามีการเปลี่ยนแปลงจะเก็บเวลาแรกไว้
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

            //ทำให้ช่วงท้ายค่อยๆ ช้าลง
            const slowdown = 1 - Math.pow (1 - progress, 3);

            //จะวาดภาพใหม่ ทุกครั้งที่มีการสุ่ม
            draw(startrotation + (finalangle - startrotation) * slowdown);

            if (progress < 1) {
                //ยังหมุนไม่เสร็จ วาดเฟรมถัดไป
                requestAnimationFrame(animate);
            } else {
                //จำตำแหน่งล่าสุดไว้ ให้รอบต่อไปหมุนต่อจากตรงนี้ ไม่เด้งกลับที่เดิม
                wheelrotation = finalangle;

                //หมุนเสร็จแล้ว บอกผลลัพธ์กลับไป
                if (onfinish) {
                    onfinish(winner);
                }
            }
        }
        //สั่งให้กดเริ่มเพื่อให้ animate ทำงานครั้งแรกเสมอ
        requestAnimationFrame(animate);
    }


    //ฟังก์ชันเอาไว้ลดจำนวนของรางวัลที่สุ่มได้ลง 1 ถ้าหมดแล้วให้ลบออกจากวงล้อเลย เอาไว้ใช้กันวงล้อของรางวัล
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

        //วาดวงล้อใหม่ให้ตรงกับข้อมูลล่าสุด
        draw(wheelrotation);
    }


    //ฟังก์ชันเอาไว้ลบรายชื่อที่ถูกสุ่มได้ออกจากวงล้อเลยทันที เอาไว้ใช่กับวงล้อรายชื่อ
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
        draw(wheelrotation);
    }

  //วาดวงล้อครั้งแรกไว้ก่อนตอนยังไม่กดสุ่ม
    draw(0);

  
    //ส่งฟังก์ชันออกไปให้ข้างนอกเรียกใช้ได้
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
            }

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
const btnopenpopupname = document.getElementById('btn_openpopupname');

if (btnopenpopupname){
    btnopenpopupname.addEventListener('click', function(){
        openDialog(document.getElementById('popuplistname_awardrecipient'));
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








});