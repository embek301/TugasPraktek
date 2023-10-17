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
            $table->string('penilai2')->nullable();
            $table->string('penilai3')->nullable();
            $table->string('penilai4')->nullable();
            $table->string('dept')->nullable();
            $table->string('cab')->nullable();
            $table->string('hak')->nullable();
            $table->string('golongan')->nullable();
            $table->string('grade')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->string('jabatan')->nullable();
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
