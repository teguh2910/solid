<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_areas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('id_area');
			$table->string('type_plant');
			$table->string('code_area');
			$table->string('name_area');
			$table->string('pic_name');
			$table->string('pic_contact');
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
		Schema::drop('m_areas');
	}

}
