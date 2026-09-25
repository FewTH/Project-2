<?php

namespace Database\Factories;

use App\Models\Reward;
use App\Models\Assessment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Spinresult>
 */
class SpinresultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // สุ่มสถานะก่อน แล้วให้ received_at / checked_by_user_id ผูกตามสถานะนี้เสมอ
        // (กันไม่ให้เกิดข้อมูลขัดแย้งกันเอง เช่น received แต่ไม่มีคนยืนยัน)
        $status = fake()->randomElement(['received', 'not-received']);

        // ใช้ firstName + lastName แยกส่วน แทน ->name() เพราะ ->name()
        // บางครั้งสุ่มใส่คำนำหน้า (Mrs./Dr./Prof.) หรือเลขโรมันต่อท้าย (II, IV)
        // ซึ่งดูไม่เป็นธรรมชาติสำหรับชื่อคนไทย
        $firstName = fake('th_TH')->firstName();
        $lastName = fake('th_TH')->lastName();

        return [
            // ดึง reward_id ที่มีอยู่จริงมาสุ่ม (ห้ามมั่วเลขเอง เพราะ id ไม่เรียงต่อกัน)
            'reward_id' => Reward::inRandomOrder()->value('reward_id'),

            // ดึง assessment_id ที่มีอยู่จริงมาสุ่ม (ตอนนี้มี 1, 2, 3)
            'assessment_id' => Assessment::inRandomOrder()->value('assessment_id'),

            // generate qr_code ปลอม รูปแบบเดียวกับที่ตกลงกันไว้ ไม่ซ้ำ
            'qr_code' => 'AB-2026-' . strtoupper(Str::random(6)),

            'winner_name' => $firstName . ' ' . $lastName,

            // email ปลอม: ใช้ username ภาษาอังกฤษแยกต่างหาก
            // (Str::slug() ไม่รองรับภาษาไทย จะตัดตัวอักษรไทยทิ้งหมด
            //  ทำให้ได้ email ที่มีแต่ตัวเลขล้วนๆ ถ้าเอาชื่อไทยไป slug ตรงๆ)
            'winner_email' => fake()->unique()->userName() . '@example.com',

            'receive_status' => $status,

            'receive_deadline' => fake()->dateTimeBetween('now', '+7 days'),

            // มีค่าก็ต่อเมื่อสถานะเป็น received เท่านั้น
            'received_at' => $status === 'received'
                ? fake()->dateTimeBetween('-3 days', 'now')
                : null,

            // admin ที่กดยืนยัน มีค่าก็ต่อเมื่อ received เท่านั้น
            'checked_by_user_id' => $status === 'received'
                ? User::inRandomOrder()->value('user_id')
                : null,
        ];
    }
}