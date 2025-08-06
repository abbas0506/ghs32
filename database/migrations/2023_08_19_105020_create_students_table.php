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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('photo', 50)->nullable();
            $table->string('name', 50);
            $table->string('father_name', 50)->nullable();
            $table->string('mother_name', 50)->nullable();
            $table->string('bform', 15);
            $table->string('gender', 1)->default('m');
            $table->string('phone', 16)->nullable();
            $table->string('address', 100)->nullable();
            $table->date('dob');
            $table->string('identification_mark', 100)->nullable();
            $table->string('caste', 50)->nullable();
            $table->boolean('is_orphan')->default(false);
            $table->string('guardian_relation')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_cnic')->nullable();
            $table->string('mother_cnic')->nullable();
            $table->string('guardian_profession', 50)->nullable();
            $table->unsignedInteger('guardian_income')->nullable();


            $table->foreignId('section_id')->constrained()->cascadeOnDelete();
            $table->foreignId('group_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('rollno');
            $table->date('admission_date')->nullable();
            $table->string('admission_no')->nullable()->unique();

            $table->boolean('library_banned')->default(1);
            $table->boolean('card_printed')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
