<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seller_id')->nullable();
            $table->string('tr_status')->nullable();
            $table->string('tr_id')->nullable();
            $table->string('tr_amount')->nullable();
            $table->string('tr_paid')->nullable();
            $table->string('tr_error')->nullable();
            $table->dateTime('tr_date')->nullable();
            $table->string('tr_desc')->nullable();
            $table->string('tr_crc')->nullable();
            $table->string('tr_email')->nullable();
            $table->string('md5sum')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
