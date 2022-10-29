<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory()->create([
            'email' => 'kenneth@email.com',
        ]);
        \App\Models\Employee::factory(10)->create();
        \App\Models\ItemCategory::factory(10)->create();
        \App\Models\Location::factory(10)->create();

        $this->call([
            ItemStatusSeeder::class
            // ExpenseTypeSeeder::class
        ]);
    }
}
