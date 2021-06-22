<?php

namespace app\src;

use app\src\Config;
use app\src\Session;

class Token
{
  /**
   * Generate a token string.
   *
   * @return string
   */		
	public static function generate()
	{
		return Session::put(Config::get('session.token_name'), md5(uniqid()));
	}

  /**
   * Check if given token is valid.
   *
   * @param string $token
   * @return boolean
   */	
	public static function check($token)
	{
		$tokenName = Config::get('session.token_name');

		if(Session::exists($tokenName) && $token === Session::get($tokenName)){
			Session::delete($tokenName);
			
			return true;
		}
		
		return false;
	}
}
