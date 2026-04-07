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
        if (!Schema::hasColumn('program_kegiatans', 'target_laporan')) {
            Schema::table('program_kegiatans', function (Blueprint $table) {
                $table->integer('target_laporan')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('program_kegiatans', 'target_laporan')) {
            Schema::table('program_kegiatans', function (Blueprint $table) {
                $table->dropColumn('target_laporan');
            });
        }
    }
};
