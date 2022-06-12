<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['name' => "string", 'email' => "string", 'phone' => "string", 'description' => "string"])] public function definition(): array
    {
        return [
            'name'=>$this->faker->name(),
            'email'=>$this->faker->unique()->safeEmail(),
            'phone'=>$this->faker->phoneNumber(),
            'description'=>$this->faker->text(60)
        ];
    }
}
