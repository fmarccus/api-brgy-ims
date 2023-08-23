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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('household_id')->constrained()->cascadeOnUpdate();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('birth_date');
            $table->integer('age');
            $table->string('sex');
            $table->string('pregnant');
            $table->string('civil_status')->default('Single');
            $table->string('religion')->default('Catholic');
            $table->string('contact');
            $table->string('nationality')->default('Filipino');
            $table->string('household_head');
            $table->string('bona_fide');
            $table->string('resident_six_months');
            $table->string('solo_parent');
            $table->string('voter');
            $table->string('pwd');
            $table->string('disability')->nullable();
            $table->string('studying');
            $table->string('highest_education');
            $table->string('employed');
            $table->string('job_title')->nullable();
            $table->integer('income')->default(0);
            $table->string('income_classification')->default('Poor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
