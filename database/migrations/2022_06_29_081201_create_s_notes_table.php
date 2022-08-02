<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opname_report_id')->nullable()->references('id')->on('opname_reports')->onDelete('cascade');
            $table->string('docking_status')->nullable();
            $table->string('docking')->nullable();
            $table->string('undocking')->nullable();
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
        Schema::dropIfExists('s_notes');
    }
}
