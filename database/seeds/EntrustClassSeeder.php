<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

// v1.0 by Ferry, for entrust requirement
use App\Models\Role;
use App\Models\Permission;
use App\User;

class EntrustClassSeeder extends Seeder {

	/** v1.0 by Ferry for Entrust Seeding
	 * Run the EntrustClassSeeder seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Roles Declaration
		if (!$role_admin = Role::where('name', 'admin')->first()) {
			Role::firstOrCreate([
				'name' => 'admin',
				'display_name' => 'Administrator',
				'description' => 'Role tertinggi dalam aplikasi',
			]);
		}
	
        // Permission Declaration
        if (!$permit_all = Permission::where('name', 'permit_all')->first()) {
			Permission::firstOrCreate([
				'name' => 'permit_all',
				'display_name' => 'Permit Everything',
				'description' => 'Otorisasi semua permission',
			]);
		}

		// User Declaration
		if (!$admin = User::where('email', 'administrator@aiia.co.id')->first()) {
	        User::firstOrCreate([
	            'name'       => 'Administrator',
	            'email'      => 'administrator@aiia.co.id',
	            'password'   => bcrypt('P@ssw0rd'),
	        ]);
		}

        // Attach admin roles
        if (!$admin->hasRole('admin')) {
        	$admin->attachRole($role_admin);
        }

		// Attach permission Default to all roles
		if (! $role_admin->hasPermission(['permit_all'])) {
			$role_admin->attachPermissions([$permit_all]);
		}
	}
}
