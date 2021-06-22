<?php

namespace app\controllers;

use app\src\Input;
use app\src\Auth;
use app\src\Redirect;
use app\src\View;
use app\src\Token;
use app\src\Config;
use app\src\Validate;
use app\src\Session;
use app\src\Hash;
use app\models\User;

class AuthController
{
	public function showLoginForm()
	{
		if (Auth::check()){
			Redirect::to(Config::get('base_url')); 
		}

		return View::render('auth.login');
	}

  /**
   * Handle a login request to the application.
   * 
   * @return void
   */
	public function login()
	{
		if (Input::exists('post')) {
			if (Token::check(Input::get('token'))) {
				$validate = new Validate();
				$validation = $validate->check($_POST, array(
				   'email' => array('required' => true),
				   'password' => array('required' => true)
				));

				if ($validation->passed()) {
					$user = User::findBy('email', Input::get('email'));

					if ($user !== null && $user->getPassword() === Hash::make(Input::get('password'), $user->getSalt())) {
						Session::put(Config::get('session.user_name'), $user->getId());
						Session::flash('success', 'Login success.');
						Redirect::to(Config::get('base_url'));
					} else {
						Input::flashOnly(['email']);
						Session::flash('error', 'Invalid email or password.');
						Redirect::to(route('login'));
					}
				} else {
					Session::flash('error', implode('<br>', $validation->errors()));
					Redirect::to(route('login'));
				}
			}
		}

		Redirect::to(route('login'));
	}

  /**
   * Handle a logout request to the application.
   * 
   * @return void
   */
	public function logout()
	{
		if (Auth::check() && Input::exists('post')){
			Session::delete(Config::get('session.user_name'));
			session_destroy();
		}

		Redirect::to(route('login'));
	}	
}
