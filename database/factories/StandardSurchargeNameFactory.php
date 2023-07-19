<?php

namespace Database\Factories;

use App\Models\StandardSurchargeName;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StandardSurchargeName>
 */
class StandardSurchargeNameFactory extends Factory
{
    protected $model = StandardSurchargeName::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ucwords($this->faker->unique()->words(3, true)),
        ];
    }
}
