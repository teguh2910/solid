<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInvoice extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('no_penerimaan');
			$table->string('dept_code');
			$table->string('vendor');
			$table->date('tgl_terima');
			$table->string('doc_no');
			$table->date('doc_date');
			$table->date('due_date');
			$table->string('curr');
			$table->decimal('amount', 17, 2);
			$table->string('doc_no_2');
			$table->dateTime('tgl_input');
			$table->string('user');
			$table->dateTime('tgl_terima_user');
			$table->string('remark');
			$table->string('status');
			$table->string('act');
			$table->dateTime('tgl_terima_act');
			$table->string('finance');
			$table->dateTime('tgl_terima_finance');
			$table->string('finance2');
			$table->dateTime('tgl_ready_to_pay');
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
		Schema::drop('invoice');
	}

}
