<?php

namespace Database\Seeders;

use App\Models\ItemStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ItemStatus = [
            [
                'name' => 'In Good Condition',
            ],
            [
                'name' => 'Damaged',
            ],
            [
                'name' => 'Returned',
            ],
        ];
        ItemStatus::upsert($ItemStatus, []);
    }
}
