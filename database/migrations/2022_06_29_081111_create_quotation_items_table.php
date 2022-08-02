<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->nullable()->references('id')->on('quotations')->onDelete('cascade');
            $table->foreignId('quotation_item_id')->nullable()->references('id')->on('quotation_items')->onDelete('cascade');
            $table->bigInteger('job_request_item_id')->nullable();
            $table->string('name')->nullable();
            $table->string('volume')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('service')->nullable();
            $table->string('material')->nullable();
            $table->string('status')->nullable();
            $table->string('verification')->default(0);
            $table->string('verification_client')->default(0);
            $table->string('verification_production')->nullable();
            $table->string('verification_ppic')->nullable();
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
        Schema::dropIfExists('quotation_items');
    }
}
