<?php
namespace App\Http\Controllers\Concerns;

use App\Models\Reward;
use Illuminate\Validation\ValidationException;

trait ManagesRewardStock
{
    protected function adjustRewardStock(array $changes): void
    {
        // แปลงเป็นตัวเลข และตัดรายการที่ไม่เปลี่ยน (0) ออก
        $changes = array_filter(array_map('intval', $changes));
        if (empty($changes)) {
            return;
        }

        // ล็อกแถวของรางวัลไว้จนจบ transaction กันแอดมินสองคนกดบันทึกพร้อมกันจนของติดลบ
        $rewards = Reward::whereIn('reward_id', array_keys($changes))
            ->lockForUpdate()
            ->get()
            ->keyBy('reward_id');

        // ตรวจให้ครบทุกรายการก่อน ถ้ามีรายการไหนไม่พอ จะหยุดทั้งหมด
        foreach ($changes as $rewardId => $qty) {
            if ($qty < 0) {
                continue; // เป็นการคืนของ ไม่ต้องตรวจ
            }

            $reward = $rewards->get($rewardId);

            if (!$reward) {
                throw ValidationException::withMessages([
                    "rewards.{$rewardId}.qty" => 'ไม่พบของรางวัลที่เลือก กรุณาเลือกใหม่อีกครั้ง',
                ]);
            }

            if ($qty > $reward->quantity_reward) {
                throw ValidationException::withMessages([
                    "rewards.{$rewardId}.qty" => "จำนวนของรางวัล \"{$reward->name}\" เกินจำนวนของรางวัลที่มี",
                ]);
            }
        }

        // ผ่านการตรวจแล้ว ค่อยหักหรือคืนจริง
        foreach ($changes as $rewardId => $qty) {
            $reward = $rewards->get($rewardId);
            if (!$reward) {
                continue; // ของรางวัลถูกลบไปแล้ว ไม่ต้องคืน
            }

            if ($qty > 0) {
                $reward->decrement('quantity_reward', $qty);
            } else {
                $reward->increment('quantity_reward', -$qty);
            }
        }
    }
}