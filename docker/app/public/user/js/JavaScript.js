//เอาไว้บอกว่าให้สร้าง html ให้เสร็จก่อนแล้วค่อยมาเรียกใช่ js
document.addEventListener('DOMContentLoaded', function(){

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