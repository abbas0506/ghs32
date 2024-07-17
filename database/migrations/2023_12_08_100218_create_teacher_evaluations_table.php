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
        Schema::create('teacher_evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_evaluation_item_id');
            $table->unsignedBigInteger('teacher_id');
            $table->enum('evaluation_marks', [0, 1, 2, 3])->default(2); //0 not done, 1:poor, 2:avg, 3:good
            $table->unsignedInteger('weight')->default(1); //equal weightage
            $table->unsignedTinyInteger('month');
            $table->timestamps();

            $table->foreign('teacher_evaluation_item_id')->references('id')->on('teacher_evaluation_items')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_evaluations');
    }
};
