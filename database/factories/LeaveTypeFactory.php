<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveType>
 */
class LeaveTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => 1,
            'name' => $this->faker->word(),
            'is_paid' => 1,
            'total_leaves' => $this->faker->numberBetween(1,20),
            'max_leave_per_month' => $this->faker->numberBetween(1,10),
            'created_by' => 1,
        ];
    }
}
