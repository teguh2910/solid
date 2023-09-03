<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StatusInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_invoice', function(Blueprint $table){
            $table->increments('id');
            $table->integer('status');
            $table->string('keterangan');
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
        Schema::drop('status_invoice');
    }
}
