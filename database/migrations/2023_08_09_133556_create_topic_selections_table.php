<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicSelectionsTable extends Migration
{
    public function up()
    {
        Schema::create('topic_selections', function (Blueprint $table) {
            $table->integer('id');
            $table->string('Name')->nullable();
            $table->string('Project_ID')->nullable();
            $table->text('Project_Name')->nullable();
            $table->text('Quota')->nullable();
            $table->text('CS_Academic')->nullable();
            $table->text('Contact_email')->nullable();
            $table->integer('Rank')->nullable();
            $table->boolean('Contacted_with_supervisor')->default(false);
            $table->boolean('Allocated')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('topic_selections');
    }
}