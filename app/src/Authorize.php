<?php

namespace app\src;

use app\src\Auth;
use app\src\Redirect;
use app\domain\enums\UserType;

class Authorize
{
	/**
	 * Redirect the user to login route if not loggin
	 *
	 * @return boolean
	 */		
	public static function login()
	{
		if (!Auth::check()) {
			Redirect::to(Config::get('base_url'). '/login'); 
		}
	}

	/**
	 * Terminates the application if user given role is not authorized.
	 *
	 * @param string $role
	 */	
	private static function role($role)
	{
		if (Auth::user()->getType() !== $role) {
			header('HTTP/1.0 403 Forbidden');
			echo 'You are forbidden!';
			exit;
		}
	}	

	/**
	 * Authorize employee role.
	 *
	 * @param void
	 */
	public static function employee()
	{
		self::role(UserType::EMPLOYEE);
	}	

	/**
	 * Authorize admin role.
	 *
	 * @param void
	 */
	public static function admin()
	{
		self::role(UserType::ADMIN);
	}			
}
