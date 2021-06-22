<?php

namespace app\src;

use app\models\User;
use app\src\Redirect;
use app\src\Config;
use app\src\Session;

class Auth 
{
  /**
   * @var app\models\User | null
   */
  private static $user = null;
	
	public function __construct()
	{
		$sessionName = Config::get('session.user_name');

		if (Session::exists($sessionName)) {
			$userId = Session::get($sessionName);
			self::$user = User::findBy('id', $userId);
		}
	}

  /**
   * Get the logged in user.
   * 
   * @return app\src\User
   */
	public static function user()
	{
		return self::$user;
	}

  /**
   * Get the logged in user id.
   * 
   * @return integer
   */
	public static function id() 
	{
		return self::$user->getId();
	}

  /**
   * Determines whether the current visitor is a logged in user.
   * 
   * @return boolean
   */
	public static function check()
	{
		return self::$user !== null;
	}	
}
