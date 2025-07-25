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
        Group::create(['code' => 'NMD', 'name' => 'Pre Engg.', 'subjects_list' => 'Phy, Math, Chem']);
        Group::create(['code' => 'ICS', 'name' => 'ICS', 'subjects_list' => 'Phy, Math, Computer Sc']);
        Group::create(['code' => 'FA', 'name' => 'Arts', 'subjects_list' => 'Civics, Punjabi']);
    }
}
