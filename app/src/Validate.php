<?php

namespace app\src;

use app\src\DB;

class Validate
{
  /**
   * @var boolean
   */	
	private $passed = false;

  /**
   * @var array
   */
	private $errors = [];

  /**
   * @var app\src\DB|null
   */
	private $db = null;

	public function __construct()
	{
		$this->db = DB::getInstance();
	}

  /**
   * Run the validation.
   * 
   * @param array $source
   * @param array $items
   * @return app\src\Validate
   */
	public function check($source, $items = [])
	{
		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $rule_value) {
				$value = trim($source[$item]);
				$item = escape($item);

				if($rule === 'required' && empty($value)) {
					$this->addError("{$item} is required");
				} else if(!empty($value)){
					switch($rule){
						case 'min':
							if(strlen($value) < $rule_value){
								$this->addError("{$item} must be a minimum of {$rule_value}");
							}
							break;
						case 'max':
							if(strlen($value) > $rule_value){
								$this->addError("{$item} must be a maximum of {$rule_value}");
							}
							break;
						case 'matches':
							if($value != $source[$rule_value]){
								$this->addError("{$rule_value} must match {$value}");
							}
							break;
						case 'in':
							if (!in_array($value, $rule_value)) {
								$this->addError("The selected {$value} is invalid.");
							}
							break;						
						case 'unique':
							$check = $this->db->get($rule_value, array($item, '=', $value));

							if($check->count()){
								$this->addError("{$item} already exists");
							}
							break;
						case 'unique_ignore':
							$attributes = explode(":", $rule_value['table']);
							$table = $attributes[0];
							$idColumnName = $attributes[1];
							$sql = "SELECT * FROM {$table} WHERE {$item} = ? and {$idColumnName} != ?";
							$check = $this->db->query($sql, array($value, $rule_value['ignore']));
						
							if ($check->count()){
								$this->addError("{$item} already exists");
							}
							break;						
					}
				}
			}
		}

		if(empty($this->errors())){
			$this->passed = true;
		}

		return $this;
	}		

  /**
   * Add an error.
   * 
   * @param string $error
   * @return void
   */
	private function addError($error)
	{
		$this->errors[] = $error;
	}

  /**
   * Get errors.
   * 
   * @return array
   */
	public function errors()
	{
		return $this->errors;
	}

  /**
   * Return if the incoming validation passed.
   * 
   * @return boolean
   */
	public function passed()
	{
		return $this->passed;
	}
}
