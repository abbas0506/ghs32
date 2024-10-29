<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //admin
        $user = User::create([
            'email' => 'abbas.sscs@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole(['admin', 'teacher']);

        Profile::create([
            'user_id' => $user->id,
            'name' => "Muhammad Abbas",
            'phone' => "03000373004",
            'cnic' => "3530119663433",
            'qualification' => 'MS in CS',
            'designation' => 'SS(CS)',
            'bps' => 17,
        ]);

        $user = User::create([
            'email' => 'admission@ghsscb.edu.pk',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('admission');

        //sir atif
        $user = User::create([
            'email' => "atifzohaibkhan@gmail.com",
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('teacher');

        Profile::create([
            'user_id' => $user->id,
            'name' => "Atif Zohaib",
            'phone' => "03045562621",
            'cnic' => "3610457786765",
            'qualification' => 'MS in CS',
            'designation' => 'SSE(CS)',
            'bps' => 16,
        ]);

        // lab incharge
        $user = User::create([
            'email' => "muhammadittfaq007@gmail.com",
            'password' => Hash::make('password'),
        ]);

        $user->assignRole(['teacher', 'librarian']);
        Profile::create([
            'user_id' => $user->id,
            'name' => 'Muhammad Ittfaq',
            'phone' => "03143661308",
            'cnic' => "3640291865395",
            'qualification' => 'MA Urdu',
            'designation' => 'EST',
            'bps' => 17,
        ]);
    }
}
