<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    protected $table = 'golongans';
    use HasFactory;
    public function users()
    {
        return $this->hasMany(User::class);
    }
}