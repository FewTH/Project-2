**สรุปวิธีการใช้งาน (ภาษาไทย) — ขั้นตอนตั้งแต่ต้นจนเว็บพร้อมใช้งาน**


ภาพรวมสั้น ๆ:
- สร้าง Image ของ PHP-FPM (มี Composer และส่วนขยายที่จำเป็น)
- สตาร์ทบริการด้วย `docker compose` (Nginx, PHP-FPM, MySQL, phpMyAdmin)
- ติดตั้ง dependency (Composer, npm) และรัน migration/seed

ข้อกำหนดเบื้องต้น:
- ติดตั้ง Docker และ Docker Compose (v2+)
- ทำงานจาก root ของ repository (ไฟล์ compose อยู่ที่ `docker/docker-compose.yml`)

คำสั่งสำคัญ (รันจาก root ของโปรเจ็ค)

- 1) สร้างและสตาร์ท services (rebuild image ถ้าจำเป็น):
```
docker compose -f docker/docker-compose.yml -p assessproject up -d --build
```

- 2) ตรวจสอบว่า MySQL พร้อมรับการเชื่อมต่อ:
```
docker compose -f docker/docker-compose.yml -p assessproject logs -f assess-db
```

- 3) ติดตั้ง PHP dependencies (Composer):
```
docker compose -f docker/docker-compose.yml -p assessproject run --rm assess-app composer install --no-interaction --prefer-dist --optimize-autoloader
```
หรือ (ถ้า container รันอยู่แล้ว):
```
docker compose -f docker/docker-compose.yml -p assessproject exec -T assess-app composer install
```

- 4) ติดตั้งและ build frontend
	- ถ้า `node`/`npm` ติดตั้งใน `assess-app` image ให้ใช้ `exec`:
	```
	docker compose -f docker/docker-compose.yml -p assessproject exec -T assess-app npm install
	docker compose -f docker/docker-compose.yml -p assessproject exec -T assess-app npm run build
	```
	- ถ้า `node` ไม่อยู่ใน image ให้ใช้ official Node image (ตัวอย่างใช้ `node:20`):
	```
	docker run --rm -v "$(pwd)/docker/app:/app" -w /app node:20 sh -c "npm install --no-audit --no-fund && npm run build"
	```

- 5) สร้าง `APP_KEY` และรัน migrations/seed:
```
docker compose -f docker/docker-compose.yml -p assessproject run --rm assess-app sh -c "cp .env.example .env || true && php artisan key:generate"
docker compose -f docker/docker-compose.yml -p assessproject run --rm assess-app php artisan migrate --seed --force
```

- 6) ตรวจสอบเว็บจากเครื่องโฮสต์:
```
curl -I http://127.0.0.1:8320/
```

ปัญหาที่อาจเจอและวิธีแก้ (สั้น ๆ)
- Build ล้มเพราะ `libzip`/`gd`: เพิ่มแพ็กเกจระบบก่อนคอมไพล์ เช่น `pkg-config`, `zlib1g-dev`, `libzip-dev`, `libpng-dev`, `libjpeg-dev`, `libfreetype6-dev` ใน `Dockerfile` แล้วรัน `docker compose build` ใหม่
- เว็บ 404: ตรวจสอบว่า `./docker/app` (relative path ใน `docker/docker-compose.yml`) มีไฟล์โปรเจ็คจริง และมี `public/index.php`
- `npm`/`node` ไม่อยู่ใน image: ใช้ official `node` image เพื่อ build frontend
- หาก seed เกิดข้อผิดพลาด (เช่น duplicate entries) ให้ใช้:
```
docker compose -f docker/docker-compose.yml -p assessproject run --rm assess-app php artisan migrate:fresh --seed --force
```

คำแนะนำเมื่อแก้ `Dockerfile`
- ถ้าคุณเปลี่ยน `Dockerfile` ให้รีบิลด์ image ด้วย:
```
docker compose -f docker/docker-compose.yml -p assessproject build --no-cache
docker compose -f docker/docker-compose.yml -p assessproject up -d
```

หมายเหตุสำคัญ
- Compose ใน repo ถูกตั้งให้แมป `./app:/var/www/html` (relative to `docker/` directory). ถ้า `docker/app` ไม่มีไฟล์โปรเจ็คจริง เว็บจะ 404 — ให้คัดลอกหรือย้ายโปรเจ็คไปยัง `docker/app` หรือแก้ compose ให้แมปไปยังพาธจริง (แต่อย่าลืมว่าการแก้ compose ควรทำโดยระมัดระวัง)
- คำสั่งตัวอย่างทั้งหมดใช้ `-p assessproject` เพื่อแยก resources ของ compose project นี้จากโปรเจ็คอื่น ๆ บนเครื่อง

ถ้าต้องการ ผมช่วยสร้างสคริปต์อัตโนมัติ (เช่น `docker/up.sh`, `docker/install-deps.sh`) ให้เรียกคำสั่งข้างต้นเป็นขั้นตอนเดียวได้

ถ้าต้องการให้ผมใส่ README ฉบับภาษาอังกฤษด้วย แจ้งได้เลย
