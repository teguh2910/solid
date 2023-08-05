<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterInvoiceTableAddCodeBankData extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
			Schema::table('invoice', function(Blueprint $table)
	    {
	        $table->string('code_bank_data', 255);
	        
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
		Schema::table('invoice', function(Blueprint $table)
		{
			$table->dropColumn('code_bank_data');
		});

	}

}
