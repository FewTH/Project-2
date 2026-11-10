document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('reward_search');

    if (searchInput && searchInput.form) {
        let searchTimer;

        // พิมพ์เสร็จแล้วรอสักครู่ค่อยส่งฟอร์มไปค้นทั้งระบบ
        searchInput.addEventListener('input', function () {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(function () {
                searchInput.form.submit();
            }, 400);
        });

        // หลังรีโหลด คืนเคอร์เซอร์ไว้ท้ายคำค้นหา
        if (searchInput.value) {
            searchInput.focus();
            const len = searchInput.value.length;
            searchInput.setSelectionRange(len, len);
        }
    }
});