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
        Section::create(['grade' => 6, 'name' => 'A', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);
        Section::create(['grade' => 6, 'name' => 'B', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);
        Section::create(['grade' => 6, 'name' => 'C', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);

        Section::create(['grade' => 7, 'name' => 'A', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);
        Section::create(['grade' => 7, 'name' => 'B', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);
        Section::create(['grade' => 7, 'name' => 'C', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);

        Section::create(['grade' => 8, 'name' => 'A', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);
        Section::create(['grade' => 8, 'name' => 'B', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);
        Section::create(['grade' => 8, 'name' => 'C', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);

        Section::create(['grade' => 9, 'name' => 'A', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);
        Section::create(['grade' => 9, 'name' => 'B', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);
        Section::create(['grade' => 9, 'name' => 'C', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);
        Section::create(['grade' => 9, 'name' => 'D', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);

        Section::create(['grade' => 10, 'name' => 'A', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);
        Section::create(['grade' => 10, 'name' => 'B', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);
        Section::create(['grade' => 10, 'name' => 'C', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);
        Section::create(['grade' => 10, 'name' => 'D', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);

        Section::create(['grade' => 11, 'name' => 'A', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);
        Section::create(['grade' => 11, 'name' => 'B', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);

        Section::create(['grade' => 12, 'name' => 'A', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);
        Section::create(['grade' => 12, 'name' => 'B', 'starts_at' => '2024/04/01', 'ends_at' => '2027/03/31']);
    }
}
