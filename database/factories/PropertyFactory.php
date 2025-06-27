<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $propertyTypes = ['Studio', 'Apartment', 'Shared Room', 'Private Room', 'House'];
        $statuses = ['available', 'occupied', 'maintenance'];
        
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(5),
            'location' => $this->faker->streetAddress,
            'price' => $this->faker->numberBetween(300, 1500),
            'status' => $this->faker->randomElement($statuses),
            'type' => $this->faker->randomElement($propertyTypes),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    /**
     * Indicate that the property is available.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function available()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'available',
            ];
        });
    }

    /**
     * Indicate that the property is occupied.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function occupied()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'occupied',
            ];
        });
    }

    /**
     * Indicate that the property is under maintenance.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function maintenance()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'maintenance',
            ];
        });
    }

    /**
     * Indicate the property type.
     *
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function type(string $type)
    {
        return $this->state(function (array $attributes) use ($type) {
            return [
                'type' => $type,
            ];
        });
    }
}