<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQtyAmountOnTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_transactions', function (Blueprint $table) {
            //
            $table->string('ending_pcs')->after('unit');
            $table->string('ending_amount')->after('ending_pcs');
            // $table->integer('total_amount')->after('unit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
