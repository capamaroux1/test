<?php

namespace app\src;

class View 
{
  /**
   * Render template.
   *
   * @param string $renderPath 
   * @param array|null $data
   * @return string
   */	
	public static function render($renderPath, $data = null)
	{
	  $renderPath = str_replace('.', '/', $renderPath);
	  $path = null;

	  if (file_exists('app/views/'. $renderPath . '.php')) {
	    $path = 'app/views/'. $renderPath . '.php';
	  }

	  if (is_array($data)) {
			extract($data);
	  }

	  require_once 'app/views/layouts/master.php';
	}
}
