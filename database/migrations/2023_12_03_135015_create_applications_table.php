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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('father', 50);
            $table->string('bform', 15);
            $table->string('phone', 16);
            $table->string('address', 100)->nullable();
            $table->string('bise_name', 20);
            $table->year('pass_year');
            $table->string('rollno', 8);
            $table->unsignedSmallInteger('obtained');
            $table->unsignedSmallInteger('total');
            $table->enum('medium', ['English', 'Urdu'])->default('Urdu'); //english:0, urdu:1
            $table->string('objection', 200)->nullable();
            $table->unsignedSmallInteger('fee_paid')->nullable();
            $table->date('paid_at')->nullable();
            $table->unsignedSmallInteger('concession')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('group_id');

            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
