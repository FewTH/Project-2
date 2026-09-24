<?php

namespace Database\Factories;

use App\Models\Reward;
use App\Models\Assessment;
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
        return [
            // ดึง reward_id ที่มีอยู่จริงมาสุ่ม (ห้ามมั่วเลขเอง เพราะ id ไม่เรียงต่อกัน)
            'reward_id' => Reward::inRandomOrder()->value('reward_id'),

            // ดึง assessment_id ที่มีอยู่จริงมาสุ่ม (ตอนนี้มี 1, 2, 3)
            'assessment_id' => Assessment::inRandomOrder()->value('assessment_id'),

            // generate qr_code ปลอม รูปแบบเดียวกับที่ตกลงกันไว้ ไม่ซ้ำ
            'qr_code' => 'AB-2026-' . strtoupper(Str::random(6)),

            'winner_name' => fake('th_TH')->name(),

            // สุ่มสถานะ 3 แบบ ให้น้ำหนักใกล้เคียงของจริง (ส่วนใหญ่ pending)
            'receive_status' => fake()->randomElement([
                'pending', 'pending', 'pending',
                'received', 'received',
                'expired',
            ]),

            'receive_deadline' => fake()->dateTimeBetween('now', '+7 days'),
            'receive_location' => 'จุดรับของ อาคาร 1 ชั้น 1',

            // received_at จะมีค่าก็ต่อเมื่อสถานะเป็น received เท่านั้น (ตั้งใน state ด้านล่าง)
            'received_at' => null,
        ];
    }

    /**
     * สถานะ "รับแล้ว" - ให้ received_at มีค่าจริง
     */
    public function received(): static
    {
        return $this->state(fn (array $attributes) => [
            'receive_status' => 'received',
            'received_at' => fake()->dateTimeBetween('-3 days', 'now'),
        ]);
    }
}