<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function hak()
    {
        return $this->belongsTo(Hak::class, 'id', 'hak');
    }

    public function cabang()
    {
        return $this->hasOne(Cabang::class, 'no', 'cab');
    }

    public function jabatan()
    {
        return $this->hasOne(Jabatan::class, 'no', 'jabatan');
    }
    public function penilai2()
    {
        return $this->hasOne(Penilai2::class, 'no', 'penilai2');
    }
    public function penilai3()
    {
        return $this->hasOne(Penilai3::class, 'no', 'penilai3');
    }
    public function penilai4()
    {
        return $this->hasOne(Penilai4::class, 'no', 'penilai4');
    }
    public function dept()
    {
        return $this->hasOne(Dept::class, 'no', 'dept');
    }
}
