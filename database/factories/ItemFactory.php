<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\ItemCategory;
use App\Models\ItemStatus;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['Consumable', 'Non-Consumable']),
            'purchaser' => $this->faker->randomElement(['Provincial Office', 'Regional Office']),
            'property_name' => $this->faker->word(),
            'property_code' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'serial_number' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(0, 50),
            'cost' => $this->faker->numberBetween(100, 5000),
            'date_acquired' => $this->faker->date(),
            'date_received' => $this->faker->date(),

            'location_id' => $this->faker->randomElement(Location::all()->pluck('id')->toArray()),
            'item_category_id' => $this->faker->randomElement(ItemCategory::all()->pluck('id')->toArray()),
            'received_by_id' => $this->faker->randomElement(Employee::all()->pluck('id')->toArray()),
            'received_from_id' => $this->faker->randomElement(Employee::all()->pluck('id')->toArray()),
            'assigned_person_id' => $this->faker->randomElement(Employee::all()->pluck('id')->toArray()),
            'item_status_id' => $this->faker->randomElement(ItemStatus::all()->pluck('id')->toArray()),
        ];
    }
}
