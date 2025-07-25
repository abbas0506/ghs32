<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'principal']);
        Role::create(['name' => 'incharge']);
        Role::create(['name' => 'teacher']);
        Role::create(['name' => 'admission']);
        Role::create(['name' => 'accountant']);
        Role::create(['name' => 'librarian']);
        Role::create(['name' => 'feeder']);
        Role::create(['name' => 'student']);
    }
}
