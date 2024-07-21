<?php

namespace Database\Seeders;

use App\Models\Assessment;
use App\Models\C3;
use App\Models\Center;
use App\Models\Profile;
use App\Models\ServiceTeam;
use App\Models\Set;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Set::factory(10)->create();
        Center::factory(10)->create();
        C3::factory(10)->create();
        ServiceTeam::factory(10)->create();
        Assessment::factory(3)->create();
        // Profile::factory(10)->create();

        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
        ]);
    }
}
