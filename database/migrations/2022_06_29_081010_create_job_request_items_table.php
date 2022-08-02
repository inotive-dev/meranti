<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobRequestItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_request_id')->nullable()->references('id')->on('job_requests')->onDelete('cascade');
            $table->foreignId('job_request_item_id')->nullable()->references('id')->on('job_request_items')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('volume')->nullable();
            $table->string('remarks')->nullable();
            $table->text('remarks_reason')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('job_request_items');
    }
}
