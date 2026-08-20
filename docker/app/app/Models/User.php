<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
 
    use HasFactory, Notifiable;
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'username',
        'full_name',
        'email',
        'password_hash',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password_hash',
    ];

    protected function casts(): array
    {
        return [
            'password_hash' => 'hashed',
        ];
    }
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}
