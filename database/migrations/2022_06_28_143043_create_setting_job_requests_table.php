<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingJobRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_job_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('setting_job_request_id')->nullable()->references('id')->on('setting_job_requests')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->tinyInteger('level')->nullable();
            $table->string('unit')->nullable();
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
        Schema::dropIfExists('setting_job_requests');
    }
}
