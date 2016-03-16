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
			$table->string('back_number')->unique();
			$table->string('part_number')->unique();
			$table->string('part_name');
			$table->integer('qty_per_box');
			$table->string('unit');
			$table->string('id_area');
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
