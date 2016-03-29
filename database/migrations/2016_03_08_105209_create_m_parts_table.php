<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPartsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_parts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('back_number');
			$table->string('part_number');
			$table->string('part_name');
			$table->integer('qty_box');
			$table->string('unit');
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
		Schema::drop('m_parts');
	}

}
