<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('who');
            $table->string('username');
            $table->string('password');
            $table->foreignId('penilai2')->constrained();
            $table->foreignId('penilai3')->constrained();
            $table->foreignId('penilai4')->constrained();
            $table->foreignId('dept')->constrained();
            $table->foreignId('cab')->constrained();
            $table->foreignId('hak')->constrained();
            $table->foreignId('golongan')->constrained();
            $table->string('grade')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->foreignId('jabatan')->constrained();
            $table->string('email')->unique();
            $table->string('aktif');
            $table->string('status')->nullable();
            $table->date('tgl_kontrak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
