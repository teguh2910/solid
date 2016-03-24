<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_transactions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('id_area');
			$table->string('part_number');
			$table->integer('amount_box');
			$table->integer('amount_pcs');
            $table->integer('total_pcs');
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
		Schema::drop('t_transactions');
	}

}
