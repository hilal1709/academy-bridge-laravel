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
        Schema::create('classroom_enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('enrolled_at')->useCurrent();
            $table->enum('status', ['active', 'inactive', 'dropped'])->default('active');
            $table->text('notes')->nullable(); // Catatan khusus
            $table->timestamps();
            
            // Unique constraint untuk mencegah duplikasi enrollment
            $table->unique(['classroom_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_enrollments');
    }
};
