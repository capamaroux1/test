<?php

namespace app\domain\enums;

final class UserType
{
	const ADMIN = 'admin';
	const EMPLOYEE = 'employee';

	public static function all()
	{
	  	$reflect = new \ReflectionClass(get_called_class());

	 	return array_values($reflect->getConstants());
	}	
}
    