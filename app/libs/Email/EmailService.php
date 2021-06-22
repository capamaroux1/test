<?php

namespace app\libs\Email;

class EmailService
{
	/**
	 * @param string $path
	 * @param array $data
	 * @return string
	 */
	public function fetchTemplate($path, $data)
	{
    	extract($data);
    	ob_start();
    	require 'app/views/emails/'.$path.'.php';

    	return ob_get_clean();
	}		
}
