<?php

namespace app\src;

use app\src\Config;

class Url
{
	private $url = '/';

	public function __construct() 
	{
		$this->url = $this->parseUrl();
	}

  	/**
   	 * Get the current url.
   	 * 
   	 * @return string
   	 */
	public function getUrl() 
	{
		return $this->url;
	}

  	/**
   	 * Parses the incoming url request.
   	 * 
   	 * @return string
   	 */
	private function parseUrl() 
	{
		if (isset($_GET['url'])) {
			$path = filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL);

			return ($path !== null) ? $path : $this->url ;
		}

		return $this->url;
	}

	public static function generatePath($path) 
	{
		$directory = Config::get('base_url');

		if (substr($path, 0) !== '/') {
			$directory.='/';
		}

		return $directory .$path;
	}	
}
