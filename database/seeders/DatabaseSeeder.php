<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProjectSeeder::class,
            UserProjectSeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            TimesheetSeeder::class,
        ]);
    }
}
