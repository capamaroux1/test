<?php

namespace app\src;

use app\src\Config;

class DB {
  	/**
     * @var app\src\DB|null
     */	
	private static $instance = null;

  	/**
     * @var \PDO
     */
	private $pdo;

  	/**
     * @var object
     */
	private $query;

  	/**
     * @var boolean
     */
	private $error;

  	/**
     * @var array
     */
	private $result;

  	/**
     * @var integer
     */
	private $count = 0;


	private function __construct()
	{
		try{
			$this->pdo = new \PDO('mysql:host='.Config::get('mysql.host').';
				dbname='.Config::get('mysql.db_name').';
				charset=utf8mb4',Config::get('mysql.username'),
				Config::get('mysql.password')
			);
			//$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} catch(\PDOException $e){
			die($e->getMessage());
		}
	}	

	public static function getInstance()
	{
		if (self::$instance === null) {
			self::$instance = new DB();
		}

		return self::$instance;
	}

	public function query($sql, $params = [], $rowCount = false)
	{
		$this->error = false;
		$this->query = $this->pdo->prepare($sql);

    	if ($this->query){
	    	$x = 1;

	    	if (count($params)){
	    		foreach($params as $param) {
	    			$this->query->bindValue($x,$param);
	    			$x++;	
	    		}
	    	}

	    	try {
		    	if($this->query->execute()){
		    		$this->result = $this->query->fetchAll(\PDO::FETCH_OBJ);
		    		$this->count = $this->query->rowCount();
		    	} else {
		    		$this->error = true;
		    	}	    		
	    	} catch (\Exception $e) {
	    		$this->error = true;
	    		//var_dump($e->getMessage());
	    	}
	    }

    	return $this; 		
	}

	public function action($action, $table, $where = [])
	{
		$operators = array('=','>','<','>=','<=');
		$field = $where[0];
		$operator = (count($where) === 3) ? $where[1] : $operators[0] ;
		$param = (count($where) === 3) ? $where[2] : $where[1] ;

		if (in_array($operator, $operators)){
			$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

			if(!$this->query($sql, [$param])->error()){
				return $this;
			}
		}

		return $this;
	}

    /**
     * @param string $table
     * @param array $fields
     * @return boolean
     */
	public function insert($table, $fields = [])
	{
		$keys = array_keys($fields);
		$values='';
		$x = 1;

		foreach ($fields as $field) {
			$values.='?';
			if ($x < count($fields)){
				$values .= ', ';		
			}
			$x++;
		}

		$sql = "INSERT INTO {$table} (`" . implode('`,`', $keys) . "`) VALUES ({$values})";

		if(!$this->query($sql, $fields)->error()) {
			return true;
		}

	  return false;
	}	

    /**
     * Execute an update db transaction.
     * 
     * @param string $table
     * @param integer $id
     * @param array $fields
     * @return boolean
     */
	public function update($table, $id, $fields)
	{
		$set = '';
		$x = 1;

		foreach ($fields as $name => $field) {
			$set.= "{$name} = ?";

			if ($x < count($fields)){
				$set .= ', ';		
			}

			$x++;
		}

		$sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

		if(!$this->query($sql, $fields)->error()) {
			return true;
		}

	  return false;
	}		

    /**
     * Execute a get db transaction.
     * 
     * @param string $table
     * @param array $where
     * @return app\src\DB
     */
	public function get($table, $where) 
	{
		return $this->action('SELECT *', $table, $where);
	}

    /**
     * Execute a get db transaction without where statement.
     * 
     * @param string $table
     * @return app\src\DB
     */
	public function all($table) 
	{
		$sql = "SELECT * FROM {$table}";

		if(!$this->query($sql)->error()){
			return $this;
		}

		return $this;	
	}

    /**
     * Return the results from the last executed db query.
     * 
     * @return array
     */
	public function result()
	{
		return $this->result;
	}

    /**
     * Return the last inserted query id.
     * 
     * @return integer
     */
	public function lastInsertId()
	{
		return $this->pdo->lastInsertId();
	}

    /**
     * Return the first result from the last executed db query.
     * 
     * @return object
     */
	public function first()
	{
		return $this->result()[0];
	}

    /**
     * Indicates if an error occur during last db transaction.
     * 
     * @return boolean
     */
	public function error()
	{
		return $this->error;
	}

    /**
     * Get the total number of records found from the last executed query.
     * 
     * @return integer
     */
	public function count()
	{
		return $this->count;
	}	
}
