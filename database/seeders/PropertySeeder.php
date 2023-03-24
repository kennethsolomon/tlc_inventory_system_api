<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $property = [
            [
                'property_code' => 'TLC-20230-001',
                'brand' => 'Samsung',
                'model' => 'SD0D300NH',
                'category' => 'Monitor',
                'description' => 'Maroon Bezel, 20 Inch',
                'serial_number' => 'Maroon Bezel, 20 Inch',
                'purchase_date' => '11/11/2023',
                // 'warranty_period' => '12 Months',
            ],
        ];
        Property::upsert($property, []);
    }
}
