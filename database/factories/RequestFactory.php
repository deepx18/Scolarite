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
            'transcript' => [
                'number_of_copies' => fake()->numberBetween(1, 5),
                'delivery_method' => fake()->randomElement(['email', 'pickup', 'mail']),
            ],

            'enrollment_certificate' => [
                'number_of_copies' => fake()->numberBetween(1, 5),
                'delivery_method' => fake()->randomElement(['email', 'pickup', 'mail']),
            ],

            'baccalaureate_withdrawal' => [
                'reason' => fake()->sentence(),
                'expected_return_date' => fake()->dateTimeBetween('+1 week', '+1 month')->format('Y-m-d'),
            ],

            'internship_agreement' => [
                'company_name' => fake()->company(),
                'start_date' => fake()->date(),
                'end_date' => fake()->date(),
                'description' => fake()->sentence(),
            ],

            're_enrollment' => [
                'academic_year' => fake()->randomElement(['2025/2026', '2026/2027']),
                'program' => fake()->randomElement([
                    'Computer Science',
                    'Business Administration',
                    'Engineering',
                    'Marketing'
                ]),
            ],

            'personal_info_correction' => [
                'field_to_correct' => fake()->randomElement(['name', 'date_of_birth', 'address', 'phone']),
                'current_value' => fake()->word(),
                'correct_value' => fake()->word(),
                'justification' => fake()->sentence(),
            ],
            default => [],
        };
    }
}
