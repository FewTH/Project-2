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
        'receive_location',
        'received_at',
        'assessment_id',
        ];

    public function reward()
    {
        return $this->belongsTo(Reward::class, 'reward_id', 'reward_id');
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'assessment_id');
    }
}
