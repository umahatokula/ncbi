<?php

namespace Database\Seeders;

use App\Models\Assessment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Assessment::truncate();

        DB::statement("INSERT INTO `assessments` (`id`, `name`, `slug`, `number_of_attempts`, `duration_minutes`, `validity_start_time`, `validity_end_time`, `created_at`, `updated_at`) VALUES
(1, 'Basic Bible Knowledge', 'basic-bible-knowledge', 2, 30, '2024-04-14 06:00:00', '2024-04-14 21:00:00', '2024-04-14 10:52:56', '2024-04-19 10:24:36'),
(2, 'Intermediate Bible Knowledge', 'intermediate-bible-knowledge', 2, 30, '2024-04-13 20:00:00', '2024-04-14 21:05:00', '2024-04-14 10:53:30', '2024-04-14 18:06:56'),
(3, 'Test Exam', 'test-exam', 50, 1, '2024-04-18 06:00:00', '2024-04-19 23:00:00', '2024-04-19 10:25:50', '2024-04-19 19:27:25'),
(4, 'Total Man Development Assessment', 'total-man-development-assessment', 2, 75, '2024-04-23 10:00:00', '2024-04-23 12:30:00', '2024-04-20 08:18:23', '2024-04-22 13:40:17');");

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
