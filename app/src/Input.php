<?php

namespace app\src;

use app\src\Session;

class Input
{
	/**
	 * Check if exists any GET or POST action use.
	 *
	 * @param string $type 
	 * @return boolean
	 */	
	public static function exists($type = 'post')
	{
		switch($type){
			case 'post':
				return (count($_POST) > 0) ? true : false;
			case 'get':
				return (count($_GET) > 0) ? true : false;
			default:
				return false;
		}
	}

	/**
	 * Get the value from POST or GET array.
	 *
	 * @param string $item
	 * @return string
	 */	
	public static function get($item)
	{
		if(isset($_POST[$item])){
			return $_POST[$item];
		} else if(isset($_GET[$item])){
			return $_GET[$item];
		}

		return '';
	}

	/**
	 * Flash input to the session.
	 *
	 * @param array $inputs
	 * @return string
	 */
	public static function flashOnly($inputs)
	{
		$values = [];

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$values = $_POST;		
		} elseif($_SERVER['REQUEST_METHOD'] === 'GET'){
			$values = $_GET;	
		}

		foreach($values as $key => $value) {
			if (in_array($key, $inputs)) {
				Session::put($key, $value);
			}
		}
	}	

	/**
	 * Get a value if exists from the session.
	 *
	 * @param array $inputs
	 * @return string
	 */
	public static function old($name, $default = '')
	{
		if (Session::exists($name)) {
			$value = Session::get($name);
			Session::delete($name);
			
			return $value;
		}

		return $default;
	}	
}
