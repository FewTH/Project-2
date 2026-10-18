<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRewardDraw extends Model
{
    protected $fillable = ['event_id', 'reward_id', 'drawn_at', 'drawn_by'];

    protected $casts = ['drawn_at' => 'datetime'];
}