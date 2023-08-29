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
            $table->string('gol');
            $table->string('grade');
            $table->string('tanggal_masuk');
            $table->string('jabatan');
            $table->string('email')->unique();
            $table->string('aktif');
            $table->string('status');
            $table->string('tgl_kontrak');
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