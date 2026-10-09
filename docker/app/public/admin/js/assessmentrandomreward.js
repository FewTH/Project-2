document.addEventListener('DOMContentLoaded', function () {

    // อ่านข้อมูลจากตัวแปรที่มีใน spinwheel.blade
    let rewardData = window.rewardWheelData || [];
    const canvas = document.getElementById('wheelrewardCanvas');
    // กำหนดรูปแบบให้เป็นแบบวงกลม
    const ctx = canvas.getContext('2d');

    // ประกาศตัวแปรสำหรับรายชื่อผู้ตอบแบบประเมิน
    let nameData = window.nameWheelData || [];
    const assessmentId = window.assessmentId;
    const nameCanvas = document.getElementById('wheelNameCanvas');
    // กำหนดรูปแบบให้เป็นแบบวงกลม
    const nameCtx = nameCanvas.getContext('2d');

    const colors = ['#6c5ce7', '#00b894', '#fdcb6e', '#e17055', '#0984e3', '#d63031', '#e84393', '#00cec9'];


    // สร้างตัวแแปรไว้เก็บเสี้ยวของวงล้อเพื่อใช้คำนวนตอนหมุน
    let rewardWedges = [];
    let nameWedges = [];
    let rewardRotation = 0;
    let nameRotation = 0;

    //สร้างวงล้อรางวัล
    function drawWheel() {
        rewardWedges = [];
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        // ถ้าไม่มีรายการรางวัลในวงล้อเลยจะให้เป็นสีเทา
        if (rewardData.length === 0) {
            ctx.beginPath();
            ctx.arc(canvas.width / 2, canvas.height / 2, canvas.width / 2 - 10, 0, 2 * Math.PI);
            ctx.fillStyle = '#c1bdbd';
            ctx.fill();
            return;
        }

        const total = rewardData.reduce((sum, r) => sum + r.weight, 0);
        const centerX = canvas.width / 2;
        const centerY = canvas.height / 2;
        const radius = canvas.width / 2 - 10;
        let startAngle = 0;

        rewardData.forEach((reward, index) => {
            const sliceAngle = (reward.weight / total) * 2 * Math.PI;

            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.arc(centerX, centerY, radius, startAngle, startAngle + sliceAngle);
            ctx.closePath();
            ctx.fillStyle = colors[index % colors.length];
            ctx.fill();

            const midAngle = startAngle + sliceAngle / 2;
            const textX = centerX + Math.cos(midAngle) * (radius * 0.65);
            const textY = centerY + Math.sin(midAngle) * (radius * 0.65);

            ctx.save();
            ctx.translate(textX, textY);
            ctx.fillStyle = '#fff';
            ctx.font = '14px sans-serif';
            ctx.textAlign = 'center';
            ctx.fillText(`${reward.label} (${reward.quantity})`, 0, 0);
            ctx.restore();

            // เก็บค่าเสี้ยววงล้อ
            rewardWedges.push({id: reward.id, midAngle: midAngle});

            startAngle += sliceAngle;
        });
        // วงกลมขาวตรงกลางวงล้อ
        ctx.beginPath();
        ctx.arc(centerX, centerY, radius * 0.22,0,2*Math.PI);
        ctx.fillStyle = '#ffffff';
        ctx.fill();
    }

    //สร้างวงล้อรายชื่อ
    function drawNameWheel() {
        nameCtx.clearRect(0, 0, nameCanvas.width, nameCanvas.height);
        nameWedges=[];

        // ถ้าไม่มีรายการรางวัลในวงล้อเลยจะให้เป็นสีเทา
        if (nameData.length === 0) {
            nameCtx.beginPath();
            nameCtx.arc(nameCanvas.width / 2, nameCanvas.height / 2, nameCanvas.width / 2 - 10, 0, 2 * Math.PI);
            nameCtx.fillStyle = '#c1bdbd';
            nameCtx.fill();
            return;
        }

        const total = nameData.length; //ที่เป็นแบบนี้เพราะทุกคนมีน้ำหนักเท่ากันไม่เหมือนของรางวัล
        const centerX = nameCanvas.width / 2;
        const centerY = nameCanvas.height / 2;
        const radius = nameCanvas.width / 2 - 10;
        let startAngle = 0;

        nameData.forEach((person, index) => {
            const sliceAngle = (1 / total) * 2 * Math.PI;

            nameCtx.beginPath();
            nameCtx.moveTo(centerX, centerY);
            nameCtx.arc(centerX, centerY, radius, startAngle, startAngle + sliceAngle);
            nameCtx.closePath();
            nameCtx.fillStyle = colors[index % colors.length];
            nameCtx.fill();

            const midAngle = startAngle + sliceAngle / 2;
            const textX = centerX + Math.cos(midAngle) * (radius * 0.65);
            const textY = centerY + Math.sin(midAngle) * (radius * 0.65);

            nameCtx.save();
            nameCtx.translate(textX, textY);
            nameCtx.fillStyle = '#fff';
            nameCtx.font = '14px sans-serif';
            nameCtx.textAlign = 'center';
            nameCtx.fillText(`${person.label}`, 0, 0);
            nameCtx.restore();

            // เก็บค่าเสี้ยววงล้อ
            nameWedges.push({id: person.id, midAngle: midAngle});

            startAngle += sliceAngle;
        });
        // วงกลมขาวตรงกลางวงล้อ
        nameCtx.beginPath();
        nameCtx.arc(centerX, centerY, radius * 0.22,0,2*Math.PI);
        nameCtx.fillStyle = '#ffffff';
        nameCtx.fill();
    }
    
    document.getElementById('toggle-name-wheel').addEventListener('change',function(){
        const spinBtn = document.getElementById('spinassessmentBtn');
        spinBtn.disabled = !this.checked;
    });
    document.getElementById('toggle-reward-wheel').addEventListener('change',function(){
        const spinBtn = document.getElementById('spinassessmentBtn');
        spinBtn.disabled = !this.checked;
    });
    drawWheel();
    drawNameWheel();

    // คำนวนจุดหมุน
    function calcTargetRotation(currentRotation, wedges, winnerId){
        const wedge = wedges.find(w => w.id === winnerId);
        const midDeg = wedge.midAngle*(180/Math.PI);
        const extraSpins = 5*360;
        return currentRotation + extraSpins + ((270 - midDeg -(currentRotation % 360)) % 360+360) % 360;
    }
    document.getElementById('spinassessmentBtn').addEventListener('click', async function () {
        const btn = this;
        btn.disabled = true;
        
        try {
            const res = await fetch(`/admin/assessment/${assessmentId}/spin`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            const data = await res.json();
            if (!data.success){
                alert(data.message);
                btn.disabled = false;
                return;
            }
            rewardRotation = calcTargetRotation(rewardRotation, rewardWedges, data.winner_reward_id);
            nameRotation = calcTargetRotation(nameRotation, nameWedges, data.winner_respondent_id);

            canvas.style.transform = `rotate(${rewardRotation}deg)`;
            nameCanvas.style.transform = `rotate(${nameRotation}deg)`;

            setTimeout(()=>{

                document.getElementById('spinResultName').textContent = data.winner_name;
                document.getElementById('spinResultReward').textContent = data.winner_reward_label;
                document.getElementById('spinResultPopup').style.display = 'flex';
                
                rewardData = data.remaining_rewards;
                nameData = data.remaining_respondents;
                
                [canvas, nameCanvas].forEach(c =>{
                    c.style.transition = 'none';
                    c.style.transform = 'rotate(0deg)';
                });
                rewardRotation = 0;
                nameRotation = 0;
                drawWheel();
                drawNameWheel();

                void canvas.offsetWidth;
                [canvas, nameCanvas].forEach(c=>{
                    c.style.transition='transform 4s cubic-bezier(0.17, 0.67, 0.12, 0.99)';
                });

                btn.disabled=rewardData.length === 0 || nameData.length === 0;
            },4000);
        }catch (err){
            alert('เกิดข้อผิดพลาดในการสุ่ม');
            console.error(err);
            btn.disabled = false;
        }
    });
    document.getElementById('closeSpinResultBTN').addEventListener('click', function () {
        document.getElementById('spinResultPopup').style.display='none';
    });
});
