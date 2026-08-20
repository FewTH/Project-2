<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $primaryKey = 'reward_id';
    public $timestamps = false;
    protected $fillable = ['name', 'quantity', 'category_id', 'rate'];

    public function category()
    {
        return $this->belongsTo(RewardCategory::class, 'category_id', 'category_id');
    }
}
