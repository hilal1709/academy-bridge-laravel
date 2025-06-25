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
        Schema::create('assignment_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->text('content')->nullable(); // Konten text submission
            $table->string('file_path')->nullable(); // Path file submission
            $table->string('file_name')->nullable(); // Nama file asli
            $table->string('file_size')->nullable(); // Ukuran file
            $table->string('file_type')->nullable(); // Tipe file
            $table->datetime('submitted_at'); // Waktu submit
            $table->boolean('is_late')->default(false); // Apakah terlambat
            $table->decimal('score', 5, 2)->nullable(); // Nilai
            $table->text('feedback')->nullable(); // Feedback dari dosen
            $table->datetime('graded_at')->nullable(); // Waktu dinilai
            $table->enum('status', ['submitted', 'graded', 'returned'])->default('submitted');
            $table->json('metadata')->nullable(); // Metadata tambahan
            $table->timestamps();
            
            // Unique constraint untuk mencegah duplikasi submission
            $table->unique(['assignment_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_submissions');
    }
};
