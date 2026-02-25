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
        Schema::create('program_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->string('jenis_kegiatan');
            $table->date('tanggal_kegiatan');
            $table->string('status')->default('Proses');
            $table->text('deskripsi')->nullable();
            $table->foreignId('bidang_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_kegiatans');
    }
};
