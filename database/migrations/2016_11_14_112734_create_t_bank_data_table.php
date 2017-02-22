<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBankDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('t_bank_datas', function(Blueprint $table)
		{
			$table->increments('id');


			$table->string('code_vendor', 255);
            $table->string('vendor_name', 255);

            $table->string('code_bank', 255);
            // $table->string('nama_bank', 255);
            $table->string('part_bank', 255);
            $table->string('account_no', 255);
            $table->string('account_name', 255);
            
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
		//
		Schema::drop('t_bank_datas');
	}

}
