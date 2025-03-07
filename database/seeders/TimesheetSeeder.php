<?php

namespace Database\Seeders;

use App\Models\Timesheet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimesheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Timesheet::insert([
            ['user_id' => 1, 'project_id' => 1, 'task_name' => 'Bug Fixing', 'date' => '2024-03-06', 'hours' => 5],
            ['user_id' => 1, 'project_id' => 1, 'task_name' => 'Feature Development', 'date' => '2024-03-07', 'hours' => 6],
            ['user_id' => 2, 'project_id' => 2, 'task_name' => 'Testing', 'date' => '2024-03-06', 'hours' => 4],
            ['user_id' => 2, 'project_id' => 2, 'task_name' => 'Documentation', 'date' => '2024-03-07', 'hours' => 3],
        ]);
    }
}
