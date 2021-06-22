<?php

namespace app\src;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use app\contracts\EmailMessage;
use app\src\Config;

require 'app/libs/PHPMailer/src/Exception.php';
require 'app/libs/PHPMailer/src/PHPMailer.php';
require 'app/libs/PHPMailer/src/SMTP.php';

class Mail 
{
	/**
	 * @param app\contracts\EmailMessage $emailMessage
	 * @return void
	 */	
	public static function send(EmailMessage $emailMessage)
	{
		$mail = new PHPMailer(true);

		try {
	    //Server settings
	   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                  //Enable verbose debug output
	    $mail->isSMTP();                                          //Send using SMTP
	    $mail->Host       = Config::get('email.host');            //Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                 //Enable SMTP authentication
	    $mail->Username   = Config::get('email.username');        //SMTP username
	    $mail->Password   = Config::get('email.password');        //SMTP password
	    $mail->SMTPSecure = Config::get('email.SMTPSecure');      //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	    $mail->Port       = Config::get('email.port');            //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
	    $mail->IsHTML(true);

	    //Recipients
	    $mail->setFrom(Config::get('email.from.email'), Config::get('email.from.name'));
	    $mail->addAddress($emailMessage->toEmail(), $emailMessage->toName());

	    //Content
	    $mail->Subject = $emailMessage->subject();
	    $mail->Body = $emailMessage->body();

	    $mail->send();
	    //echo 'Message has been sent';
		} catch (\Exception $e) {
		    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}		
	}
}
