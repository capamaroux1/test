<?php

namespace app\controllers;

use app\src\Auth;
use app\src\View;
use app\src\Config;
use app\src\Redirect;
use app\models\User;
use app\src\Authorize;
use app\models\Application;

class DashboardController
{
	public function __construct()
	{
		Authorize::login();
	}

	public function dashboard()
	{
		if (Auth::user()->isAdmin()) {
			$users = User::all();

			return View::render('admin.users.index', compact('users'));
		}

		$applications = Application::all('user_id', Auth::id());

		return View::render('employee.applications.index', compact('applications'));
	}
}
