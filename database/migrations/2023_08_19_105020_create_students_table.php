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
            $table->string('img', 50)->nullable();
            $table->string('name', 50);
            $table->string('father_name', 50)->nullable();
            $table->date('birth_date')->nullable();
            $table->date('admission_date')->nullable();
            $table->string('bform', 15)->unique();
            $table->string('phone', 15)->nullable();
            $table->string('father_name_profession')->default('farmer');
            $table->unsignedInteger('father_name_income')->nullable();
            // $table->unsignedInteger('marks')->nullable();

            $table->foreignId('section_id')->constrained()->cascadeOnDelete();
            $table->foreignId('group_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('rollno');
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
