<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameStatusToTableHistoryInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('history_invoice', function(Blueprint $table)
        {
            $table->string('name_status')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('history_invoice', function(Blueprint $table)
        {
            $table->dropColumn('name_status');
        });
    }
}
