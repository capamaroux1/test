<?php

namespace app\contracts;

interface EmailMessage
{
	/**
	 * @return string
	 */
	public function subject();

	/**
	 * @return string
	 */
	public function body();

	/**
	 * @return string
	 */
	public function toName();

	/**
	 * @return string
	 */
	public function toEmail();
}
