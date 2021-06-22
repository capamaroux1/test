<?php

namespace app\controllers\Admin;

use app\src\Authorize;
use app\src\Redirect;
use app\src\Config;
use app\src\Input;
use app\src\Session;
use app\src\Validate;
use app\models\Application;
use app\models\User;
use app\domain\enums\ApplicationStatus;
use app\src\Mail;
use app\libs\Email\Messages\ApplicationUpdated;

class ApplicationStatusController
{
	public function __construct()
	{
		Authorize::login();
		Authorize::admin();
	}

	public function update($id)
	{
		$application = Application::findBy('id', $id);

		if ($application === null) {
			return abort404();
		}

		//check if application status has been set.
		if ($application->getStatus() !== ApplicationStatus::PENDING) {
			Session::flash('errors', 'You can\'t set the status for this application because it has already been set.');
			Redirect::to(Config::get('base_url'));
		}

		$status = Input::get('status');
		$validate = new Validate();
		$validation = $validate->check(['status' => $status], [
		   'status' => [
		   	'required' => true,
		   	'in' => [ApplicationStatus::APPROVED, ApplicationStatus::REJECTED]
		   ],
		]);

		if ($validation->passed()) {
			$application->update([
				'status' => $status
			]);

			$user = User::findBy('id', $application->getUserId());
			if ($user !== null) {
				Mail::send(new ApplicationUpdated($user, $application));		
			}

			Session::flash('success', 'Updated successfully!');	
		} else {
			Session::flash('error', json_encode($validation->errors()));		
		}

		Redirect::to(Config::get('base_url'));
	}
}
