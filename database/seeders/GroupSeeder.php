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
        Group::create(['name' => 'Pre Engg.', 'subjects_list' => 'Phy, Math, Chem']);
        Group::create(['name' => 'ICS', 'subjects_list' => 'Phy, Math, Computer Sc']);
        Group::create(['name' => 'FA', 'subjects_list' => 'Civics, Punjabi']);
    }
}
