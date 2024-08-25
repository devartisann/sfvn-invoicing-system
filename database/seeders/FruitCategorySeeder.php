<?php

namespace Database\Seeders;

use App\Models\FruitCategory;
use Illuminate\Database\Seeder;

class FruitCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'apple',
            'orange',
            'pear',
            'durian',
            'mango',
            'banana',
        ];

        foreach ($names as $name) {
            FruitCategory::factory()->create([
                'name' => $name
            ]);
        }
    }
}
