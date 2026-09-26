document.addEventListener('DOMContentLoaded', function () {

    // อ่านข้อมูลจากตัวแปร global ที่ Blade เตรียมไว้ให้
    const rewardData = window.rewardWheelData || [];

    const canvas = document.getElementById('rewardWheelCanvas');
    const ctx = canvas.getContext('2d');
    const colors = ['#6c5ce7', '#00b894', '#fdcb6e', '#e17055', '#0984e3', '#d63031', '#e84393', '#00cec9'];

    function drawWheel() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

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
            ctx.fillText(reward.label, 0, 0);
            ctx.restore();

            startAngle += sliceAngle;
        });
    }

    drawWheel();

    // ---------- ปุ่มสุ่มรางวัล ----------
    document.getElementById('spinBtn').addEventListener('click', function () {
        // ส่วนนี้จะเขียนต่อทีหลัง
    });

});