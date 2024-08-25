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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->unsignedBigInteger('grade_id');  //
            $table->unsignedBigInteger('incharge_id')->nullable();
            $table->year('induction_year');
            $table->timestamps();

            $table->unique(['name', 'grade_id', 'induction_year']); //disallow same section name within a class
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('incharge_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
