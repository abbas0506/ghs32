<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Group::create(['name' => 'Pre Engg.', 'subjects_list' => 'Phy, Math, Chem', 'admission_fee' => 5200]);
        Group::create(['name' => 'ICS', 'subjects_list' => 'Phy, Math, Computer Sc', 'admission_fee' => 5200]);
        Group::create(['name' => 'FA', 'subjects_list' => 'Civics, Punjabi', 'admission_fee' => 5000]);
    }
}
