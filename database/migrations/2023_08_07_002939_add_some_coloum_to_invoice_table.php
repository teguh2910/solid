<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColoumToInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice', function (Blueprint $table) {
            $table->date('tgl_approve_act')->nullable();
            $table->date('tgl_terima_tax')->nullable();
            $table->date('tgl_approve_tax')->nullable();
            $table->date('tgl_pending_tax')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice', function (Blueprint $table) {
            //drop column
            $table->dropColumn('tgl_approve_act');
            $table->dropColumn('tgl_terima_tax');
            $table->dropColumn('tgl_approve_tax');
            $table->dropColumn('tgl_pending_tax');            
        });
    }
}
