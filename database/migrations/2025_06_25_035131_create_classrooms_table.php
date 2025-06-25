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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama mata kuliah
            $table->string('code')->unique(); // Kode kelas
            $table->text('description')->nullable(); // Deskripsi kelas
            $table->string('subject'); // Mata kuliah (contoh: Pemrograman Web)
            $table->string('program'); // Program studi (contoh: Sistem Informasi)
            $table->integer('semester'); // Semester
            $table->string('academic_year'); // Tahun akademik (contoh: 2024/2025)
            $table->enum('status', ['active', 'inactive', 'archived'])->default('active');
            $table->foreignId('lecturer_id')->constrained('users')->onDelete('cascade'); // Dosen pengampu
            $table->string('room')->nullable(); // Ruang kelas
            $table->json('schedule')->nullable(); // Jadwal kelas (hari, jam)
            $table->integer('max_students')->default(40); // Maksimal mahasiswa
            $table->text('syllabus')->nullable(); // Silabus
            $table->string('cover_image')->nullable(); // Gambar cover kelas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
