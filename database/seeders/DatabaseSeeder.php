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
            'email' => 'superadmin',
            'position' => 'Super Admin',
            'role' => 'Super Admin',
        ]);
        \App\Models\User::factory()->create([
            'email' => 'administrator',
            'position' => 'Administrator',
            'role' => 'Administrator',
        ]);
        \App\Models\User::factory()->create([
            'email' => 'custodian',
            'position' => 'Property Custodian',
            'role' => 'Property Custodian',
        ]);
        \App\Models\User::factory()->create([
            'email' => 'technician',
            'position' => 'Technician',
            'role' => 'Technician',
        ]);
        \App\Models\User::factory()->create([
            'email' => 'borrower',
            'position' => 'Borrower',
            'role' => 'Borrower',
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
