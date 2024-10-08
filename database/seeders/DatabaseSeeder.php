<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedUser();
        $this->call(FruitCategorySeeder::class);
    }

    protected function seedUser(): void
    {
        User::factory()->create([
            'name' => config('app.administrator.name'),
            'email' => config('app.administrator.email'),
            'password' => config('app.administrator.password'),
        ]);
    }
}
