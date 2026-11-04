document.addEventListener('DOMContentLoaded', function () {

    //  ข้อมูลที่ส่งมาจาก spinwheel.blade 
    let rewardData = window.rewardWheelData || [];
    let nameData = window.nameWheelData || [];
    const assessmentId = window.assessmentId;

    const colors = ['#6c5ce7', '#00b894', '#fdcb6e', '#e17055', '#0984e3', '#d63031', '#e84393', '#00cec9'];

    //  ตั้งค่าแถบสุ่ม 
    const IDLE_CARD_COUNT = 24;   // จำนวนการ์ดที่โชว์ตอนยังไม่กดสุ่ม
    const FILLER_COUNT = 50;      // จำนวนการ์ดที่วิ่งผ่านก่อนถึงผู้ชนะ (ยิ่งมากยิ่งวิ่งไกล)
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const NAME_SPIN_MS = reduceMotion ? 1200 : 5000;
    const REWARD_SPIN_MS = reduceMotion ? 1200 : 6000; // ให้รางวัลหยุดทีหลังรายชื่อนิดนึง จะได้ลุ้น

    // ไอคอนบนการ์ด (เป็นข้อความคงที่ ใช้ innerHTML ได้ปลอดภัย)
    const ICON_PERSON = '<svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7"/></svg>';
    const ICON_GIFT = '<svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="8" width="18" height="5" rx="1"/><path d="M5 13v8h14v-8M12 8v13M12 8S10.5 3 7.5 4.5 9 8 12 8zM12 8s1.5-5 4.5-3.5S15 8 12 8z"/></svg>';

    // สีของรางวัลแต่ละอันผูกกับ id ไว้ตั้งแต่โหลดหน้า รางวัลเดิมจะได้สีเดิมตลอดแม้บางรางวัลหมดไปแล้ว
    const rewardColorMap = {};
    rewardData.forEach((r, i) => { rewardColorMap[r.id] = colors[i % colors.length]; });

    function nameColor(id) {
        const text = String(id);
        let hash = 0;
        for (let i = 0; i < text.length; i++) hash = (hash * 31 + text.charCodeAt(i)) | 0;
        return colors[Math.abs(hash) % colors.length];
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text ?? '';
        return div.innerHTML;
    }

    //  คลาสแถบสุ่มแนวนอน ใช้ร่วมกันทั้งแถบรายชื่อและแถบรางวัล 
    class Reel {
        constructor(viewport, renderCard) {
            this.viewport = viewport;
            this.strip = viewport.querySelector('.reel-strip');
            this.renderCard = renderCard;
            this.items = [];
            this.offset = 0;
            this.winnerIndex = null;
        }

        // ระยะจากการ์ดใบหนึ่งไปอีกใบ (กว้างการ์ด + ช่องว่าง) วัดจากหน้าจอจริง ไม่ต้องตั้งค่าให้ตรงกับ CSS
        step() {
            const cards = this.strip.children;
            if (cards.length >= 2) return cards[1].offsetLeft - cards[0].offsetLeft;
            return cards.length ? cards[0].offsetWidth : 0;
        }

        render(items) {
            this.strip.replaceChildren(...items.map(item => this.renderCard(item)));
            this.items = items;
        }

        moveTo(offset, durationMs = 0) {
            this.strip.style.transition = durationMs
                ? `transform ${durationMs}ms cubic-bezier(0.08, 0.7, 0.12, 1)`
                : 'none';
            this.strip.style.transform = `translateX(${-offset}px)`;
            this.offset = offset;
        }

        // หน้าตาตอนยังไม่ได้กดสุ่ม
        showIdle(pool, emptyText) {
            this.winnerIndex = null;
            if (pool.length === 0) {
                const empty = document.createElement('p');
                empty.className = 'reel-empty';
                empty.textContent = emptyText;
                this.strip.replaceChildren(empty);
                this.items = [];
                this.moveTo(0);
                return;
            }
            const items = Array.from({ length: IDLE_CARD_COUNT }, (_, i) => pool[i % pool.length]);
            this.render(items);
            this.moveTo(0);
        }

        // หมุนแถบให้ไปหยุดที่ winner คืนค่าเป็น Promise ที่จะเสร็จตอนแถบหยุด
        spin(winner, pickFiller, durationMs) {
            // เก็บการ์ดที่กำลังโชว์อยู่ไว้เป็นจุดเริ่ม จะได้ไม่กระตุกตอนเริ่มหมุน
            const oldStep = this.step();
            const firstVisible = oldStep ? Math.floor(this.offset / oldStep) : 0;
            const visibleCount = oldStep ? Math.ceil(this.viewport.clientWidth / oldStep) + 1 : 0;
            const keep = this.items.slice(firstVisible, firstVisible + visibleCount);
            const startOffset = oldStep ? this.offset - firstVisible * oldStep : 0;

            // แถบใหม่ = การ์ดที่โชว์อยู่ + การ์ดสุ่มผ่าน ๆ + ผู้ชนะ + การ์ดต่อท้ายไม่ให้ด้านขวาโล่ง
            const fillers = Array.from({ length: FILLER_COUNT }, pickFiller);
            const tail = Array.from({ length: 8 }, pickFiller);
            this.render([...keep, ...fillers, winner, ...tail]);
            this.winnerIndex = keep.length + fillers.length;

            this.moveTo(startOffset);
            void this.strip.offsetWidth; // บังคับให้เบราว์เซอร์วางตำแหน่งเริ่มก่อน แล้วค่อยเริ่มแอนิเมชัน

            const step = this.step();
            const cardWidth = this.strip.children[this.winnerIndex].offsetWidth;
            const jitter = (Math.random() - 0.5) * cardWidth * 0.7; // ไม่ให้หยุดกลางการ์ดเป๊ะทุกครั้ง ดูเป็นธรรมชาติกว่า
            const target = this.winnerIndex * step + cardWidth / 2 - this.viewport.clientWidth / 2 + jitter;

            return new Promise(resolve => {
                let finished = false;
                const finish = () => {
                    if (finished) return;
                    finished = true;
                    clearTimeout(fallback);
                    this.strip.removeEventListener('transitionend', onEnd);
                    this.strip.children[this.winnerIndex]?.classList.add('is-winner');
                    resolve();
                };
                const onEnd = e => {
                    if (e.target === this.strip && e.propertyName === 'transform') finish();
                };
                this.strip.addEventListener('transitionend', onEnd);
                const fallback = setTimeout(finish, durationMs + 300); // กันกรณี transitionend ไม่ทำงาน
                this.moveTo(target, durationMs);
            });
        }

        // ตอนย่อขยายหน้าจอ ให้การ์ดผู้ชนะยังอยู่ใต้เข็มกลาง
        recenter() {
            if (this.winnerIndex === null) return;
            const card = this.strip.children[this.winnerIndex];
            if (!card) return;
            this.moveTo(this.winnerIndex * this.step() + card.offsetWidth / 2 - this.viewport.clientWidth / 2);
        }
    }

    //  หน้าตาการ์ด
    function buildCard(kindClass, color, icon, labelText) {
        const card = document.createElement('div');
        card.className = `reel-card ${kindClass}`;
        card.style.setProperty('--card-color', color);

        const iconWrap = document.createElement('div');
        iconWrap.className = 'reel-card-icon';
        iconWrap.innerHTML = icon;

        const label = document.createElement('p');
        label.className = 'reel-card-label';
        label.textContent = labelText; // ใช้ textContent กันชื่อที่มีแท็ก HTML

        card.append(iconWrap, label);
        return card;
    }

    const nameReel = new Reel(
        document.getElementById('nameReel'),
        person => buildCard('reel-card--name', nameColor(person.id), ICON_PERSON, person.label)
    );
    const rewardReel = new Reel(
        document.getElementById('rewardReel'),
        reward => buildCard('reel-card--reward', rewardColorMap[reward.id] || colors[0], ICON_GIFT, reward.label)
    );

    // การ์ดที่วิ่งผ่าน: รางวัลสุ่มตามน้ำหนัก จะได้เห็นรางวัลที่ออกง่ายผ่านตาบ่อยกว่า
    function pickWeightedReward() {
        const total = rewardData.reduce((sum, r) => sum + Number(r.weight), 0);
        let point = Math.random() * total;
        for (const reward of rewardData) {
            point -= Number(reward.weight);
            if (point <= 0) return reward;
        }
        return rewardData[rewardData.length - 1];
    }

    function pickRandomName() {
        return nameData[Math.floor(Math.random() * nameData.length)];
    }

    //  ผู้โชคดีล่าสุด (เก็บแยกตามแบบประเมินใน localStorage) 
    const storageKey = 'recentWinners_' + assessmentId;
    let recentWinners = [];
    try {
        recentWinners = JSON.parse(localStorage.getItem(storageKey)) || [];
    } catch (e) {
        recentWinners = [];
    }

    function renderRecentWinners() {
        const container = document.getElementById('recentWinnersList');
        if (!container) return;

        if (recentWinners.length === 0) {
            container.innerHTML = '<p class="footer-no-winner">ยังไม่มีผู้โชคดี</p>';
            return;
        }

        container.innerHTML = recentWinners.map((winner, idx) => `
            <div class="winner-row">
                <div class="winner-badge">${idx + 1}</div>
                <div class="winner-info">
                    <span class="winner-name">${escapeHtml(winner.name)}</span>
                    <span class="winner-reward-text">ได้รับ: ${escapeHtml(winner.reward)}</span>
                </div>
            </div>
        `).join('');
    }

    function addRecentWinner(winnerName, rewardName) {
        recentWinners.unshift({ name: winnerName, reward: rewardName });
        recentWinners = recentWinners.slice(0, 3); // เก็บแค่ 3 คนล่าสุด
        localStorage.setItem(storageKey, JSON.stringify(recentWinners));
        renderRecentWinners();
    }

    //  อัตราการออกของรางวัล 
    function updateRewardProbabilities() {
        const container = document.getElementById('rewardProbabilityList');
        if (!container) return;

        if (rewardData.length === 0) {
            container.innerHTML = '<p class="no-reward-text">ยังไม่มีรายการรางวัล</p>';
            return;
        }

        container.innerHTML = rewardData.map(reward => `
            <div class="footer-probability-row">
                <div class="reward-prob-left">
                    <span class="reward-dot"></span>
                    <span class="footer-probability-label">${escapeHtml(reward.label)}</span>
                </div>
                <span class="footer-probability-value">${escapeHtml(String(reward.rate))}%</span>
            </div>
        `).join('');
    }

    //  ตัวเลขจำนวนบนหัวกล่อง 
    function updateCounts() {
        const respondentCount = document.getElementById('respondentCount');
        if (respondentCount) respondentCount.textContent = `จำนวนรายชื่อทั้งหมด (${nameData.length})`;

        const rewardCount = document.getElementById('rewardCount');
        if (rewardCount) {
            const totalQty = rewardData.reduce((sum, r) => sum + Number(r.quantity ?? r.quantity_selected ?? 0), 0);
            rewardCount.textContent = `จำนวนรางวัลทั้งหมด (${totalQty})`;
        }
    }

    //  ปุ่มเปิด/ปิด และปุ่มสุ่ม 
    const spinBtn = document.getElementById('spinassessmentBtn');
    const toggleName = document.getElementById('toggle-name-wheel');
    const toggleReward = document.getElementById('toggle-reward-wheel');
    let isSpinning = false;

    // กดสุ่มได้ก็ต่อเมื่อเปิดทั้งสองแถบ ยังมีรายชื่อและรางวัลเหลือ และไม่ได้กำลังหมุนอยู่
    function updateSpinButton() {
        const togglesOn = toggleName.checked && toggleReward.checked;
        spinBtn.disabled = isSpinning || !togglesOn || rewardData.length === 0 || nameData.length === 0;
    }

    toggleName.addEventListener('change', function () {
        document.getElementById('nameReelSection')?.classList.toggle('is-off', !this.checked);
        updateSpinButton();
    });
    toggleReward.addEventListener('change', function () {
        document.getElementById('rewardReelSection')?.classList.toggle('is-off', !this.checked);
        updateSpinButton();
    });

    spinBtn.addEventListener('click', async function () {
        if (isSpinning) return;
        isSpinning = true;
        updateSpinButton();

        try {
            const res = await fetch(window.spinUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            const data = await res.json();
            if (!res.ok || !data.success) {
                alert(data.message || 'สุ่มไม่สำเร็จ กรุณาลองใหม่');
                return;
            }

            // ผลสุ่มมาจาก server แถบแค่วิ่งไปหยุดให้ตรงกับผลนั้น
            const winnerName = { id: data.winner_respondent_id, label: data.winner_name };
            const winnerReward = { id: data.winner_reward_id, label: data.winner_reward_label };

            await Promise.all([
                nameReel.spin(winnerName, pickRandomName, NAME_SPIN_MS),
                rewardReel.spin(winnerReward, pickWeightedReward, REWARD_SPIN_MS),
            ]);

            document.getElementById('spinResultName').textContent = data.winner_name;
            document.getElementById('spinResultReward').textContent = data.winner_reward_label;
            document.getElementById('spinResultPopup').style.display = 'flex';

            addRecentWinner(data.winner_name, data.winner_reward_label);

            // อัปเดตข้อมูลที่เหลือหลังสุ่ม รอบหน้าการ์ดที่วิ่งผ่านจะไม่มีคนที่ได้ไปแล้ว
            rewardData = data.remaining_rewards;
            nameData = data.remaining_respondents;
            updateRewardProbabilities();
            updateCounts();
        } catch (err) {
            alert('เกิดข้อผิดพลาดในการสุ่ม');
            console.error(err);
        } finally {
            isSpinning = false;
            updateSpinButton();
        }
    });

    document.getElementById('closeSpinResultBTN').addEventListener('click', function () {
        document.getElementById('spinResultPopup').style.display = 'none';
    });

    window.addEventListener('resize', function () {
        if (isSpinning) return;
        nameReel.recenter();
        rewardReel.recenter();
    });

    //  เริ่มต้นตอนโหลดหน้า 
    nameReel.showIdle(nameData, 'ไม่มีรายชื่อเหลือให้สุ่ม');
    rewardReel.showIdle(rewardData, 'รางวัลหมดแล้ว');
    updateRewardProbabilities();
    renderRecentWinners();
    updateSpinButton();
});