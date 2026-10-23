document.addEventListener('DOMContentLoaded', function () {
    // ดึงช่องค้นหากับี่งวัล
    const searchInput = document.querySelector('.usr-searchbox');
    const userList = document.querySelectorAll('.user-1');

    if(searchInput) {
        // ตรวจข้อความที่พิม
        searchInput.addEventListener('input', function (e) {
            const searchTerm = e.target.value.toLowerCase().trim();

            // วนลูปเช็คข้อมูล
            userList.forEach(row => {
                // ดึงข้อความในแถวนั้นมาแสดง
                const rowtext = row.textContent.toLowerCase();

                // ตรวจสอบว่ามีค่าที่พิมพ์ค้นหาอมั้ย
                if (rowtext.includes(searchTerm)) {
                    row.classList.remove('is-hidden');
                }else {
                    row.classList.add('is-hidden');
                }
            });
        });
    }
});