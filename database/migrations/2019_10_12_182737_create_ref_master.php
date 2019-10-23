<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('target_id')->nullable();
            $table->string('target_type')->nullable();
            $table->string('filename')->nullable();
            $table->string('url')->nullable();
            $table->string('type')->nullable();
            $table->longText('description')->nullable();
            $table->longText('status')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });

        Schema::create('ref_event', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('description')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_attachments');
        Schema::dropIfExists('ref_event');
    }
}
