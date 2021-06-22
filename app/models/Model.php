<?php

namespace app\models;

use app\src\DB;

class Model 
{
  /**
   * @var array
   */   
  protected $columns;

  public function __construct()
  {
    $this->columns = [];
  }

  /**
   * Get database records of the corresponding table.
   * 
   * @param string $where
   * @param mixed $value
   * @return array
   */
  public static function all($where = null, $value = null)
  {
    if ($where !== null && $value !== null) {
      $data = DB::getInstance()->get(static::$table, [$where, $value]);
    } else {
      $data = DB::getInstance()->all(static::$table);
    }

    $collection = [];

    foreach ($data->result() as $key => $row) { 
      $collection[] = static::transformToModel($row);
    }

    return $collection;
  }

  /**
   * Insert a new record in database and return the corresponding model.
   * 
   * @return object
   * @throws \Exception if the record insert failed.
   */
  public static function create($fields = [])
  {
    $inserted = DB::getInstance()->insert(static::$table, $fields);

    if (!$inserted) {
      throw new \Exception('There was a problem creating record.');
    }

    $insertedRecord = DB::getInstance()->get(static::$table, ['id', DB::getInstance()->lastInsertId()]);
    
    return static::transformToModel($insertedRecord->first()); 
  }

  /**
   * Create and set properties of the model.
   * 
   * @param object $data
   * @return object
   */
  public static function transformToModel($data)
  {
    $className = get_called_class();
    $model = new $className();
    $model->setColumnsValues($data);

    return $model;
  }

  /**
   * Get property value by key.
   * 
   * @param string $column
   * @return mixed
   */
  public function getColumnValue($column)
  {
    return $this->columns[$column];
  }

  /**
   * Set a value for a model property.
   * 
   * @param string $column
   * @param mixed $value
   * @return void
   */
  public function setColumnValue($column, $value) 
  {
    $this->columns[$column] = $value;
  }

  /**
   * Set the model instance properties.
   * 
   * @param object $columns
   * @return void
   */
  public function setColumnsValues($columns)
  {
    $columns = (array) $columns;
    
    foreach ($columns as $columnKey => $value) {
      $this->setColumnValue($columnKey, $value);
    }
  }

  /**
   * Update the properties of the model.
   * 
   * @param object $columns
   * @return void
   */
  public function updateModel($columns)
  {
    $columns = (array) $columns;
    
    foreach ($columns as $column => $value) {
      $this->setColumnValue($column, $value);
    }
  }

  /**
   * Update a single item.
   * 
   * @param  array $fields
   * @return void
   */
  public function update($fields = [])
  {
    if(!DB::getInstance()->update(static::$table, $this->columns[static::$primaryKey], $fields)) {
      throw new \Exception('There was a problem updating');
    }

    $this->updateModel($fields);
  }

  /**
   * Find a single item.
   * 
   * @return object|null
   * @return object|null
   */
  public static function findBy($primaryKey, $value)
  {
    $data = DB::getInstance()->get(static::$table, [$primaryKey, $value]);
    
    if ($data->count() === 0) {
      return null;
    }

    return static::transformToModel($data->first());
  }
}
