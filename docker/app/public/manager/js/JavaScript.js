//เอาไว้บอกว่าให้สร้าง html ให้เสร็จก่อนแล้วค่อยมาเรียกใช่ js
document.addEventListener('DOMContentLoaded', function(){


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

//เอาไว้เวลาโหลดหน้าแล้วปุ่ม popup จะไม่ปิด
const imagepopup = document.getElementById('image-popup');

if(imagepopup && imagepopup.dataset.open === 'true'){
    imagepopup.show();
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






    
});