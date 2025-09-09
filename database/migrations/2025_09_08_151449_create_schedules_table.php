<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->foreignId('section_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('lecture_no');
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->foreignId('teacher_id')->nullable()->constrained('users')->onDelete('set null');
            $table->boolean('day1')->default(true);
            $table->boolean('day2')->default(true);
            $table->boolean('day3')->default(true);
            $table->boolean('day4')->default(true);
            $table->boolean('day5')->default(true);
            $table->boolean('day6')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
