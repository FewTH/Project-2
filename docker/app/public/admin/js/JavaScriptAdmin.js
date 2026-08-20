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
const butactivity = document.getElementById('btn_activity')

if (butactivity){
//ปุ่มกดรายการกิจกรรมของหน้า assessment.blade.php
butactivity.addEventListener('click', function() {
    document.getElementById('frame_grey').classList.add('active');
    document.getElementById('frame_evaluation').classList.remove('active');
    document.getElementById('btn_activity').classList.add('active');
    document.getElementById('btn_rate').classList.remove('active');
    document.getElementById('number_activity').classList.add('active');
    document.getElementById('number_rate').classList.remove('active');
    moveBulb(document.getElementById('btn_activity'));
});
}

const btnrate = document.getElementById('btn_rate')

if(btnrate){
//ปุ่มกดแบบประเมินของหน้า assessment.blade.php
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


//ปุ่มทั้งหมดของหน้า assessment.blade.php
const frameallassessment =  document.getElementById('frameall_assessment');

if(frameallassessment);{
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
    });
}


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
    })
}



//ส่วนของหน้า profile.blade.php
//ปุ่มเปิดpopupเปลี่ยนรูปโปรไฟล์ หน้า profile.blade.php
const btnopen_1 = document.getElementById('btn_open_1');

if(btnopen_1){
    btnopen_1.addEventListener('click', function(){
        document.getElementById('image-popup').showModal();
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
        document.getElementById('popup_btn_edit').showModal();
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
        document.getElementById('popup_btn_Change').showModal();
    });
}

//ปุ่มปิดpopupเปลี่ยนรหัสผ่าน หน้า profile.blade.php
const btnclosechange = document.getElementById('btn_close_change');

if(btnclosechange){
    btnclosechange.addEventListener('click', function(){
        document.getElementById('popup_btn_Change').close();
    });
}















});