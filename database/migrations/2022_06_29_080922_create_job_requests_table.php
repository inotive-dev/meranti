<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->references('id')->on('projects')->onDelete('cascade');
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('created_user_id')->nullable();
            $table->string('number')->nullable();
            $table->string('revision')->nullable();
            $table->string('reference')->nullable();   
            $table->string('verification')->default(0);   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_requests');
    }
}
