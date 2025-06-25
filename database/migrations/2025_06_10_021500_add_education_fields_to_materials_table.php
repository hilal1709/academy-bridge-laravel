<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */    public function up(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->string('fakultas')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('semester')->nullable();
            $table->string('mata_kuliah')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn([
                'fakultas',
                'jurusan',
                'semester',
                'mata_kuliah'
            ]);
        });
    }
};
