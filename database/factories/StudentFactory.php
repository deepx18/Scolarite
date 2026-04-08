<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'apogee_number' => fake()->unique()->numerify('AP########'),
            'cne' => fake()->unique()->numerify('CNE########'),
            'date_of_birth' => fake()->dateTimeBetween('-25 years', '-18 years')->format('Y-m-d'),
            'department' => fake()->randomElement(['Computer Science', 'Engineering', 'Business', 'Medicine', 'Law']),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->email(),
            'status' => fake()->randomElement(['Active', 'Inactive', 'Suspended']),
        ];
    }
}
