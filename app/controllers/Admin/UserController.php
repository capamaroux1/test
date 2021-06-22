<?php

namespace app\controllers\Admin;

use app\src\Authorize;
use app\src\View;
use app\src\Redirect;
use app\src\Input;
use app\src\Session;
use app\src\Token;
use app\src\Config;
use app\src\Validate;
use app\src\Hash;
use app\models\User;
use app\domain\enums\UserType;

class UserController
{
	public function __construct()
	{
		Authorize::login();
		Authorize::admin();
	}

	public function create()
	{
		$types = UserType::all();

		return View::render('admin.users.create', compact('types'));
	}

	public function edit($id)
	{
		$types = UserType::all();
		$user = User::findBy('id', $id);

		if ($user === null) {
			return abort404();
		}

		return View::render('admin.users.edit', compact('types', 'user'));
	}

	public function store()
	{	
		if (Input::exists('post')) {
			if (Token::check(Input::get('token'))){
				$validate = new Validate();
				$validation = $validate->check($_POST, [
				  'first_name' => ['required' => true, 'max' => 30],
				  'last_name' => ['required' => true, 'max' => 30],
				  'email' => ['required' => true, 'max' => 155, 'unique' => 'users'],
				  'password' => ['required' => true, 'max' => 30, 'matches' => 'confirm_password'],
				  'type' => ['required' => true, 'in' => UserType::all()],
				]);

				 if ($validation->passed()){
				 	$salt = Hash::salt(16);
					User::create([
						'first_name' => Input::get('first_name'),
						'last_name' => Input::get('last_name'),
						'email' => Input::get('email'),
						'type' => Input::get('type'),
						'salt' => $salt,
						'password' => Hash::make(Input::get('password'), $salt),
					]);

					Session::flash('success', 'Created successfully!');	
					Redirect::to(Config::get('base_url'));

				 } else {
				 		Input::flashOnly(['first_name','last_name','email','type']);
				 	 	Session::flash('error', implode('<br>', $validation->errors()));
				 }
			}
		}	

		Redirect::to(route('users/create'));			
	}	

	public function update($userId)
	{	
		if (Input::exists('post')) {
			if (Token::check(Input::get('token'))){

				$user = User::findBy('id', $userId);

				if ($user === null) {
					return abort404();
				}

				$validate = new Validate();
				$validation = $validate->check($_POST, [
				  'first_name' => ['required' => true, 'max' => 30],
				  'last_name' => ['required' => true, 'max' => 30],
				  'email' => ['required' => true, 'max' => 155, 'unique_ignore' => ['table' => 'users:id', 'ignore' => $userId]],
				  'password' => ['max' => 30, 'matches' => 'confirm_password'],
				  'type' => ['required' => true, 'in' => UserType::all()],
				]);

				if ($validation->passed()){
				 	$salt = Hash::salt(16);
					$fields = [
						'first_name' => Input::get('first_name'),
						'last_name' => Input::get('last_name'),
						'email' => Input::get('email'),
						'type' => Input::get('type'),
					];

					if (Input::get('password') !== '') {
						$fields['password'] = Hash::make(Input::get('password'), $user->getSalt());
					}

					$user->update($fields);

					Session::flash('success', 'Updated successfully!');	
					Redirect::to(Config::get('base_url'));

				 } else {
				 		Input::flashOnly(['first_name','last_name','email','type']);
				 	 	Session::flash('error', implode('<br>', $validation->errors()));
				 }
			}
		}	

		Redirect::to(route('users/'.$userId.'/edit'));			
	}	
}
