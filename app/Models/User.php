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

    public function haks()
    {
        return $this->belongsTo(Hak::class, 'hak', 'id');
    }

    public function cabs()
    {
        return $this->belongsTo(Cabang::class, 'cab', 'id');
    }

    public function jabatans()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan', 'id');
    }
    public function penilai2s()
    {
        return $this->belongsTo(Penilai2::class, 'penilai2', 'id');
    }
    public function penilai3s()
    {
        return $this->belongsTo(Penilai3::class, 'penilai3', 'id');
    }
    public function penilai4s()
    {
        return $this->belongsTo(Penilai4::class, 'penilai4', 'id');
    }
    public function depts()
    {
        return $this->belongsTo(Dept::class, 'dept', 'id');
    }
    public function gols()
    {
        return $this->belongsTo(Dept::class, 'gol', 'id');
    }
}