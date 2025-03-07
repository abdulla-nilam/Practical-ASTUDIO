<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::insert([
            ['name' => 'Project Alpha', 'status' => 'active'],
            ['name' => 'Project Beta', 'status' => 'inactive'],
            ['name' => 'Project Gamma', 'status' => 'active'],
            ['name' => 'Project Delta', 'status' => 'pending'],
            ['name' => 'Project Epsilon', 'status' => 'active'],
        ]);
    }
}
