<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes; // Tambahkan SoftDeletes

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes; // Gunakan SoftDeletes

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
        'role',
        'last_login_at',
        'last_login_ip',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_login_at' => 'datetime',
    ];

    /**
     * Get the last login time in a human readable format
     */
    public function getLastLoginFormatted()
    {
        if (!$this->last_login_at) {
            return 'Belum pernah login';
        }
        
        return $this->last_login_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') . ' WIB';
    }

    /**
     * Get the last login time relative to now
     */
    public function getLastLoginRelative()
    {
        if (!$this->last_login_at) {
            return 'Belum pernah login';
        }
        
        return $this->last_login_at->setTimezone('Asia/Jakarta')->diffForHumans();
    }
}
