<?php

namespace app\seeder;

use app\src\DB;
use app\src\Hash;

class UserSeeder 
{
  /**
   * Seed the application's database.
   *
   * @return void
   */	
	public function run()
	{
		//employees
		for ($i=1; $i < 5; $i++) { 
			$salt = Hash::salt(16);

			DB::getInstance()->insert('users', [
				'first_name' => 'Employee Name '.$i,
				'last_name' => 'Employee LastName '.$i,
				'email' => 'employee_'.$i.'@mail.com',
				'password' => Hash::make('password', $salt),
				'salt' => $salt,
				'type' => 'employee',
			]);
		}

		//admin
		$salt = Hash::salt(16);	
		DB::getInstance()->insert('users', [
			'first_name' => 'Admin Name',
			'last_name' => 'Admin LastName',
			'email' => 'admin@mail.com',
			'password' => Hash::make('password', $salt),
			'salt' => $salt,
			'type' => 'admin',
		]);
	}
}

