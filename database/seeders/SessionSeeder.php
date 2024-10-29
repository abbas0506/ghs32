<?php

namespace Database\Seeders;

use App\Models\Session;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Session::create(['name' => '2024-25']);
        Session::create(['name' => '2025-26']);
        Session::create(['name' => '2026-27']);
    }
}
