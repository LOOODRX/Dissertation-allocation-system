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
        Schema::create('allocation_result', function (Blueprint $table) {
            $table->integer('id') ->unique();
            $table->string('Name');
            $table->string('Project_ID');
            $table->string('Project_Name')->nullable();
            $table->text('CS_Academic')->nullable();
            $table->text('Contact_Email')->nullable();
            $table->string('Allocation_Operator_Id');
            $table->string('Allocation_Operator_Name');
            $table->boolean('Allocated')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allocation_result');
    }
};
