<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WheelItem extends Model
{
    protected $table = 'wheel_items';
    protected $primarykey = 'item_id';
    protected $fillable = ['wheel_id','reward_id','quantity_selected'];

    public function wheel(){
        return $this->belongsTo(spin_wheels::class,'wheel_id','wheel_id');
    }

    public function reward(){
        return $this->belongsTo(Reward::class,'reward_id','reward_id');
    }
}
