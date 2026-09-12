document.addEventListener('DOMContentLoaded', function () {
    // ตัวแปรนี้ไว้เก็บรางวัลที่เลือก
    const selectedRe = new Map();
    // ตัวแปรเก็บวงล้อที่เราประกาศไว้ที่หน้าhtml
    const canvas = document.getElementById('wheel-spn-reward');
    // ประกาศตัวแปรนี้ว่าเก็บเป็นวงกลม
    const ctx = canvas.getContext('2d');
    // อันนี้จะเป็นตัวนับจำนวนรายการรางวัลที่เลือกมาใส่วงล้อละก็จะนับแล้วไปแสดงที่ html
    const selectedCount = document.getElementById('slected-count');
    // อันนี้คือดึงid ของปุ่มบันทึกวงล้อมาใช้แล้วเก็บไว้ในตัวแปรชื่อ savebtn
    const savebtn = document.getElementById('submit-btn-wheel');
    // ตัวแปรที่เก็บid ของปุ่มล้างทั้งหมด
    const clearAllbtn = document.getElementById('clearAllselected')
    // ตัวแปรที่เก็บค่าสีเพื่อไว้แสดงตอนเลือกรางวัล
    const colors = ['#6c5ce7', '#00b894', '#fdcb6e', '#e17055', '#0984e3', '#d63031', '#e84393', '#00cec9'];

    // สร้างวงล้อ
    function drawWheel(){
        ctx.clearRect(0,0,canvas.width,canvas.height);
        // |
        const rewardArray = Array.from(selectedRe.values());

        // อันนี้เป็นตอนที่ยังไม่ได้เลือกรางวัลเลย
        if(rewardArray.length === 0){
            ctx.beginPath();
            ctx.arc(canvas.width/2,canvas.height/2,canvas.width/2-10,0,2*Math.PI);
            ctx.fillStyle = '#c1bdbd'
            ctx.fill();
            return;
        }
        // อันนี้คำนวนเปอเซ็นต์แล้วเก็บค่าไว้ที่ตัวแปร total
        const total = rewardArray.reduce((sum,r)=> sum +(r.rate*r.qty),0);
        // 
        const centerX = canvas.width/2;
        const centerY = canvas.height/2;
        const radius = canvas.width/2-10;
        let startAngle=0;

        rewardArray.forEach((reward,index)=>{
        const weight = reward.rate*reward.qty;
        const sliceAngle = (weight/total)*2*Math.PI;

        // วาดเสี้ยว
        ctx.beginPath();
        ctx.moveTo(centerX, centerY);
        ctx.arc(centerX, centerY, radius, startAngle, startAngle + sliceAngle);
        ctx.closePath();
        ctx.fillStyle = colors[index % colors.length];
        ctx.fill();

        // เขียนชื่อรางวัลลงกลางเสี้ยว
        const midAngle = startAngle + sliceAngle / 2;
        const textX = centerX + Math.cos(midAngle) * (radius * 0.65);
        const textY = centerY + Math.sin(midAngle) * (radius * 0.65);

        ctx.save();
        ctx.translate(textX, textY);
        ctx.fillStyle = '#fff';
        ctx.font = '16px sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText(reward.name, 0, 0);
        ctx.restore();

        startAngle += sliceAngle;
        });
    }
    // ส่วนี้ไว้อัปเดตจำนวนที่เลือก
    function updateUI(){
        const count = selectedRe.size;
        selectedCount.textContent = count;
        // บังคับให้เลือกขั้นต่ำ2รายการ
        savebtn.disabled=count < 2;
        clearAllbtn.disabled=count === 0;

        drawWheel();
    }
    // 
    document.querySelectorAll('.reward-wheel-1').forEach(item=>{
        const id = item.dataset.id;
        const name = item.dataset.name;
        const rate = parseFloat(item.dataset.rate);
        const checkbox = item.querySelector('.reward-check-box');
        const qtyInput = item.querySelector('.qnty-in');
        const minusBtn = item.querySelector('.qnty-minus');
        const plusBtn = item.querySelector('.qnty-plus');

        checkbox.addEventListener('change', function(){
        if(checkbox.checked){
            selectedRe.set(id,{
            id:id,
            name:name,
            rate:rate,
            qty:parseInt(qtyInput.value)
            });
        }
        else {
            selectedRe.delete(id);
        }
            updateUI();
    });
        // ส่วนของปุ่มลบ
        minusBtn.addEventListener('click', function () {
        let val = parseInt(qtyInput.value);
        if (val > parseInt(qtyInput.min)) {
        qtyInput.value = val - 1;
        syncQtyIfSelected();
            }
    });
        // ส่วนของปุ่มเพิ่ม
        plusBtn.addEventListener('click', function () {
        let val = parseInt(qtyInput.value);
        if (val < parseInt(qtyInput.max)) {
        qtyInput.value = val + 1;
        syncQtyIfSelected();
        }
    });
        function syncQtyIfSelected() {
        if (selectedRe.has(id)) {
        selectedRe.get(id).qty = parseInt(qtyInput.value);
        updateUI();
            }
        }
    });
    // ปุ่มล้างทั้งหมด
    clearAllbtn.addEventListener('click', function () {
    selectedRe.clear();
    document.querySelectorAll('.reward-check-box').forEach(cb => cb.checked = false);
    document.querySelectorAll('.qnty-in').forEach(input=>input.value=1);
    updateUI();
    });
    // วาดวงล้อเปล่าไว้ตั้งแต่โหลดหน้าครั้งแรก
    drawWheel();

    // ส่วนของpopup
const assessmentModal = document.getElementById('assessmentModal');
const closeModalBtn = document.getElementById('closeModalBtn');
const confirmAssessmentBtn = document.getElementById('confirmAssessmentBtn');
const cancelAssessmentBtn = document.getElementById('cancelAssessmentBtn');
const wheelItemCountn1 = document.getElementById('wheelItemCount');
const wheelItemnamesn1 = document.getElementById('wheeItemnames');
const assessmentListBodyn1 = document.getElementById('assessmentListBody');

// ปุ่มบันทึกตรวงล้อ
savebtn.addEventListener('click',async function(){
    // ฟังก์ชันนี้จะเอารางวัลที่เราเลือกไว้มาแสดงด้านบนป็อปอัป
    const rewardsArray = Array.from(selectedRe.values()); 
    wheelItemCountn1.textContent = rewardsArray.length;
    wheelItemnamesn1.textContent = rewardsArray.map(r=>r.name).join(',');
    // ดึงแบบประเมินที่ยังไม่ถูกเพิ่มวงล้อ
    try{
        const res = await fetch('/admin/assessments/available');
        const assessments = await res.json();
        renderAssessmentList(assessments);
    }
    catch(err){
        alert('ไม่สามารถโหลดรายแการแบบประเมินได้')
        console.error(err);
        return;
    }
    // เปิดป้อปอัป
    assessmentModal.style.display = 'flex';
});
// checkbox 
function renderAssessmentList(assessments) {
    assessmentListBodyn1.innerHTML = ''; // เคลียร์ของเก่าก่อนทุกครั้ง

    if (assessments.length === 0) {
        assessmentListBodyn1.innerHTML = '<p class="no-data">ไม่มีแบบประเมินที่สามารถผูกได้ในขณะนี้</p>';
        return;
    }

    assessments.forEach(a => {
        const row = document.createElement('div');
        row.className = 'assess-row';
        row.innerHTML = `
            <div class="assess-row-info">
                <input type="checkbox" class="assessment-checkbox" value="${a.id}">
                <div>
                    <p class="assess-name">${a.name}</p>
                    <p class="assess-meta">สร้างโดย: ${a.created_by} • เปิดรับถึง: ${a.closed_at}</p>
                </div>
            </div>
            <span class="assess-status">เปิดอยู่</span>
        `;
        assessmentListBodyn1.appendChild(row);
    });
}

// ฟังก์ชันปิดปอปอัป
closeModalBtn.addEventListener('click', closeAssessmentModal);
cancelAssessmentBtn.addEventListener('click', closeAssessmentModal);
function closeAssessmentModal(){
    assessmentModal.style.display = 'none';
}

// กดบันทึกแล้วบันทึกจริงใน myadmin
confirmAssessmentBtn.addEventListener('click', async function () {
    const checkedBoxes = document.querySelectorAll('.assessment-checkbox:checked');
    const assessmentIds = Array.from(checkedBoxes).map(cb => parseInt(cb.value));

    if (assessmentIds.length === 0) {
        alert('กรุณาเลือกอย่างน้อย 1 แบบประเมิน');
        return;
    }

    // เตรียมข้อมูลของรางวัลที่เลือกไว้ในวงล้อ
    const items = Array.from(selectedRe.values()).map(r => ({
        reward_id: parseInt(r.id),
        quantity_selected: r.qty
    }));

    try {
        const res = await fetch('/admin/managespin/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                items: items,
                assessment_ids: assessmentIds
            })
        });
        
        // ตรวจสอบว่า Server ตอบกลับมาสำเร็จหรือไม่ (HTTP 200 OK)
        if (!res.ok) {
            alert(`เกิดข้อผิดพลาดจาก Server (HTTP Status: ${res.status})`);
            return;
        }

        const data = await res.json();

        if (data.success) {
            alert('บันทึกวงล้อสำเร็จ');
            closeAssessmentModal();
            window.location.reload(); // รีเฟรชหน้าให้ล้างค่าที่เลือกไว้ทั้งหมด
        } else {
            alert('เกิดข้อผิดพลาด: ' + (data.message || 'ไม่ทราบสาเหตุ'));
        }
    } catch (err) {
        alert('ไม่สามารถบันทึกวงล้อได้ กรุณาลองใหม่');
        console.error(err);
    }
});
});


