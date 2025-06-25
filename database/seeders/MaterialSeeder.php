<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */    public function run(): void
    {
        $student = \App\Models\User::create([
            'name' => 'John Student',
            'email' => 'student@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'student',
        ]);

        // Create sample file if it doesn't exist
        $sampleFilePath = 'materials/sample.pdf';
        if (!\Illuminate\Support\Facades\Storage::disk('public')->exists($sampleFilePath)) {
            \Illuminate\Support\Facades\Storage::disk('public')->put($sampleFilePath, 'Sample PDF Content');
        }

        // Get all courses
        $courses = \App\Models\Course::all();

        foreach ($courses as $course) {
            // Create verified material by lecturer
            \App\Models\Material::create([
                'title' => 'Pengenalan ' . $course->name,
                'description' => 'Materi dasar untuk ' . $course->name,
                'file_path' => $sampleFilePath,
                'original_filename' => 'pengenalan.pdf',
                'course_id' => $course->id,
                'user_id' => $course->user_id, // lecturer
                'is_verified' => true,
                'fakultas' => 'Fakultas Ilmu Komputer',
                'jurusan' => 'Teknik Informatika',
                'semester' => '1',
                'mata_kuliah' => $course->name,
                'kategori' => 'Teori',
            ]);

            // Create unverified material by student
            \App\Models\Material::create([
                'title' => 'Rangkuman ' . $course->name,
                'description' => 'Rangkuman materi untuk ' . $course->name,
                'file_path' => $sampleFilePath,
                'original_filename' => 'rangkuman.pdf',
                'course_id' => $course->id,
                'user_id' => $student->id,
                'is_verified' => false,
                'fakultas' => 'Fakultas Ilmu Komputer',
                'jurusan' => 'Teknik Informatika',
                'semester' => '1',
                'mata_kuliah' => $course->name,
                'kategori' => 'Rangkuman',
            ]);
        }
    }
}
