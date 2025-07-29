<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course; // Import the Course model

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::firstOrCreate(['name' => 'Mathematics I', 'credits' => 3]);
        Course::firstOrCreate(['name' => 'Physics I', 'credits' => 4]);
        Course::firstOrCreate(['name' => 'Computer Science I', 'credits' => 3]);
        Course::firstOrCreate(['name' => 'Literature', 'credits' => 3]);
        Course::firstOrCreate(['name' => 'Chemistry', 'credits' => 4]);
        Course::firstOrCreate(['name' => 'History', 'credits' => 3]);
    }
}