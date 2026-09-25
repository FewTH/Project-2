<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spinresult extends Model
{
    use HasFactory;
    protected $table = 'spin_results';
    protected $primaryKey = 'result_id';
    protected $fillable = [
        'reward_id',
        'qr_code',
        'winner_name',
        'receive_status',
        'receive_deadline',
        'received_at',
        'assessment_id',
        'checked_by_user_id',
        ];

    protected $casts = [
        'received_at' => 'datetime',
        'receive_deadline' => 'datetime',
    ];

    public function reward()
    {
        return $this->belongsTo(Reward::class, 'reward_id', 'reward_id');
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'assessment_id');
    }

    // user ที่กดยืนยันรับของ
    public function checkedbyuserid()
    {
        return $this->belongsTo(User::class, 'checked_by_user_id', 'user_id');
    }



}
