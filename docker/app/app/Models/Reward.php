<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $table = 'reward';
    protected $primaryKey = 'reward_id';
    public $timestamps = false;
    
    protected $fillable = [
        'name', 
        'quantity_reward', 
        'category_id', 
        'rate', 
        'created_by',
        ];

    public function category()
    {
        return $this->belongsTo(RewardCategory::class, 'category_id', 'category_id');
    }
}
