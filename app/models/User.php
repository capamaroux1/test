<?php

namespace app\models;

use app\src\DB;
use app\contracts\Notifiable;
use app\domain\enums\UserType;
use app\models\Model;

class User extends Model implements Notifiable {
	/**
 	 * @var string
 	*/
	protected static $table = 'users';
	protected static $primaryKey = 'id';

  /**
   * Get the user's id.
   *
   * @return integer
   */
  public function getId()
  {
    return $this->getColumnValue('id');
  }

  /**
   * Get the user's email.
   *
   * @return string
   */
	public function email()
	{
		return $this->getEmail();
	}	

  /**
   * Get the user's email.
   *
   * @return string
   */
	public function getEmail()
	{
		return $this->getColumnValue('email');
	}	

  /**
   * Get the user's password.
   *
   * @return string
   */
	public function getPassword()
	{
		return $this->getColumnValue('password');
	}

  /**
   * Get the user's salt value.
   *
   * @return string
   */
	public function getSalt()
	{
		return $this->getColumnValue('salt');
	}

  /**
   * Get the user's full name.
   *
   * @return string
   */
	public function fullName()
	{
		return $this->getFirstName() . ' '.$this->getLastName();
	}		

  /**
   * Get the user's first name.
   *
   * @return string
   */
	public function getFirstName()
	{
		return $this->getColumnValue('first_name');
	}	

  /**
   * Get the user's last name.
   *
   * @return string
   */
	public function getLastName()
	{
		return $this->getColumnValue('last_name');
	}	


  /**
   * Get the user's type.
   *
   * @return string
   */
	public function getType()
	{
		return $this->getColumnValue('type');
	}	

  /**
   * Check if user is admin.
   *
   * @return boolean
   */
  public function isAdmin()
  {
    return $this->getType() === UserType::ADMIN;
  }	
}
