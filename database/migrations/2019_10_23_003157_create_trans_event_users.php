<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransEventUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_event_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('target_id')->nullable();
            $table->string('target_type')->nullable();
            $table->integer('trans_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('type')->nullable();
            $table->string('timestamp')->nullable();
            $table->string('barcode')->nullable();
            $table->longText('status')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->nullableTimestamps();

            $table->foreign('trans_id')->references('id')->on('ref_event')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trans_event_users');
    }
}
