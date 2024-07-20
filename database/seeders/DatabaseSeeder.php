<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            RoleSeeder::class,
            // LanguageSeeder::class,
            GroupSeeder::class,
            GradeSeeder::class,
            ClassSeeder::class,
            UserSeeder::class,
            // DomainSeeder::class,
            LibraryRuleSeeder::class,
            // RackSeeder::class,
            TeacherEvaluationItemSeeder::class,
            // BookSeeder::class,
            SubjectSeeder::class,
            ChapterSeeder::class,
            QuestionSeeder::class,
        ]);
    }
}
