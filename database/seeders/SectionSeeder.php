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
        Section::create(['grade' => 1]);
        Section::create(['grade' => 2]);
        Section::create(['grade' => 3]);
        Section::create(['grade' => 4]);
        Section::create(['grade' => 5]);
        Section::create(['grade' => 5]);
        Section::create(['grade' => 6]);
        Section::create(['grade' => 7]);
        Section::create(['grade' => 8]);
        Section::create(['grade' => 9, 'name' => 'A']);
        Section::create(['grade' => 9, 'name' => 'B']);
        Section::create(['grade' => 10]);
    }
}
