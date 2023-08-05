<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTglApproveUserToInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice', function(Blueprint $table)
        {
            $table->dateTime('tgl_approve_user')->after('tgl_terima_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice', function(Blueprint $table)
        {
            $table->dropColumn('tgl_approve_user');
        });
    }
}
