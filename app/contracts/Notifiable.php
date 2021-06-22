<?php

namespace app\contracts;

interface Notifiable
{
	/**
	 * @return string
	 */
	public function fullName();

	/**
	 * @return string
	 */
	public function email();
}
