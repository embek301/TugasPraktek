<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terlambat extends Model
{
    use HasFactory;
   protected $table = 'izin-terlambat';
    protected $primaryKey = 'id_terlambat';
    protected $keyType = 'string';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
// Define any relationships or custom methods here as needed
}