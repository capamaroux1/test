<?php

namespace app\controllers\Employee;

use app\src\Auth;
use app\src\Authorize;
use app\src\View;
use app\src\Mail;
use app\src\Input;
use app\src\Token;
use app\src\Validate;
use app\src\Redirect;
use app\src\Config;
use app\src\Session;
use app\models\Application;
use app\models\User;
use app\domain\enums\UserType;
use app\libs\Email\Messages\ApplicationCreated;

class ApplicationController
{
	public function __construct()
	{
		Authorize::login();
		Authorize::employee();
	}

	public function create()
	{
		return View::render('employee.applications.create');
	}

	public function store()
	{
		if (Input::exists('post')) {
			if (Token::check(Input::get('token'))){
				$validate = new Validate();
				$validation = $validate->check($_POST, array(
				  'vacation_start' => ['required' => true],
				  'vacation_end' => ['required' => true],
				  'reason' => ['required' => true, 'max' => 755],
				));

				if ($validation->passed()) {
					$createdApplication = Application::create([
						'vacation_start' => Input::get('vacation_start'),
						'vacation_end' => Input::get('vacation_end'),
						'reason' => Input::get('reason'),
						'user_id' => Auth::id(),
					]);

					if ($createdApplication !== null) {
						$user = User::findBy('type', UserType::ADMIN);
						
						if ($user !== null) {
							Mail::send(new ApplicationCreated($user, Auth::user(), $createdApplication));
						}
					}

					Session::flash('success', 'Created successfully!');	
					Redirect::to(Config::get('base_url'));
				} else {
					Input::flashOnly(['vacation_start','vacation_end','reason']);
					Session::flash('error', implode('<br>', $validation->errors()));
					Redirect::to(route('applications/create'));
				}
			}
		}	

		Redirect::to(route('applications/create'));	
	}	
}
