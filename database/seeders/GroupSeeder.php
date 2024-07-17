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
        Group::create(['code' => 'NMD', 'name' => 'Pre Engineering', 'subjects_list' => 'Physics, Math, Chemistry']);
        Group::create(['code' => 'ICS', 'name' => 'ICS', 'subjects_list' => 'Physics, Math, Computer Science']);
        Group::create(['code' => 'HMT', 'name' => 'Humanities', 'subjects_list' => 'Civics, Punjabi, Health & Physical Education']);
    }
}
