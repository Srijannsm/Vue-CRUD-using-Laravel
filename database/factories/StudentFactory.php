<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Student::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'course'=>$this-> faker->randomElement(['Computer Science', 'Engineering', 'Medicine', 'Business Administration', 'Psychology', 'English Literature', 'Biology', 'Mathematics', 'History', 'Physics']),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->phoneNumber,
        ];
    }
}
