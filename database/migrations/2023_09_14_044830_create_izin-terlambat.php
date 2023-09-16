<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('izin-terlambat', function (Blueprint $table) {
            $table->string('id_terlambat', 11)->unique();
            $table->string('nik', 20);
            $table->string('nama', 100);
            $table->date('tanggal');
            $table->time('jam');
            $table->string('approval1')->nullable();
            $table->string('approval2')->nullable();
            $table->date('tgl_app1')->nullable();
            $table->date('tgl_app2')->nullable();
            $table->text('alasan')->nullable();
            $table->date('tgl_app3')->nullable();
            $table->date('tgl_app4')->nullable();
            $table->string('jenis', 50)->nullable();
            $table->string('last', 100)->nullable();
            $table->date('tgl_awal')->nullable();
            $table->date('tgl_akhir')->nullable();
            $table->string('hari', 20)->nullable();
            $table->string('kategori', 50)->nullable();
            $table->string('pengganti', 100)->nullable();
            $table->text('alasan1')->nullable();
            $table->text('alasan2')->nullable();
            $table->binary('file')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE `izin-terlambat` AUTO_INCREMENT = 1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izin-terlambat');
    }
};