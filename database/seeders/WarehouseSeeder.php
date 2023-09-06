<?php

namespace Database\Seeders;

use App\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Warehouse::create([
            'name' => 'Main Warehouse',
            'is_default' => 1
        ]);
        Warehouse::create([
            'name' => 'Jatrabari',
            'is_default' => 0
        ]);
        Warehouse::create([
            'name' => 'Uttara Office',
            'is_default' => 0
        ]);
        Warehouse::create([
            'name' => 'Out Of Dhaka',
            'is_default' => 0
        ]);
    }
}
