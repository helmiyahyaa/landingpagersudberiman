<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // Bisa juga implement MustVerifyEmail jika perlu verifikasi email
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'level', // Ditambahkan agar sesuai dengan migrasi
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array // Menggunakan method casts() yang lebih modern
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Ini sudah cukup untuk hashing otomatis
        ];
    }

    /**
     * Get the user's full name. (Accessor)
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        // Pengecekan bisa disederhanakan
        return trim("{$this->name} {$this->username}");
    }

}