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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->text('bio')->nullable()->after('phone');
            $table->string('fakultas')->nullable()->after('bio');
            $table->string('jurusan')->nullable()->after('fakultas');
            $table->string('nim_nip')->nullable()->after('jurusan');
            $table->date('birth_date')->nullable()->after('nim_nip');
            $table->enum('gender', ['male', 'female'])->nullable()->after('birth_date');
            $table->string('address')->nullable()->after('gender');
            $table->string('website')->nullable()->after('address');
            $table->string('linkedin')->nullable()->after('website');
            $table->string('instagram')->nullable()->after('linkedin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'bio', 'fakultas', 'jurusan', 'nim_nip', 
                'birth_date', 'gender', 'address', 'website', 
                'linkedin', 'instagram'
            ]);
        });
    }
};