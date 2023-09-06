<?php

namespace Database\Seeders;

use App\SalesDesignation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesDesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SalesDesignation::create([
            'name' => 'MPO',
            'is_default' => 1,
            'level' => 1,
            'commission_percentage' => 2
        ]);
        SalesDesignation::create([
            'name' => 'TM',
            'is_default' => 0,
            'level' => 2,
            'commission_percentage' => 1
        ]);
        SalesDesignation::create([
            'name' => 'JR. RSM',
            'is_default' => 0,
            'level' => 3,
            'commission_percentage' => 0.5
        ]);
        SalesDesignation::create([
            'name' => ' RSM',
            'is_default' => 0,
            'level' => 3,
            'commission_percentage' => 0.1
        ]);
        SalesDesignation::create([
            'name' => ' ASM',
            'is_default' => 0,
            'level' => 4,
            'commission_percentage' => 0.1
        ]);
        SalesDesignation::create([
            'name' => 'NSM',
            'is_default' => 0,
            'level' => 5,
            'commission_percentage' => 0.1
        ]);
    }
}