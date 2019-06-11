<?php 
namespace JK\ORM;


/**
 * Class QueryBuilder
 * 
 * @package JK\ORM\QueryBuilder
*/
class QueryBuilder
{
   
/**
* @var string $table
* @var array  $sql
* @var array  $values
*/
protected $table = '';
protected $sql = [];
public $values = [];


/**
 * Add Table
 * 
 * @param string $table 
 * @return self
*/
public function table($table='')
{
    if($this->table === '')
    {
       $this->table = $table;
    }
    return $this;
}


/**
 * Get Table
 * @return string
*/
public function getTable()
{
    return $this->table;
}


/**
 * Select 
 * 
 * Ex: $this->select('username', 'login', '...')
 * Ex: $this->select() 'By default' all columns will be selected '*'
 * 
 * @param string ...$selects 
 * @return self
*/
public function select(...$selects)
{
     $this->clear();
     $this->sql['select'] = $selects;
     return $this;
}


/**
 * From
 * @param string $table 
 * @param string $alias 
 * @return self
*/
public function from($table='', $alias='')
{
    $this->table = $table;
    $this->sql['from'] = compact('alias');
    return $this;
}


/**
  * Where
  * where('id', 5)
  * where('login', 'superadmin')
  * where('login', '%test%', 'LIKE')
  * where('orders', 3, '>')
  * where('NOT username', 'Brown')
  * 
  * @param string $column
  * @param string $value
  * @param string $operator
  * @return self
*/
public function where($column='', $value=null, $operator='=')
{
    return $this->and($column, $value, $operator);
}



/**
 * Condition AND
 * @param string $column 
 * @param string $value 
 * @param string $operator 
 * @return self
*/
public function and($column = '', $value = '', $operator = '=')
{
    $condition = $this->conditionOperator($column, $operator);
    return $this->condition($condition, $value);
}


/**
 * Condition OR
 * @param string $column 
 * @param string $value 
 * @param string $operator 
 * @return self
*/
public function or($column = '', $value = '', $operator = '=')
{
    $condition = $this->conditionOperator($column, $operator);
    return $this->condition($condition, $value, 'OR');
}


/**
  * Conditions
  * by default $operator is '='
  * and By default AND
  * 
  * Operators [
  * =, >, <, >=, <=, <> or !=,
  * BETWEEN, LIKE, IN
  * ]
  * 
  * condition('id = ?', 5)
  * condition('login = ?', 'superadmin', 'OR')
  * condition('login = :login', ['login' => 'superadmin'])
  * condition('NOT username = :username', 'Brown')
  * 
  * @param string $column
  * @param string $value
  * @param string $operator
  * @return self
*/
public function condition($condition='', $value, $type='AND')
{
   if(!$this->isBinded($condition)) 
   { exit('You must to bind param : '. $condition); }
   $this->sql['where'][$type][] = $condition;
   $this->addValue($value);
   return $this;
}


/**
 * Order Query [Filter]
 * @param string $field
 * @param string $sort 
 * @return $this
*/
public function orderBy($field='', $sort='ASC')
{
    $this->sql['orderBy'][] = compact('field', 'sort');
    return $this;
}


/**
* Limit
* @param string $limit
* @param int $offset
* @return self
*/
public function limit($limit='', $offset = 0)
{
    $this->sql['limit'] = compact('limit', 'offset');
    return $this;
}


/**
 * Join
 * $this->table('users')->join('users.id = orders.user_id', 'LEFT')
 * $this->join('users.id = orders.user_id', 'RIGHT', 'orders')
 * 
 * @param string $condition
 * @param string $type 
 * @param string $table
 * @return self
*/
public function join($condition='', $type='INNER', $table='')
{
	  $this->table = $table;
    $this->sql['join'][$type][] = compact('condition');
    return $this;
}


/**
  * Insert data 
  * 
  * @param array $params 
  * @param string $table
  * @return self
 */
 public function insert($params = [], $table='')
 {
  $this->clear();
  $this->table = $table;
  $columns = array_keys($params);
  $this->sql['insert'] = compact('columns');
  $this->addValue(
    array_values($params)
  );
  return $this;
}


/**
* Update data
* 
* @param array $params
* @param string $table 
* @return self
*/
public function update($params = [], $table='')
{
  $this->clear();
  $this->table = $table;
  $columns = array_keys($params);
  $this->sql['update'] = compact('columns');
  $this->addValue(
    array_values($params)
  );
  return $this;
}


 /**
  * Set data
  * @param array $data 
  * @return self
 */
 public function set($data=[])
 {
   $this->sql['set'] = array_keys($data);
   $this->addValue(
      array_values($data)
   );
   return $this;
 }



/**
 * Delete
 * 
 * @param string $table 
 * @param string $alias
 * @return self
*/
public function delete($table='', $alias='')
{
    $this->clear();
    $this->table = $table;
    $this->sql['delete'] = compact('alias');
    return $this;
}



/**
* Truncate table
* 
* @param string $table 
* @param string $alias
* @return string
*/
public function truncate($table = null, $alias=null)
{
    $this->clear();
    $this->table = $table;
    $this->sql['truncate'] = compact('alias');
    return $this;
}



/**
 * Show all columns of table
 * 
 * @param string $table 
 * @param string $alias
 * @return string
*/
public function showColumn($table = null, $alias=null)
{
  $this->clear();
  $this->table = $table;
  $this->sql['showColumn'] = compact('alias');
  return $this;
}


/**
* Remove datas
* 
* @return void
*/
public function clear()
{
    $this->sql = [];
    $this->values = [];
}

/**
 * Create SQL
 * @return string
*/
public function sql()
{
    $output = [];
    foreach($this->sql as $type => $params)
    {
        $output[] = $this->build($type, $params);
    }
    return join(' ', $output);
}


/**
 * Get output as string
 * @return string
*/
public function __toString()
{
    return $this->sql();
}



/**
 * COUNT of column
 * @param string $column 
 * @param string $table 
 * @param string $alias
 * @return QueryBuilder
*/
public function count($column='', $table='', $alias = null)
{
     return $this->functionQuery($column, $table, 'COUNT', $alias);
}


/**
 * AVG of column
 * @param string $column 
 * @param string $table 
 * @param string $alias
 * @return QueryBuilder
*/
public function avg($column='', $table='', $alias = null)
{
      return $this->functionQuery($column, $table, 'AVG', $alias);
}


/**
 * SUM of column 
 * @param string $column 
 * @param string $table 
 * @param string $alias
 * @return QueryBuilder
*/
public function sum($column='', $table='', $alias = null)
{
      return $this->functionQuery($column, $table, 'SUM', $alias);
}



/**
 * MAX of column 
 * @param string $column 
 * @param string $table
 * @param string $alias 
 * @return QueryBuilder
*/
public function max($column='', $table='', $alias = null)
{
      return $this->functionQuery($column, $table, 'MAX', $alias);
}



/**
 * MIN of column 
 * @param string $column 
 * @param string $table 
 * @param string $alias 
 * @return QueryBuilder
*/
public function min($column='', $table='', $alias = null)
{
      return $this->functionQuery($column, $table, 'MIN', $alias);
}


/**
 * Function
 * @param string $column 
 * @param string $table
 * @param string $type 
 * @return self
*/
protected function functionQuery(
$column='', 
$table = 'no-table', 
$type=null,   
$alias = null
)
{
    $this->table = $table;
    $this->sql['function'] = compact('column', 'type', 'alias');
    return $this;
} 



/**
* Build part
* @param string $type
* @param string $params
* @return string
*/
protected function build($class_name, $params)
{
      $builder_name = sprintf(
       '\\JK\\ORM\\Builders\\%sBuilder', 
       ucfirst($class_name)
      );
      if(!class_exists($builder_name))
      {
          die(sprintf('class <strong>%s</strong> does not exist!', $builder_name));
      }
      $builder_obj = new $builder_name($params, $this->table);
      return call_user_func([$builder_obj, 'build']);
}
  

/**
 * Add Value
 * @param mixed $value 
 * @return void
*/
protected function addValue($value=null)
{
     if(is_array($value))
     {
        $this->values = array_merge($this->values, $value);
     }else{
         array_push($this->values, $value);
     }
}


/**
 * Condition operator
 * @param string $column 
 * @param string $operator 
 * @return string
*/
protected function conditionOperator($column, $operator)
{
     $condition = sprintf('%s %s %s', $column, $operator, '?');
     if($this->isBinded($column))
     {
           $condition = $column;
     }
     return $condition;
}


/**
 * Determine if condition is binded
 * @param string $condition 
 * @return bool
*/
protected function isBinded($condition)
{
    return strpos($condition, '?') !== false 
           || strpos($condition, ':') !== false;
}


/**
 * Determine if has parsed data or params
 * @param array $params 
 * @param string $indicate 
 * @return 
*/
private function ensureParams($params=[], $indicate='')
{
    if(empty($params))
    {
        exit(sprintf('You must to add data for <strong>%s</strong> SQL'));
    }
}
}