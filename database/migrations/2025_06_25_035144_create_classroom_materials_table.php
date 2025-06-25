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
        Schema::create('classroom_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')->constrained()->onDelete('cascade');
            $table->string('title'); // Judul materi
            $table->text('description')->nullable(); // Deskripsi materi
            $table->enum('type', ['rps', 'materi', 'buku_referensi', 'slide', 'video', 'dokumen', 'link']); // Jenis materi
            $table->string('file_path')->nullable(); // Path file jika upload file
            $table->string('file_name')->nullable(); // Nama file asli
            $table->string('file_size')->nullable(); // Ukuran file
            $table->string('file_type')->nullable(); // Tipe file (pdf, ppt, doc, dll)
            $table->text('content')->nullable(); // Konten text jika bukan file
            $table->string('external_link')->nullable(); // Link eksternal
            $table->integer('week')->nullable(); // Minggu ke berapa (untuk materi mingguan)
            $table->date('publish_date')->nullable(); // Tanggal publikasi
            $table->boolean('is_published')->default(false); // Status publikasi
            $table->integer('download_count')->default(0); // Jumlah download
            $table->json('metadata')->nullable(); // Metadata tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_materials');
    }
};
