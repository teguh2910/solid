<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemarkActToInvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('invoice', function(Blueprint $table)
		{
			$table->string('remark_act');
			$table->dateTime('tgl_pending_user');
			$table->dateTime('tgl_pending_act');
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
			$table->dropColumn('remark_act');
		});
	}

}