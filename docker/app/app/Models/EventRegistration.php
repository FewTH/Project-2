<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $table = 'event_registrations';
    protected $primaryKey = 'registration_id';
    public $timestamps = false;

    protected $fillable = [
        'event_id',
        'user_id',
        'full_name',
        'registered_at',
        'is_drawn',
        'drawn_at',
        'reward_id',
    ];

    protected $casts = [
        'registered_at' => 'datetime',
        'drawn_at' => 'datetime',
        'is_drawn' => 'boolean',
    ];
    
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function reward()
    {
        return $this->belongsTo(Reward::class, 'reward_id', 'reward_id');
    }
}

