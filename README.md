# iHaveGPU — Mini E-commerce for PC Parts (Laravel + Breeze + Sail)

ระบบเว็บแอปขายอุปกรณ์คอมพิวเตอร์ (CPU/GPU/อุปกรณ์อื่น ๆ) สำหรับเดสก์ท็อป/โน้ตบุ๊ก
รองรับบทบาท **Admin / Staff / Customer**, ตะกร้าสินค้า, การสั่งซื้อ, **ชุดสินค้า (Computer Set)** และบทความข่าวสาร

---

## ✨ Features

-   **สินค้า, แบรนด์, หมวดหมู่, สต็อก** (`products`, `brands`, `categories`, `stocks`)
-   **ชุดสินค้า (Computer Sets)** + คำนวณราคารวมของชุด
-   **ตะกร้า + Checkout →** สร้าง `orders` / `order_items`
-   **บทความ/ข่าว (Articles)**
-   **บทบาทผู้ใช้**
    -   **Admin**: จัดการได้ทุกอย่าง (รวม Users/Brands/Contacts, ลบ Order)
    -   **Staff**: จัดการสินค้า/หมวดหมู่/บทความ/ชุดสินค้า/ดูและแก้สถานะ Order _(ลบ Order ไม่ได้)_
    -   **Customer**: ซื้อสินค้า, ดูคำสั่งซื้อของตนเอง
-   หน้า **Public**: Home, Devices (products), Computer set, Articles, Categories
-   หน้า **Auth**: Login/Register (UI ปรับธีม), โปรไฟล์
-   **Image storage** ผ่าน `public` disk (ใช้ `storage:link`)

---

## 🛠 Tech Stack

-   **Laravel 12** + **PHP 8.4** (พัฒนา/รันผ่าน **Laravel Sail** + Docker)
-   **Breeze** (Blade + TailwindCSS)
-   **MySQL/MariaDB**
-   **Policies/Middleware** สำหรับ Role-based access

---

## 🚀 Quick Start (Laravel Sail)

1.  ติดตั้ง dependencies

```bash
composer install
```

2.  คัดลอก env และตั้งค่า DB

```bash
cp .env.example .env
php artisan key:generate
```

3.  ถ้าใช้ Sail (Docker)

```bash
./vendor/bin/sail up -d
```

4.  เตรียม Storage symlink

```bash
./vendor/bin/sail artisan storage:link
```

5.  migrate + seed (ข้อมูลตัวอย่าง)

```bash
./vendor/bin/sail artisan migrate --seed
```

หากต้องการล้างฐานทั้งหมดและ seed ใหม่:

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

ตัวอย่าง seeders ที่ใช้บ่อย:

-   `Database\\Seeders\\DemoSeeder` — สร้างตัวอย่าง Users/Categories/Brands/Products/Articles
-   `Database\\Seeders\\AddCPUSeeder` — เพิ่มชุดสินค้าตัวอย่าง

รัน seeder เฉพาะคลาส:

```bash
./vendor/bin/sail artisan db:seed --class=Database\\\\Seeders\\\\AddCPUSeeder
```

บัญชีตัวอย่างจาก `DemoSeeder`:

-   Admin: `admin@example.com` / `password`
-   Staff: `staff@example.com` / `password`
-   Customer: `customer@example.com` / `password`

หมายเหตุ: หากเจอ error "Field 'password' doesn't have a default value" ให้แน่ใจว่าโค้ดทุกจุดที่สร้างผู้ใช้ส่งค่า `password` เสมอ หรือมี mutator ใน `User::setPasswordAttribute` เพื่อแฮช/เซ็ตค่าเริ่มต้น

### 📦 Build Frontend

หากมีการแก้ Tailwind/JS ให้รัน Vite ด้วย Sail:

```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev   # development
./vendor/bin/sail npm run build # production
```

### 🔐 Roles & Access

Middleware: `RoleMiddleware` — ตัวอย่างการใช้งาน: `role:admin`, `role:staff,admin`, `role:customer`

เส้นทางจัดการหลังบ้านอยู่ภายใต้ prefix `/manage`:

-   Staff + Admin: products, categories, articles, sets, orders (index/show/update)
-   Admin only: users, brands, contacts, orders:destroy

ปุ่ม “ลบออเดอร์” จะไม่แสดงต่อ Staff และหากผู้ใช้ Staff ยิงคำขอลบโดยตรงจะถูกปฏิเสธพร้อม flash message ว่า "ไม่มีสิทธิ์"

### 🗂 โครงสร้างข้อมูลหลัก

-   `products` (สัมพันธ์กับ brand, category, stock, และ attributes)
-   `stocks` (จำนวนคงเหลือต่อสินค้า)
-   `order_items` (qty, unit_price, subtotal)
-   `computer_sets` + pivot `computer_set_product` (qty ต่อ item)

### 🖼 รูปภาพ

อัปโหลด/แสดงผ่าน `Storage::disk('public')` — วางรูปเริ่มต้น/โลโก้ใน `public/images/` และรัน `storage:link` เพื่อให้ `storage/app/public` เข้าถึงได้จาก `/storage/`

### ✅ การทดสอบอย่างง่าย

เคลียร์แคชต่าง ๆ เมื่อเปลี่ยนโค้ด/เส้นทาง:

```bash
./vendor/bin/sail artisan optimize:clear
```

### 🧩 Troubleshooting

-   password ไม่มีค่า

    -   ตรวจ `RegisteredUserController@store` ว่าบันทึก password ที่ผ่าน `Hash::make(...)` แล้ว
    -   ใน `User` อาจมี mutator ตัวอย่าง:

    ```php
    public function setPasswordAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['password'] = null;
            return;
        }

        if (is_string($value) && strlen($value) === 60 && str_starts_with($value, '$2y$')) {
            $this->attributes['password'] = $value;
        } else {
            $this->attributes['password'] = bcrypt($value);
        }
    }
    ```

-   รูปไม่ขึ้น

    -   ตรวจว่าเรียก `Storage::disk('public')->url($path)` และรัน `storage:link`

-   Staff ลบออเดอร์ไม่ได้

    -   เป็นดีไซน์ความปลอดภัย: ปุ่มลบจะไม่แสดงต่อ Staff และหากยิงคำขอลบโดยตรงจะถูก redirect กลับพร้อม flash "ไม่มีสิทธิ์"

---

## License

MIT

# iHaveGPU — Mini E-commerce for PC Parts (Laravel + Breeze + Sail)

ระบบเว็บแอปขายอุปกรณ์คอมพิวเตอร์ (CPU/GPU/อุปกรณ์อื่น ๆ) สำหรับเดสก์ท็อป/โน้ตบุ๊ก  
รองรับบทบาท **Admin / Staff / Customer**, ตะกร้าสินค้า, การสั่งซื้อ, **ชุดสินค้า (Computer Set)** และบทความข่าวสาร

---

## ✨ Features

-   **สินค้า, แบรนด์, หมวดหมู่, สต็อก** (`products`, `brands`, `categories`, `stocks`)
-   **ชุดสินค้า (Computer Sets)** + คำนวณราคารวมของชุด
-   **ตะกร้า + Checkout →** สร้าง `orders` / `order_items`
-   **บทความ/ข่าว (Articles)**
-   **บทบาทผู้ใช้**
    -   **Admin**: จัดการได้ทุกอย่าง (รวม Users/Brands/Contacts, ลบ Order)
    -   **Staff**: จัดการสินค้า/หมวดหมู่/บทความ/ชุดสินค้า/ดูและแก้สถานะ Order _(ลบ Order ไม่ได้)_
    -   **Customer**: ซื้อสินค้า, ดูคำสั่งซื้อของตนเอง
-   หน้า **Public**: Home, Devices (products), Computer set, Articles, Categories
-   หน้า **Auth**: Login/Register (UI ปรับธีม), โปรไฟล์
-   **Image storage** ผ่าน `public` disk (ใช้ `storage:link`)

---

## 🛠 Tech Stack

-   **Laravel 12** + **PHP 8.4** (พัฒนา/รันผ่าน **Laravel Sail** + Docker)
-   **Breeze** (Blade + TailwindCSS)
-   **MySQL/MariaDB**
-   **Policies/Middleware** สำหรับ Role-based access

---

## 🚀 Quick Start (Laravel Sail)

```bash
# 1) ติดตั้ง dependencies
composer install

# 2) คัดลอก env และตั้งค่า DB
cp .env.example .env
php artisan key:generate

# ถ้าใช้ Sail
./vendor/bin/sail up -d

# 3) เตรียม Storage symlink
./vendor/bin/sail artisan storage:link

# 4) migrate + seed (ข้อมูลตัวอย่าง)
./vendor/bin/sail artisan migrate --seed
ต้องการล้างฐานทั้งหมด:

bash
Copy code
./vendor/bin/sail artisan migrate:fresh --seed
🌱 Seeders ที่ใช้บ่อย
Database\Seeders\DemoSeeder — สร้างตัวอย่าง Users/Categories/Brands/Products/Articles

Database\Seeders\AddCPUSeeder — เพิ่มสินค้าชุด CPU/GPU ทีละ 5 ชิ้น (เช่น Ryzen/Core Ultra & RX 6500 XT)

รันแบบระบุคลาส:

bash
Copy code
./vendor/bin/sail artisan db:seed --class=Database\\Seeders\\AddCPUSeeder
👤 บัญชีตัวอย่าง (จาก DemoSeeder)
Admin: admin@example.com / password

Staff: staff@example.com / password

Customer: customer@example.com / password

หากเจอ error Field 'password' doesn't have a default value ให้แน่ใจว่า
ส่งค่า password เสมอ และ/หรือมี mutator แฮชรหัสผ่านใน User::setPasswordAttribute.

📦 Build Frontend
หากมีการแก้ Tailwind/JS ให้รัน Vite:

bash
Copy code
# Dev
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev

# Prod
./vendor/bin/sail npm run build
🔐 Roles & Access
Middleware: RoleMiddleware:admin, :staff,admin, :customer

เส้นทางจัดการหลังบ้านอยู่ภายใต้ prefix /manage

Staff + Admin: products, categories, articles, sets, orders (index/show/update)

Admin only: users, brands, contacts, orders:destroy

ปุ่ม “ลบออเดอร์” จะ ไม่แสดง ต่อ Staff และหากเรียกโดยตรงจะถูกปฏิเสธพร้อมข้อความเตือน

🗂 โครงสร้างข้อมูลหลัก
products (สัมพันธ์ brand, category, stock, และ attributes() ถ้ามี)

stocks (จำนวนคงเหลือต่อสินค้า)

order_items (qty, unit_price, subtotal)

computer_sets + pivot computer_set_product (qty ต่อ item)

🖼 รูปภาพ
อัปโหลด/แสดงผ่าน Storage::disk('public')

วางรูปเริ่มต้น/โลโก้ใน public/images/...

รัน storage:link เพื่อให้ storage/app/public เข้าได้จาก /storage/...

✅ การทดสอบอย่างง่าย
bash
Copy code
# เคลียร์แคชต่าง ๆ เมื่อเปลี่ยนโค้ด/เส้นทาง
./vendor/bin/sail artisan optimize:clear
🧩 Troubleshooting
password ไม่มีค่า
ตรวจ RegisteredUserController@store ว่าบันทึก password ที่ผ่าน Hash::make(...) แล้ว
และใน User อาจมี mutator:

php
Copy code
public function setPasswordAttribute($value) {
    if ($value && strlen($value) < 60) {
        $this->attributes['password'] = bcrypt($value);
    }
}
รูปไม่ขึ้น
ตรวจว่าเรียก Storage::disk('public')->url($path) และทำ symlink แล้ว (storage:link)

Staff ลบออเดอร์ไม่ได้
เป็นดีไซน์ความปลอดภัย: ปุ่มลบจะไม่แสดง และหากยิงตรงให้ redirect กลับพร้อม flash “ไม่มีสิทธิ์”

📄 License
MIT
```
