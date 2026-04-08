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
     */
    public function definition(): array
    {
        $type = fake()->randomElement(array_keys(Request::TYPES));
        
        return [
            'reference' => 'REQ-' . date('Y') . '-' . str_pad(fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'student_id' => Student::factory(),
            'type' => $type,
            'status' => fake()->randomElement(array_keys(Request::STATUSES)),
            'comment' => fake()->optional(0.6)->paragraph(),
            'details' => $this->generateTypeDetails($type),
            'submitted_at' => fake()->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
            'reviewed_at' => fake()->optional(0.7)->dateTime(),
        ];
    }

    /**
     * Generate type-specific details based on request type
     */
    private function generateTypeDetails(string $type): array
    {
        return match ($type) {
            'transfer' => [
                'destination_program' => fake()->randomElement(['Computer Science', 'Business Administration', 'Engineering', 'Marketing']),
                'reason' => fake()->sentence(),
            ],
            'withdrawal' => [
                'course_code' => fake()->regexify('[A-Z]{3}\d{3}'),
                'course_name' => fake()->sentence(3),
                'reason' => fake()->sentence(),
            ],
            'transcript' => [
                'number_of_copies' => fake()->numberBetween(1, 5),
                'delivery_method' => fake()->randomElement(['email', 'pickup', 'mail']),
            ],
            'leave' => [
                'leave_type' => fake()->randomElement(['medical', 'personal', 'academic']),
                'start_date' => fake()->date(),
                'end_date' => fake()->date(),
                'reason' => fake()->sentence(),
            ],
            'appeal' => [
                'course_code' => fake()->regexify('[A-Z]{3}\d{3}'),
                'grade_received' => fake()->randomElement(['D', 'D+', 'C-', 'C', 'C+']),
                'reason' => fake()->sentence(),
            ],
            'extension' => [
                'assignment_name' => fake()->sentence(3),
                'requested_days' => fake()->numberBetween(1, 7),
                'reason' => fake()->sentence(),
            ],
            'accommodation' => [
                'accommodation_type' => fake()->randomElement(['Extended time', 'Quiet room', 'Note-taking assistance', 'Alternative format']),
                'supporting_documentation' => fake()->boolean(),
                'description' => fake()->sentence(),
            ],
            default => [],
        };
    }
}
