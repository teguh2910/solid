<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVclassKindCollumnInTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('t_transactions', function (Blueprint $table) {
            //
            $table->string('v_class')->after('part_name');
            $table->string('kind')->after('v_class');
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
