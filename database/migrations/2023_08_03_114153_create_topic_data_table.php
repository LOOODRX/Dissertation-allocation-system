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
        Schema::create('topic_data', function (Blueprint $table) {
            $table->id();
            $table->text('CS_Academic');
            $table->string('Project_ID')->unique();
            $table->text('Research_Area')->nullable();
            $table->text('Project_Name')->nullable();
            $table->text('Project_Detail')->nullable();
            $table->string('Contact')->nullable();
            $table->string('Suitable_for')->nullable();
            $table->string('Associate_Supervisor')->nullable();
            $table->text('Prerequisite')->nullable();
            $table->integer('Quota')->nullable();
            $table->text('References')->nullable();
            $table->integer('Allocated')->default(0);
            $table->boolean('hide')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        Schema::dropIfExists('topic_data');
    }
};
