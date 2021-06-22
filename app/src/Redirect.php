<?php

namespace app\src;

class Redirect
{
	/**
	 * Redirect to the given location.
	 *
	 * @param string $location
	 */	
	public static function to($location)
	{
		header('Location: ' . $location);
		exit();
	}
}
