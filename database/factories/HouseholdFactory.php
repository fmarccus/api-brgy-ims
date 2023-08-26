<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Household>
 */
class HouseholdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'street_id' => fake()->numberBetween($min = 1, $max = 10),
            'house_number' => fake()->secondaryAddress(),
            'waste_management' => fake()->randomElement($array = array('Incineration', 'Composting', 'Recycled', 'Others')),
            'toilet' => fake()->randomElement($array = array('Pail', 'Flushed', 'Others', 'None')),
            'dwelling_type' => fake()->randomElement($array = array('Concrete', 'Semiconcrete', 'Wood', 'Others')),
            'ownership' => fake()->randomElement($array = array('Rented', 'Owned', 'Shared', 'Informal')),
        ];
    }
}
