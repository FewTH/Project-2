document.addEventListener('DOMContentLoaded', function () {
    // เก็บรางวัลที่เลือกไว้ (key = reward_id)
    const selectedRe = new Map();
    const selectedCount = document.getElementById('slected-count');
    const savebtn = document.getElementById('submit-btn-wheel');
    const clearAllbtn = document.getElementById('clearAllselected');
    const testSpinBtn = document.getElementById('testSpinBtn');
    const chanceList = document.getElementById('chanceList');
    const colors = ['#6c5ce7', '#00b894', '#fdcb6e', '#e17055', '#0984e3', '#d63031', '#e84393', '#00cec9'];

    // ===== ตั้งค่าแถบตัวอย่าง =====
    const IDLE_CARD_COUNT = 16;
    const FILLER_COUNT = 40;
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const TEST_SPIN_MS = reduceMotion ? 1000 : 3500;
    const ICON_GIFT = '<svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="8" width="18" height="5" rx="1"/><path d="M5 13v8h14v-8M12 8v13M12 8S10.5 3 7.5 4.5 9 8 12 8zM12 8s1.5-5 4.5-3.5S15 8 12 8z"/></svg>';

    // สีประจำรางวัลผูกกับลำดับในคลัง รางวัลเดิมจะได้สีเดิมเสมอ ไม่ว่าจะเลือกก่อนหรือหลัง
    const colorById = {};
    document.querySelectorAll('.reward-wheel-1').forEach((row, i) => {
        colorById[row.dataset.id] = colors[i % colors.length];
    });

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text ?? '';
        return div.innerHTML;
    }

    // ===== คลาสแถบสุ่มแนวนอน (ตัวเดียวกับหน้าสุ่มรางวัล) =====
    class Reel {
        constructor(viewport, renderCard) {
            this.viewport = viewport;
            this.strip = viewport.querySelector('.reel-strip');
            this.renderCard = renderCard;
            this.items = [];
            this.offset = 0;
            this.winnerIndex = null;
        }

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

        spin(winner, pickFiller, durationMs) {
            // เก็บการ์ดที่กำลังโชว์อยู่ไว้เป็นจุดเริ่ม จะได้ไม่กระตุกตอนเริ่มหมุน
            const oldStep = this.step();
            const firstVisible = oldStep ? Math.floor(this.offset / oldStep) : 0;
            const visibleCount = oldStep ? Math.ceil(this.viewport.clientWidth / oldStep) + 1 : 0;
            const keep = this.items.slice(firstVisible, firstVisible + visibleCount);
            const startOffset = oldStep ? this.offset - firstVisible * oldStep : 0;

            const fillers = Array.from({ length: FILLER_COUNT }, pickFiller);
            const tail = Array.from({ length: 6 }, pickFiller);
            this.render([...keep, ...fillers, winner, ...tail]);
            this.winnerIndex = keep.length + fillers.length;

            this.moveTo(startOffset);
            void this.strip.offsetWidth;

            const step = this.step();
            const cardWidth = this.strip.children[this.winnerIndex].offsetWidth;
            const jitter = (Math.random() - 0.5) * cardWidth * 0.7;
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
                const fallback = setTimeout(finish, durationMs + 300);
                this.moveTo(target, durationMs);
            });
        }
    }

    function buildRewardCard(reward) {
        const card = document.createElement('div');
        card.className = 'reel-card reel-card--reward';
        card.style.setProperty('--card-color', colorById[reward.id] || colors[0]);

        const icon = document.createElement('div');
        icon.className = 'reel-card-icon';
        icon.innerHTML = ICON_GIFT;

        const label = document.createElement('p');
        label.className = 'reel-card-label';
        label.textContent = reward.name;

        card.append(icon, label);
        return card;
    }

    const previewReel = new Reel(document.getElementById('previewReel'), buildRewardCard);

    // ===== คำนวณโอกาสออก (น้ำหนัก = อัตรา x จำนวน เหมือนใน Controller ตอนสุ่มจริง) =====
    function weightOf(reward) {
        return reward.rate * reward.qty;
    }

    function pickWeighted(list) {
        const total = list.reduce((sum, r) => sum + weightOf(r), 0);
        let point = Math.random() * total;
        for (const reward of list) {
            point -= weightOf(reward);
            if (point <= 0) return reward;
        }
        return list[list.length - 1];
    }

    function renderChances(list) {
        if (list.length === 0) {
            chanceList.innerHTML = '<p class="spn-chance-empty">ยังไม่ได้เลือกรางวัล</p>';
            return;
        }

        const total = list.reduce((sum, r) => sum + weightOf(r), 0);
        chanceList.replaceChildren(...list.map(reward => {
            const percent = total > 0 ? (weightOf(reward) / total) * 100 : 0;

            const row = document.createElement('div');
            row.className = 'spn-chance-row';
            row.style.setProperty('--card-color', colorById[reward.id] || colors[0]);
            row.innerHTML = `
                <span class="spn-chance-dot"></span>
                <span class="spn-chance-name">${escapeHtml(reward.name)}<span class="spn-chance-qty">× ${reward.qty}</span></span>
                <span class="spn-chance-value">${percent.toFixed(1)}%</span>
                <div class="spn-chance-bar"><span style="width:${percent}%"></span></div>
            `;
            return row;
        }));
    }

    // ===== อัปเดตหน้าจอทุกครั้งที่เลือกหรือเปลี่ยนจำนวน =====
    let isSpinning = false;
    let previewDirty = false;

    // refreshReel = false ใช้ตอนแค่เปลี่ยนจำนวน การ์ดบนแถบไม่ต้องเปลี่ยน
    function updateUI(refreshReel = true) {
        const list = Array.from(selectedRe.values());
        selectedCount.textContent = list.length;
        savebtn.disabled = list.length < 2;   // บังคับให้เลือกขั้นต่ำ 2 รายการ
        clearAllbtn.disabled = list.length === 0;
        testSpinBtn.disabled = isSpinning || list.length < 2;
        renderChances(list);

        if (!refreshReel) return;
        if (isSpinning) {
            previewDirty = true; // กำลังทดลองหมุนอยู่ รอให้หยุดก่อนค่อยวาดใหม่
        } else {
            previewReel.showIdle(list, 'เลือกรางวัลจากคลังอย่างน้อย 2 รายการ');
        }
    }

    // ===== ปุ่มทดลองหมุน (สุ่มในเครื่องเท่านั้น ไม่บันทึกผล) =====
    testSpinBtn.addEventListener('click', async function () {
        const list = Array.from(selectedRe.values());
        if (isSpinning || list.length < 2) return;

        isSpinning = true;
        previewDirty = false;
        testSpinBtn.disabled = true;

        await previewReel.spin(pickWeighted(list), () => pickWeighted(list), TEST_SPIN_MS);

        isSpinning = false;
        if (previewDirty) {
            updateUI();
        } else {
            testSpinBtn.disabled = selectedRe.size < 2;
        }
    });

    // ===== แถวรางวัลในคลัง =====
    document.querySelectorAll('.reward-wheel-1').forEach(item => {
        const id = item.dataset.id;
        const name = item.dataset.name;
        const rate = parseFloat(item.dataset.rate) || 0;
        const checkbox = item.querySelector('.reward-check-box');
        const qtyInput = item.querySelector('.qnty-in');
        const minusBtn = item.querySelector('.qnty-minus');
        const plusBtn = item.querySelector('.qnty-plus');
        const min = parseInt(qtyInput.min) || 1;
        const max = parseInt(qtyInput.max) || 0;

        // รางวัลที่ในคลังหมดแล้ว เลือกใส่แถบไม่ได้
        if (max < min) {
            [checkbox, qtyInput, minusBtn, plusBtn].forEach(el => { el.disabled = true; });
            return;
        }

        // จำกัดจำนวนให้อยู่ระหว่าง min ถึง max เสมอ ทั้งตอนกดปุ่มและตอนพิมพ์เอง
        function setQty(value) {
            const qty = Math.min(max, Math.max(min, parseInt(value) || min));
            qtyInput.value = qty;
            if (selectedRe.has(id)) {
                selectedRe.get(id).qty = qty;
                updateUI(false);
            }
        }

        checkbox.addEventListener('change', function () {
            if (checkbox.checked) {
                selectedRe.set(id, { id, name, rate, qty: parseInt(qtyInput.value) || min });
            } else {
                selectedRe.delete(id);
            }
            updateUI();
        });

        minusBtn.addEventListener('click', () => setQty(parseInt(qtyInput.value) - 1));
        plusBtn.addEventListener('click', () => setQty(parseInt(qtyInput.value) + 1));
        qtyInput.addEventListener('change', () => setQty(qtyInput.value));
    });

    // ปุ่มล้างทั้งหมด
    clearAllbtn.addEventListener('click', function () {
        selectedRe.clear();
        document.querySelectorAll('.reward-check-box').forEach(cb => { cb.checked = false; });
        document.querySelectorAll('.qnty-in').forEach(input => { input.value = 1; });
        updateUI();
    });

    // ช่องค้นหา
    const searchin = document.querySelector('.search-spn-input');
    if (searchin) {
        searchin.addEventListener('input', function (e) {
            const keyword = e.target.value.toLowerCase().trim();
            document.querySelectorAll('.reward-wheel-1').forEach(row => {
                const rewardName = row.dataset.name ? row.dataset.name.toLowerCase() : '';
                row.classList.toggle('is-hidden', !rewardName.includes(keyword));
            });
        });
    }

    // ===== popup เลือกแบบประเมิน =====
    const assessmentModal = document.getElementById('assessmentModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const confirmAssessmentBtn = document.getElementById('confirmAssessmentBtn');
    const cancelAssessmentBtn = document.getElementById('cancelAssessmentBtn');
    const wheelItemCountn1 = document.getElementById('wheelItemCount');
    const wheelItemnamesn1 = document.getElementById('wheeItemnames');
    const assessmentListBodyn1 = document.getElementById('assessmentListBody');

    // ปุ่มบันทึก: เปิด popup พร้อมรายการแบบประเมินที่ยังไม่มีวงล้อ
    savebtn.addEventListener('click', async function () {
        const rewardsArray = Array.from(selectedRe.values());
        wheelItemCountn1.textContent = rewardsArray.length;
        wheelItemnamesn1.textContent = rewardsArray.map(r => r.name).join(', ');

        try {
            const res = await fetch(window.wheelConfig.availableAssessmentsUrl, {
                headers: { 'Accept': 'application/json' }
            });
            if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
            renderAssessmentList(await res.json());
        } catch (err) {
            alert('ไม่สามารถโหลดรายการแบบประเมินได้');
            console.error(err);
            return;
        }
        assessmentModal.style.display = 'flex';
    });

    function renderAssessmentList(assessments) {
        if (assessments.length === 0) {
            assessmentListBodyn1.innerHTML = '<p class="no-data">ไม่มีแบบประเมินที่สามารถผูกได้ในขณะนี้</p>';
            return;
        }

        assessmentListBodyn1.innerHTML = assessments.map(a => `
            <div class="assess-row">
                <div class="assess-row-info">
                    <input type="checkbox" class="assessment-checkbox" value="${escapeHtml(String(a.id))}">
                    <div>
                        <p class="assess-name">${escapeHtml(a.name)}</p>
                        <p class="assess-meta">สร้างโดย: ${escapeHtml(a.created_by ?? '-')} • เปิดรับถึง: ${escapeHtml(a.closed_at ?? '-')}</p>
                    </div>
                </div>
                <span class="assess-status">เปิดอยู่</span>
            </div>
        `).join('');
    }

    function closeAssessmentModal() {
        assessmentModal.style.display = 'none';
    }
    closeModalBtn.addEventListener('click', closeAssessmentModal);
    cancelAssessmentBtn.addEventListener('click', closeAssessmentModal);

    // ยืนยันบันทึกลงฐานข้อมูล
    confirmAssessmentBtn.addEventListener('click', async function () {
        const assessmentIds = Array.from(document.querySelectorAll('.assessment-checkbox:checked'))
            .map(cb => parseInt(cb.value));

        if (assessmentIds.length === 0) {
            alert('กรุณาเลือกอย่างน้อย 1 แบบประเมิน');
            return;
        }

        const items = Array.from(selectedRe.values()).map(r => ({
            reward_id: parseInt(r.id),
            quantity_selected: r.qty
        }));

        confirmAssessmentBtn.disabled = true; // กันกดซ้ำระหว่างรอ server
        try {
            const res = await fetch(window.wheelConfig.storeUrl, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ items: items, assessment_ids: assessmentIds })
            });

            if (!res.ok) {
                alert(`เกิดข้อผิดพลาดจาก Server (HTTP Status: ${res.status})`);
                return;
            }

            const data = await res.json();
            if (data.success) {
                alert('บันทึกวงล้อสำเร็จ');
                closeAssessmentModal();
                window.location.reload();
            } else {
                alert('เกิดข้อผิดพลาด: ' + (data.message || 'ไม่ทราบสาเหตุ'));
            }
        } catch (err) {
            alert('ไม่สามารถบันทึกวงล้อได้ กรุณาลองใหม่');
            console.error(err);
        } finally {
            confirmAssessmentBtn.disabled = false;
        }
    });

    // เริ่มต้น: ตั้งสถานะปุ่มและวาดแถบว่างตั้งแต่โหลดหน้า
    updateUI();
});