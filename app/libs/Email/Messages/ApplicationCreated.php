<?php

namespace app\libs\Email\Messages;

use app\contracts\EmailMessage;
use app\contracts\Notifiable;
use app\libs\Email\EmailService;

class ApplicationCreated extends EmailService implements EmailMessage
{
	/**
	 * @var app\contracts\Notifiable
	 */
	private $user;

	/**
	 * @var app\contracts\Notifiable
	 */	
	private $from;

	/**
	 * @var app\models\Application
	 */	
	private $application;

	function __construct(Notifiable $user, Notifiable $from, $application)
	{
		$this->user = $user;
		$this->from = $from;
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
    return $this->fetchTemplate('application_created', ['application' => $this->application, 'from' => $this->from]);
	}	

	/**
	 * @return string
	 */
	public function subject()
	{
		return 'New Application';
	}	
}
