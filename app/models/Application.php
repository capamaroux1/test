<?php

namespace app\models;

use app\src\DB;
use app\models\Model;

class Application extends Model
{
  /**
   * @var string
   */
  protected static $table = 'applications';
  
  /**
   * @var string
   */  
  protected static $primaryKey = 'id';

  /**
   * @return integer
   */
  public function getId()
  {
    return $this->getColumnValue('id');
  }

  /**
   * @return string
   */
  public function getReason()
  {
    return $this->getColumnValue('reason');
  }

  /**
   * @return string
   */
	public function getCreatedAt()
	{
		return $this->getColumnValue('created_at');
	}

  /**
   * @return string
   */
  public function getVacationStart()
  {
    return $this->getColumnValue('vacation_start');
  }

  /**
   * @return string
   */
  public function getVacationEnd()
  {
    return $this->getColumnValue('vacation_end');
  }

  /**
   * @return integer
   */
	public function getUserId()
	{
		return $this->getColumnValue('user_id');
	}

  /**
   * @return string
   */
	public function getStatus()
	{
		return $this->getColumnValue('status');
	}	  
}
