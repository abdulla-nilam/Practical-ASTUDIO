<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AttributeValue::insert([
            ['attribute_id' => 1, 'project_id' => 1, 'value' => 'IT'],
            ['attribute_id' => 2, 'project_id' => 1, 'value' => '2024-12-31'],
            ['attribute_id' => 3, 'project_id' => 1, 'value' => '2024-01-15'],
            ['attribute_id' => 4, 'project_id' => 1, 'value' => '500000'],

            ['attribute_id' => 1, 'project_id' => 2, 'value' => 'HR'],
            ['attribute_id' => 2, 'project_id' => 2, 'value' => '2024-11-30'],
            ['attribute_id' => 3, 'project_id' => 2, 'value' => '2024-02-01'],
            ['attribute_id' => 4, 'project_id' => 2, 'value' => '300000'],
        ]);
    }
}
