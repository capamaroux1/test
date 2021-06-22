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
		'username' => '984439c0a1f992',
		'password' => 'c8aeca6c61cf93',
		'port' => 2525,
		'SMTPSecure' => 'tls',
		'from' => [
			'email' => 'applications@test.com',
			'name' => 'Test name'
		]
	],

];
