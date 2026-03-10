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
        Schema::table('program_kegiatans', function (Blueprint $table) {
            if (!Schema::hasColumn('program_kegiatans', 'status')) {
                $table->string('status')->default('proses');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('program_kegiatans', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
