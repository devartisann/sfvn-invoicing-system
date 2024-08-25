<?php

namespace Database\Factories;

use App\Models\FruitCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fruit>
 */
class FruitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'unit' => 'pcs',
            'price' => $this->faker->numberBetween(10, 1000000),
        ];
    }
    
    public function setCategory(int|FruitCategory $category): static
    {
        $id = $category;
        if ($category instanceof FruitCategory) {
            $id = $category->id;
        }
        
        return $this->set('category_id', $id);
    }
}
