<?php

namespace app\src;

class Session 
{
  /**
   * Check if given session name exists.
   *
   * @param string $name
   * @return boolean
   */		
	public static function exists($name)
	{
		return (isset($_SESSION[$name])) ? true : false;
	} 

  /**
   * Store a value to the session.
   *
   * @param string $name
   * @param mixed $value
   * @return mixed
   */	
	public static function put($name, $value)
	{
		return $_SESSION[$name] = $value;
	}

  /**
   * Get a value from the session.
   *
   * @param string $name
   * @return mixed
   */	
	public static function get($name)
	{
		return $_SESSION[$name];
	}

  /**
   * Delete a value from the session.
   *
   * @param string $name
   * @return void
   */
	public static function delete($name)
	{
		if(self::exists($name)){
			unset($_SESSION[$name]);
		}
	}

  /**
   * Flash and delete a message or set a message for the next request.
   *
   * @param string $name
   * @param string $string
   * @return string|void
   */	
	public static function flash($name, $message = '')
	{
		if (self::exists($name)){
			$value = self::get($name);
			self::delete($name);
			
			return $value;
		} else {
			self::put($name, $message);
		}
	}
}
