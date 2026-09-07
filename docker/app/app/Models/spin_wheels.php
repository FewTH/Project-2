<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class spin_wheels extends Model
{
    protected $table = 'spin_wheels';
    protected $primaryKey = 'wheel_id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'is_active',
        'created_by',
    ];

    public function rewards()
    {
        return $this->belongsToMany(Reward::class, 'wheel_items', 'wheel_id', 'reward_id')
                    ->withPivot('quantity_selected');
    }

    public function event()
    {
        return $this->hasOne(Event::class, 'wheel_id', 'wheel_id');
    }
}