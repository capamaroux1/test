<?php

namespace app\src;

class Config 
{
	/**
	 * Get a value from the config array.
	 *
	 * @param string $path 
	 * @return mixed
	 */		
	public static function get($path)
	{
		$parts = explode('.', $path);
		$value = $GLOBALS['config'];

		foreach ($parts as $part) {
			if (!isset($value[$part])) {
				$value = null;
				
				break;
			}	

			$value = $value[$part];
		}

		if ($value !== null) {
			return $value;
		}
		
		return null;
	}
}
