<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User;

class UserClassSeeder extends Seeder {

	/** v3.5 by Merio, 20151126 -- Try Seeding for Asset Master !! :)
	 * Run the EntrustClassSeeder seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        //$file = fopen('/public/master.csv','r');
        //v3.5 by Merio, 20151127 -- Seeding for Asset Master
	
            $user =[
            [
            'name' => 'Admin','email' => 'administrator@aiia.co.id',
            'password' => bcrypt('aiia')],
            'role'=>'0',
            'dept_code'=>'0'
            ];
    
	}
}