<?php

return [

	'base_url' => 'http://localhost/epignosis_assessment',

	'mysql' => [
		'host' => '127.0.0.1',
		'db_name' => 'epignosis_test_db',
		'username' => 'root',
		'password' => '',
	],

	'session' => [
		'user_name' => 'user',
		'token_name'=>'token'
	],

	'email' => [
		'host' => 'smtp.mailtrap.io',
		'username' => '',
		'password' => '',
		'port' => 2525,
		'SMTPSecure' => 'tls',
		'from' => [
			'email' => 'applications@test.com',
			'name' => 'Test name'
		]
	],

];
