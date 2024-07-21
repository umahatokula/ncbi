<?php

namespace Database\Seeders;

use App\Models\Center;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Center::truncate();

        Center::create([
            'name' => 'CFC Abuja',
            'is_active' => true,
            'address' => 'Abuja',
            'phone' => '',
        ]);

        Center::create([
            'name' => 'CFC Gboko',
            'is_active' => true,
            'address' => 'Gboko',
            'phone' => '',
        ]);

        Center::create([
            'name' => 'CFC Makurdi',
            'is_active' => true,
            'address' => 'Makurdi',
            'phone' => '',
        ]);

        Center::create([
            'name' => 'CFC Kaduna',
            'is_active' => true,
            'address' => 'Kaduna',
            'phone' => '',
        ]);

        Center::create([
            'name' => 'CFC Sagamu',
            'is_active' => true,
            'address' => 'Sagamu',
            'phone' => '',
        ]);

        Center::create([
            'name' => 'CFC Lagos',
            'is_active' => true,
            'address' => 'Lagos',
            'phone' => '',
        ]);

        Center::create([
            'name' => 'CFC Benin',
            'is_active' => true,
            'address' => 'Benin',
            'phone' => '',
        ]);

        Center::create([
            'name' => 'CFC Jos',
            'is_active' => true,
            'address' => 'Jos',
            'phone' => '',
        ]);

        Center::create([
            'name' => 'CFC Abidjan',
            'is_active' => true,
            'address' => 'Abidjan',
            'phone' => '',
        ]);

        Center::create([
            'name' => 'Vinelife Fellowship - Taraba',
            'is_active' => true,
            'address' => 'Vinelife Fellowship - Taraba',
            'phone' => '',
        ]);

        Center::create([
            'name' => 'Vinelife Fellowship - Ebonyi',
            'is_active' => true,
            'address' => 'Vinelife Fellowship - Ebonyi',
            'phone' => '',
        ]);

        Center::create([
            'name' => 'Vinelife Fellowship - Anambra',
            'is_active' => true,
            'address' => 'Vinelife Fellowship - Anambra',
            'phone' => '',
        ]);

        Center::create([
            'name' => 'Vinelife Fellowship - Jos',
            'is_active' => true,
            'address' => 'Vinelife Fellowship - Jos',
            'phone' => '',
        ]);
    }
}
