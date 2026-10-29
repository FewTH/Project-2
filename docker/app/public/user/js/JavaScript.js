//เอาไว้บอกว่าให้สร้าง html ให้เสร็จก่อนแล้วค่อยมาเรียกใช้ js
document.addEventListener('DOMContentLoaded', function () {
    // ส่วนของหน้า profile.blade.php

    /* ฟังก์ชันเอาไว้ไปดึงใช้ของปุ่มเปิด ปิด popup ให้มี Animation */
    function openDialog(dialog) {
        if (!dialog) return;

        dialog.showModal();
        document.body.classList.add('no-scroll');

        requestAnimationFrame(function () {
            dialog.classList.add('show');
        });
    }

    function closeDialog(dialog) {
        if (!dialog) return;

        dialog.classList.remove('show');

        setTimeout(function () {
            dialog.close();

            const nothaveunlock = document.querySelector('dialog[open]');
            if (!nothaveunlock) {
                document.body.classList.remove('no-scroll');
            }
        }, 200);
    }

    // ปุ่มเปิด popup เปลี่ยนรูปโปรไฟล์
    const btnopen_1 = document.getElementById('btn_open_1');

    if (btnopen_1) {
        btnopen_1.addEventListener('click', function () {
            openDialog(document.getElementById('image-popup'));
            closeDialog(document.getElementById('popup_btn_Change'));
            closeDialog(document.getElementById('popup_btn_edit'));
        });
    }

    // ปุ่มปิด popup เปลี่ยนรูปโปรไฟล์
    const btnclose_1 = document.getElementById('btn_close_1');

    if (btnclose_1) {
        btnclose_1.addEventListener('click', function () {
            closeDialog(document.getElementById('image-popup'));
        });
    }

    // ปุ่มเปิด popup แก้ไขข้อมูล
    const editinformation = document.getElementById('Edit_information');

    if (editinformation) {
        editinformation.addEventListener('click', function () {
            openDialog(document.getElementById('popup_btn_edit'));
            closeDialog(document.getElementById('image-popup'));
            closeDialog(document.getElementById('popup_btn_Change'));
        });
    }

    // ปุ่มปิด popup แก้ไขข้อมูล
    const btncloseedit = document.getElementById('btn_close_Edit');

    if (btncloseedit) {
        btncloseedit.addEventListener('click', function () {
            closeDialog(document.getElementById('popup_btn_edit'));
        });
    }

    // ปุ่มเปิด popup เปลี่ยนรหัสผ่าน
    const Changepassword = document.getElementById('Change_password');

    if (Changepassword) {
        Changepassword.addEventListener('click', function () {
            openDialog(document.getElementById('popup_btn_Change'));
            closeDialog(document.getElementById('popup_btn_edit'));
            closeDialog(document.getElementById('image-popup'));
        });
    }

    // ปุ่มปิด popup เปลี่ยนรหัสผ่าน
    const btnclosechange = document.getElementById('btn_close_change');

    if (btnclosechange) {
        btnclosechange.addEventListener('click', function () {
            closeDialog(document.getElementById('popup_btn_Change'));
        });
    }

    // เอาไว้เวลาโหลดหน้าแล้ว popup จะไม่ปิด
    const imagepopup = document.getElementById('image-popup');

    if (imagepopup && imagepopup.dataset.open === 'true') {
        openDialog(imagepopup);
    }

    // ปุ่มเปิด/ปิดดูรหัสผ่านปัจจุบัน
    const imgeye1 = document.getElementById('img_eye_1');
    const iconeye1 = document.getElementById('icon_eye_1');
    const TypeCurrentpassword1 = document.getElementById('Type_Current_password_1');

    if (imgeye1 && TypeCurrentpassword1 && iconeye1) {
        imgeye1.addEventListener('click', function () {
            const ispassword1 = TypeCurrentpassword1.type === 'password';
            TypeCurrentpassword1.type = ispassword1 ? 'text' : 'password';
            iconeye1.className = ispassword1 ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
        });
    }

    // ปุ่มเปิด/ปิดดูรหัสผ่านใหม่
    const imgeye2 = document.getElementById('img_eye_2');
    const iconeye2 = document.getElementById('icon_eye_2');
    const Typepasswordcurrent1 = document.getElementById('Type_passwordcurrent_1');

    if (imgeye2 && Typepasswordcurrent1 && iconeye2) {
        imgeye2.addEventListener('click', function () {
            const ispassword2 = Typepasswordcurrent1.type === 'password';
            Typepasswordcurrent1.type = ispassword2 ? 'text' : 'password';
            iconeye2.className = ispassword2 ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
        });
    }

    // เมื่อกดเลือกรูปโปรไฟล์เสร็จ ก็จะส่งไปบอก ProfileController ทันที
    const uploadPhotoInput = document.getElementById('uploadphoto');
    const profileForm = document.getElementById('profileForm');

    if (uploadPhotoInput && profileForm) {
        uploadPhotoInput.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                profileForm.submit();
            }
        });
    }

    // ส่วนของหน้า view_details.blade.php
    // ใช้สำหรับนับเวลาถอยหลังปิด Register ของหน้ารายละเอียดกิจกรรม
    const numbertime = document.getElementById('number_time');

    if (numbertime) {
        let time = Number(numbertime.dataset.seconds);

        const timeoffregister = setInterval(function () {

            if (time <= 0) {
                clearInterval(timeoffregister);
                numbertime.innerHTML = '00:00';
            } else {
                let hour = Math.floor(time / 3600);
                let minute = Math.floor((time % 3600) / 60);
                let second = Math.floor(time % 60);

                if (hour < 10) {
                    hour = '0' + hour;
                }
                if (minute < 10) {
                    minute = '0' + minute;
                }
                if (second < 10) {
                    second = '0' + second;
                }

                if (Number(hour) > 0) {
                    numbertime.innerHTML = hour + ':' + minute + ':' + second;
                } else {
                    numbertime.innerHTML = minute + ':' + second;
                }

                time--;
            }

        }, 1000);
    }

    // ส่วนของหน้า contact.blade.php
    const Galleryimgleft = document.getElementById('Gallery_img_left');
    const Galleryimgcenter = document.getElementById('Gallery_img_center');
    const Galleryimgright = document.getElementById('Gallery_img_right');
    const arrowleft = document.getElementById('arrow_left');
    const arrowright = document.getElementById('arrow_right');

    if (Galleryimgleft && Galleryimgcenter && Galleryimgright && arrowleft && arrowright) {

        const imageleft1 = Galleryimgleft.src;
        const imagecenter2 = Galleryimgcenter.src;
        const imageright3 = Galleryimgright.src;

        let findpicture = 2;

        // เอาไว้ให้รูปเปลี่ยนตรงกับ findpicture
        function showimage() {
            if (findpicture === 1) {
                Galleryimgleft.src = imageright3;
                Galleryimgcenter.src = imageleft1;
                Galleryimgright.src = imagecenter2;
            } else if (findpicture === 2) {
                Galleryimgleft.src = imageleft1;
                Galleryimgcenter.src = imagecenter2;
                Galleryimgright.src = imageright3;
            } else if (findpicture === 3) {
                Galleryimgleft.src = imagecenter2;
                Galleryimgcenter.src = imageright3;
                Galleryimgright.src = imageleft1;
            }
        }

        // ปุ่มกดเปลี่ยนรูปไปทางขวา
        arrowright.addEventListener('click', function () {
            if (findpicture === 1) {
                findpicture = 2;
            } else if (findpicture === 2) {
                findpicture = 3;
            } else if (findpicture === 3) {
                findpicture = 1;
            }

            showimage();
        });

        // ปุ่มกดเปลี่ยนรูปไปทางซ้าย
        arrowleft.addEventListener('click', function () {
            if (findpicture === 1) {
                findpicture = 3;
            } else if (findpicture === 2) {
                findpicture = 1;
            } else if (findpicture === 3) {
                findpicture = 2;
            }

            showimage();
        });
    }
    // หน้า spin.blade.php : ค้นหา + กรองสถานะ
    
    const searchInput = document.querySelector('.search-spin2');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.sectionassessment');
    const noResult = document.getElementById('no-result'); // ไม่บังคับ มีหรือไม่มีก็ได้

    let currentFilter = 'all';

    function filterAssessments() {
        const keyword = searchInput ? searchInput.value.toLowerCase().trim() : '';
        let visibleCount = 0;

        items.forEach(function (item) {
            let assessmentName = item.getAttribute('data-name');

            if (!assessmentName) {
                const nameEl = item.querySelector('.section-assessment');
                assessmentName = nameEl ? nameEl.textContent : '';
            }
            assessmentName = assessmentName.toLowerCase();

            // data-status ค่าจะเป็น spined หรือ not-spin
            const status = item.getAttribute('data-status');

            const matchesSearch = assessmentName.includes(keyword);
            let matchesFilter = true;

            if (currentFilter === 'spined') {
                matchesFilter = (status === 'spined');
            } else if (currentFilter === 'not-spin') {
                matchesFilter = (status === 'not-spin');
            }

            if (matchesSearch && matchesFilter) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // แสดงข้อความเมื่อไม่พบรายการ 
        if (noResult && items.length > 0) {
            noResult.style.display = visibleCount === 0 ? '' : 'none';
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterAssessments);
    }

    filterButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            filterButtons.forEach(function (btn) {
                btn.classList.remove('active');
            });
            this.classList.add('active');

            if (this.id === 'all-btn') {
                currentFilter = 'all';
            } else if (this.id === 'spined-btn') {
                currentFilter = 'spined';
            } else if (this.id === 'not-spin') {
                currentFilter = 'not-spin';
            }

            filterAssessments();
        });
    });

    // ปุ่มเปิด/ปิดดูรหัสผ่านหน้า login
    const loginEyeBtn = document.getElementById('img_eye_2');
    const loginEyeIcon = document.getElementById('icon_eye_2');
    const loginPasswd = document.getElementById('passwd-log');

    if (loginEyeBtn && loginPasswd && loginEyeIcon) {
        loginEyeBtn.addEventListener('click', function () {
            const isPassword = loginPasswd.type === 'password';
            loginPasswd.type = isPassword ? 'text' : 'password';
            loginEyeIcon.className = isPassword ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
        });
    }

});