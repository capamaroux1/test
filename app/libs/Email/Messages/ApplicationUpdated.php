<?php

namespace app\libs\Email\Messages;

use app\contracts\EmailMessage;
use app\contracts\Notifiable;
use app\libs\Email\EmailService;

class ApplicationUpdated extends EmailService implements EmailMessage
{
	/**
	 * @var app\contracts\Notifiable
	 */
	private $user;

	/**
	 * @var app\models\Application
	 */	
	private $application;

	function __construct(Notifiable $user, $application)
	{
		$this->user = $user;
		$this->application = $application;
	}

	/**
	 * @return string
	 */
	public function toEmail()
	{
		return $this->user->email();
	}

	/**
	 * @return string
	 */
	public function toName()
	{
		return $this->user->fullName();
	}

	/**
	 * @return string
	 */
	public function body()
	{
    	return $this->fetchTemplate('application_updated', ['application' => $this->application]);
	}	

	/**
	 * @return string
	 */
	public function subject()
	{
		return 'Application Updated';
	}	
}
