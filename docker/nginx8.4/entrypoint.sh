#!/bin/sh
set -e

# --- ส่วนแก้ไข Permission (เหมือนเดิม) ---
echo "Fixing storage & bootstrap/cache permissions..."
chown -R application:application /app/storage /app/bootstrap/cache

find /app/storage -type d -exec chmod 775 {} \;
find /app/storage -type f -exec chmod 664 {} \;
find /app/bootstrap/cache -type d -exec chmod 775 {} \;
find /app/bootstrap/cache -type f -exec chmod 664 {} \;
echo "Permissions fixed."
# ------------------------------------


# --- ส่วนที่เพิ่มเข้ามาเพื่อแก้ปัญหา ---
# ตรวจสอบว่ามีคำสั่ง (arguments) ถูกส่งมาหรือไม่
# "$#" คือจำนวนของ arguments ที่ได้รับ
if [ "$#" -eq 0 ]; then
    # ถ้าไม่มี ให้กำหนดค่าเริ่มต้นเป็น "supervisord"
    echo "No command specified, defaulting to supervisord..."
    set -- supervisord
fi
# ------------------------------------


# รัน entrypoint ดั้งเดิมของ image พร้อมกับส่งต่อ arguments ทั้งหมด
exec /opt/docker/bin/entrypoint.sh "$@"
