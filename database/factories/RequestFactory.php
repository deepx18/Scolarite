<?php

namespace Database\Factories;

use App\Models\Request;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Request>
 */
class RequestFactory extends Factory
{
    protected $model = Request::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'type' => fake()->randomElement(['Transfer', 'Withdrawal', 'Transcript', 'Leave', 'Appeal']),
            'status' => fake()->randomElement(['Pending', 'Approved', 'Rejected', 'In Review']),
            'comment' => fake()->optional(0.7)->sentence(),
        ];
    }
}
