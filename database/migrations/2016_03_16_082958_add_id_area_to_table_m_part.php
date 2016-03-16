<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdAreaToTableMPart extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('m_parts', function(Blueprint $table)
		{
			$table->string('id_area');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('m_parts', function(Blueprint $table)
		{
			$table->dropColumn('id_area');
		});
	}

}
