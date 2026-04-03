<?php

namespace Database\Seeders;

use App\Models\Request;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        
        Request::factory(30)->create([
            'student_id' => fn () => $students->random()->id,
        ]);
    }
}
