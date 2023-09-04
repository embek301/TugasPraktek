<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dept extends Model
{
    protected $table = 'depts';
    use HasFactory;
    public function users()
    {
        return $this->hasMany(User::class);
    }
}