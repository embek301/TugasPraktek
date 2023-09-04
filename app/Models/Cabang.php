<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = 'cabs';
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
