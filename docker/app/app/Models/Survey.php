<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
 
    use HasFactory;
    protected $table = 'surveys';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'wheel_id',
        'title',
        'external_id',
        'status',
        'closed_at',
        'received_at',
    ];
}
