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
                'name' => 'Active',
            ],
            [
                'name' => 'Expired',
            ],
        ];
        ItemStatus::upsert($ItemStatus, []);
    }
}
