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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')->constrained()->onDelete('cascade');
            $table->string('title'); // Judul tugas
            $table->text('description'); // Deskripsi tugas
            $table->text('instructions')->nullable(); // Instruksi pengerjaan
            $table->enum('type', ['individual', 'group'])->default('individual'); // Tipe tugas
            $table->integer('max_score')->default(100); // Nilai maksimal
            $table->datetime('start_date'); // Tanggal mulai
            $table->datetime('due_date'); // Deadline
            $table->datetime('late_submission_date')->nullable(); // Batas akhir dengan penalty
            $table->boolean('allow_late_submission')->default(false); // Izinkan terlambat
            $table->integer('late_penalty_percent')->default(0); // Penalty keterlambatan (%)
            $table->string('attachment_path')->nullable(); // File lampiran dari dosen
            $table->string('attachment_name')->nullable(); // Nama file lampiran
            $table->boolean('is_published')->default(false); // Status publikasi
            $table->json('submission_settings')->nullable(); // Pengaturan submission
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
