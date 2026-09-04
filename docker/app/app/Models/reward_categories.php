<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardCategory extends Model
{
    protected $primaryKey = 'category_id';
    public $timestamps = false;
    protected $fillable = ['name'];
    
    public function rewards()
    {
        return $this->hasMany(Reward::class, 'category_id', 'category_id');
    }
}
