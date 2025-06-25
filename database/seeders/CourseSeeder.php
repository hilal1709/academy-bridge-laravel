<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first user to be the lecturer, or create one if none exists
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Default Lecturer',
                'email' => 'lecturer@academybridge.id',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        $courses = [
            [
                'name' => 'General Course',
                'code' => 'GEN001',
                'description' => 'Default course for general materials',
                'user_id' => $user->id,
            ],
            [
                'name' => 'Computer Science',
                'code' => 'CS001',
                'description' => 'Computer Science and Programming related materials',
                'user_id' => $user->id,
            ],
            [
                'name' => 'Mathematics',
                'code' => 'MATH001',
                'description' => 'Mathematics and Statistics related materials',
                'user_id' => $user->id,
            ],
            [
                'name' => 'Engineering',
                'code' => 'ENG001',
                'description' => 'Engineering and Technical materials',
                'user_id' => $user->id,
            ],
            [
                'name' => 'Business & Economics',
                'code' => 'BUS001',
                'description' => 'Business, Economics, and Management materials',
                'user_id' => $user->id,
            ],
            [
                'name' => 'Natural Sciences',
                'code' => 'SCI001',
                'description' => 'Physics, Chemistry, Biology, and other natural sciences',
                'user_id' => $user->id,
            ],
        ];

        foreach ($courses as $courseData) {
            Course::firstOrCreate(
                ['code' => $courseData['code']],
                $courseData
            );
        }

        $this->command->info('Default courses created successfully!');
    }
}