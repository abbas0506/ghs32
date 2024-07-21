<?php

namespace Database\Seeders;

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
            'login_id' => 'admin@ghsscb.edu.pk',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('admin');

        $user = User::create([
            'login_id' => 'admission@ghsscb.edu.pk',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('admission');

        $user = User::create([
            'login_id' => 'library@ghsscb.edu.pk',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('library');


        $teacher = Teacher::create([
            'name' => "Muhammad Abbas",
            'phone' => "03000373004",
            'email' => "abbas.sscs@gmail.com",
            'cnic' => "3530119663433",
            'qualification' => 'MS in CS',
            'designation' => 'SS(CS)',
            'bps' => 17,
        ]);

        $user = User::create([
            'login_id' => $teacher->cnic,
            'password' => Hash::make('password'),
            'userable_id' => $teacher->id,
            'userable_type' => 'App\Models\Teacher',
        ]);

        $user->assignRole('teacher');

        //admin
        $teacher = Teacher::create([
            'name' => "Atif Zohaib",
            'phone' => "03045562621",
            'email' => "atifzohaibkhan@gmail.com",
            'cnic' => "3610457786765",
            'qualification' => 'MS in CS',
            'designation' => 'SSE(CS)',
            'bps' => 16,
        ]);

        $user = User::create([
            'login_id' => $teacher->cnic,
            'password' => Hash::make('password'),
            'userable_id' => $teacher->id,
            'userable_type' => 'App\Models\Teacher',
        ]);

        $user->assignRole('teacher');


        // principal
        $teacher = Teacher::create([
            'name' => "Abdul Majeed",
            'phone' => "03000373005",
            'email' => "majeed.sscs@gmail.com",
            'cnic' => "3530119663434",
            'qualification' => 'MA Economics',
            'designation' => 'SS(Eco)',
            'bps' => 18,

        ]);
        $user = User::create([
            'login_id' => $teacher->cnic,
            'password' => Hash::make('password'),
            'userable_id' => $teacher->id,
            'userable_type' => 'App\Models\Teacher',
        ]);
        $user->assignRole('principal');
        $user->assignRole('teacher');

        // lab incharge
        $teacher = Teacher::create([
            'name' => 'Muhammad Ittfaq',
            'phone' => "03143661308",
            'email' => "muhammadittfaq007@gmail.com",
            'cnic' => "3640291865395",
            'qualification' => 'MA Urdu',
            'designation' => 'EST',
            'bps' => 17,
        ]);
        $user = User::create([
            'login_id' => $teacher->cnic,
            'password' => Hash::make('password'),
            'userable_id' => $teacher->id,
            'userable_type' => 'App\Models\Teacher',
        ]);
        $user->assignRole('teacher');
    }
}
