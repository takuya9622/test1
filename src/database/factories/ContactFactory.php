<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->randomElement(['1','2','3']), // 1:男性, 2:女性, 3:その他
            'email' => $this->faker->unique()->safeEmail,
            'tell' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'building' => $this->faker->optional()->secondaryAddress,
            'detail' => $this->faker->text(100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
