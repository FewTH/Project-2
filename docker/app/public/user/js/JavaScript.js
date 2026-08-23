//เอาไว้บอกว่าให้สร้าง html ให้เสร็จก่อนแล้วค่อยมาเรียกใช่ js
document.addEventListener('DOMContentLoaded', function(){


//ส่วนของหน้า profile.blade.php
//ปุ่มเปิดpopupเปลี่ยนรูปโปรไฟล์ หน้า profile.blade.php
const btnopen_1 = document.getElementById('btn_open_1');

if(btnopen_1){
    btnopen_1.addEventListener('click', function(){
        document.getElementById('image-popup').show();
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
    });
}

//ปุ่มปิดpopupเปลี่ยนรหัสผ่าน หน้า profile.blade.php
const btnclosechange = document.getElementById('btn_close_change');

if(btnclosechange){
    btnclosechange.addEventListener('click', function(){
        document.getElementById('popup_btn_Change').close();
    });
}



//หน้า spin.blade.php
   const allbtn = document.getElementById('all-btn');

    if(allbtn);
        allbtn.addEventListener('click', function(){
            document.getElementById('all-btn').classList.add('active');
            document.getElementById('spined-btn').classList.remove('active');
            document.getElementById('not-spin').classList.remove('active');
            
        });

    const spinedbtn = document.getElementById('spined-btn');  
    
    if(spinedbtn);
        spinedbtn.addEventListener('click', function(){
            document.getElementById('spined-btn').classList.add('active');
            document.getElementById('all-btn').classList.remove('active');
            document.getElementById('not-spin').classList.remove('active');
            
        });











});