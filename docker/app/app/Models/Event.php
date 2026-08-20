<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $primaryKey = 'event_id';
    protected $fillable = [
        'wheel_id',
        'title',
        'register_close_at',
        'max_participants',
        'register_fields',
        'qr_code_url',
        'status',
        'created_by',
        'created_at',
        ];
}
