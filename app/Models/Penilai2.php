<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilai2 extends Model
{
    protected $table = 'penilai2s';
    use HasFactory;
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
