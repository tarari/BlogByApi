<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pio>
 */
class PioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'message'=>fake()->text(),
            'user_id'=>User::all()->random()->id,
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
