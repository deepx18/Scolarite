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
            'cin' => fake()->unique()->numerify('CIN##########'),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->email(),
            'date_of_birth' => fake()->dateTimeBetween('-30 years', '-17 years')->format('Y-m-d'),
            'birth_city' => fake()->city(),
            'nationality' => fake()->randomElement(['Moroccan', 'French', 'Spanish', 'American', 'British', 'German']),
            'gender' => fake()->randomElement(['M', 'F']),
            'department' => fake()->randomElement(['Computer Science', 'Engineering', 'Business', 'Medicine', 'Law']),
            'study_level' => fake()->randomElement(['Bac', 'Licence', 'Master', '1ere Annee', '2e Annee', '3e Annee']),
            'specialization' => fake()->randomElement(['Software Engineering', 'Data Science', 'DevOps', 'Mobile Development', 'Web Development', 'Architecture', 'Machine Learning']),
            'bac_year' => fake()->numerify('20## '),
            'province' => fake()->randomElement(['Casablanca', 'Rabat', 'Fez', 'Marrakech', 'Agadir', 'Tangier', 'Meknes', 'Sale']),
            'academic_track' => fake()->randomElement(['Science', 'Technology', 'Literature', 'Economics']),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
