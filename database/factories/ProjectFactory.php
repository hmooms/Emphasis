<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'customer' => $this->faker->company(),
            'contact' => $this->faker->name(),
            'contact_phone' => $this->faker->phoneNumber(),
            'contact_email' => $this->faker->safeEmail(),
            'start_date' => $this->faker->dateTimeBetween('-3 weeks', '-5 days'),
            'end_date' => $this->faker->dateTimeBetween('+1 day', '+3 weeks'),
            'is_completed' => false,
        ];
    }
}
