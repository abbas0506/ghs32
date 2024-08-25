<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Section::create(['grade_id' => 6, 'name' => 'A', 'induction_year' => 2024]);
        Section::create(['grade_id' => 6, 'name' => 'B', 'induction_year' => 2024]);
        Section::create(['grade_id' => 6, 'name' => 'C', 'induction_year' => 2024]);

        Section::create(['grade_id' => 7, 'name' => 'A', 'induction_year' => 2024]);
        Section::create(['grade_id' => 7, 'name' => 'B', 'induction_year' => 2024]);
        Section::create(['grade_id' => 7, 'name' => 'C', 'induction_year' => 2024]);

        Section::create(['grade_id' => 8, 'name' => 'A', 'induction_year' => 2024]);
        Section::create(['grade_id' => 8, 'name' => 'B', 'induction_year' => 2024]);
        Section::create(['grade_id' => 8, 'name' => 'C', 'induction_year' => 2024]);

        Section::create(['grade_id' => 9, 'name' => 'A', 'induction_year' => 2024]);
        Section::create(['grade_id' => 9, 'name' => 'B', 'induction_year' => 2024]);
        Section::create(['grade_id' => 9, 'name' => 'C', 'induction_year' => 2024]);
        Section::create(['grade_id' => 9, 'name' => 'D', 'induction_year' => 2024]);

        Section::create(['grade_id' => 10, 'name' => 'A', 'induction_year' => 2024]);
        Section::create(['grade_id' => 10, 'name' => 'B', 'induction_year' => 2024]);
        Section::create(['grade_id' => 10, 'name' => 'C', 'induction_year' => 2024]);
        Section::create(['grade_id' => 10, 'name' => 'D', 'induction_year' => 2024]);

        Section::create(['grade_id' => 11, 'name' => 'A', 'induction_year' => 2024]);
        Section::create(['grade_id' => 11, 'name' => 'B', 'induction_year' => 2024]);

        Section::create(['grade_id' => 12, 'name' => 'A', 'induction_year' => 2024]);
        Section::create(['grade_id' => 12, 'name' => 'B', 'induction_year' => 2024]);
    }
}
