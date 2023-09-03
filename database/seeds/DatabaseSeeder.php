<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// v1.0, by Ferry, Generates Seeder
		$this->call('UserClassSeeder');
		$this->command->info('My Seeder says : tables seeded!'); 
	}

}
