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
            'email' => 'admin',
            'position' => 'DICT ADMIN',
            'role' => 'Admin',
        ]);
        \App\Models\User::factory()->create([
            'email' => 'staff',
            'position' => 'DICT STAFF',
            'role' => 'Staff',
        ]);
        // \App\Models\Employee::factory(10)->create();
        // \App\Models\ItemCategory::factory(10)->create();
        // \App\Models\Location::factory(10)->create();

        $this->call([
            PropertySeeder::class
            // ItemStatusSeeder::class,
            // ConsumableSeeder::class,
            // NonConsumableSeeder::class
            // ExpenseTypeSeeder::class
        ]);

        // \App\Models\Item::factory(10)->create();
    }
}
