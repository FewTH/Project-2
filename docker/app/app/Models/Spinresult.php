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
        'gift_id',
        'qr_code',
        'winner_name',
        'receive_status',
        'receive_deadline',
        'receive_location',
        'received_at',
        'created_at',
        'session_id',
        ];
}
