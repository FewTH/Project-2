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
    ];

    protected $hidden = [
        'password_hash',
    ];

    protected function casts(): array
    {
        return [
            'password_hash' => 'hashed',
            'password_changed_at' => 'datetime',
        ];
    }

    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}
