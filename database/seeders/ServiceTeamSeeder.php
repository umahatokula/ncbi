<?php

namespace Database\Seeders;

use App\Models\ServiceTeam;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceTeam::truncate();

        ServiceTeam::create([
            'name' => 'Social Media',
            'is_active' => true,
        ]);

        ServiceTeam::create([
            'name' => 'IT and Internet',
            'is_active' => true,
        ]);

        ServiceTeam::create([
            'name' => 'Ushering',
            'is_active' => true,
        ]);

        ServiceTeam::create([
            'name' => 'Sentry',
            'is_active' => true,
        ]);

        ServiceTeam::create([
            'name' => 'Protocol',
            'is_active' => true,
        ]);

        ServiceTeam::create([
            'name' => 'Host',
            'is_active' => true,
        ]);

        ServiceTeam::create([
            'name' => "Children's Church",
            'is_active' => true,
        ]);

        ServiceTeam::create([
            'name' => 'Welfare',
            'is_active' => true,
        ]);

        ServiceTeam::create([
            'name' => 'Sound and Technical',
            'is_active' => true,
        ]);

        ServiceTeam::create([
            'name' => 'Projection',
            'is_active' => true,
        ]);

        ServiceTeam::create([
            'name' => 'Livestream and Television',
            'is_active' => true,
        ]);

        ServiceTeam::create([
            'name' => 'Arts and Aesthetics',
            'is_active' => true,
        ]);

        ServiceTeam::create([
            'name' => 'Prayer and Counselling',
            'is_active' => true,
        ]);

        ServiceTeam::create([
            'name' => 'Face to Face',
            'is_active' => true,
        ]);

        ServiceTeam::create([
            'name' => 'Voice of Creation',
            'is_active' => true,
        ]);

        ServiceTeam::create([
            'name' => 'Reception',
            'is_active' => true,
        ]);

    }
}
