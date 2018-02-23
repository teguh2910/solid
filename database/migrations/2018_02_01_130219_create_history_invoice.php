<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_invoice', function(Blueprint $table){
            $table->increments('id');
            $table->string('dept_code');
            $table->string('no_penerimaan');
            $table->string('status');
            $table->datetime('tanggal');
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
        Schema::drop('history_invoice');
    }
}
