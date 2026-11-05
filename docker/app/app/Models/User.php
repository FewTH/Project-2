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
        'phone',
        'password_hash',
        'profile_image',
        'role',
        'is_active',
        'password_changed_at',
        'auth_source',
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'password_hash' => 'hashed',
            'password_changed_at' => 'datetime',
        ];
    }

    public function isApiUser(): bool
    {
        return $this->auth_source === 'api';
    }

    public function getAuthPassword()
    {
        return $this->password_hash;
    }
    
    // กันไม่ให้เขียนคอลัม password ที่ไม่มีอยู่ถ้ามีการ rehash
    public function getAuthPasswordName()
    {
        return 'password_hash';
    }
}
