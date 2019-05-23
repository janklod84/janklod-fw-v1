<?php 
namespace JK\Database\Statement;


/**
 * @package JK\Database\Statement\Fetch
*/ 
abstract class Fetch
{
     
     /**
      * @var \PDOStatement $statement
      * @var int $fetchMode
      * @var array $options
     */
     protected $statement;
     protected $options = [];



     /**
      * Constructor
      * @param string $statement
      * @param array $options 
      * @return void
     */
     public function __construct($statement, $options = [])
     {
          $this->statement = $statement;
          $this->options   = $options;
     }

     
     /**
      * Set current Fetch Mode
      * @return mixed
     */
     abstract public function setMode();


     /**
	    * Get option
	    * @param string $key 
	    * @return 
     */
     protected function option($key)
     {
          return isset($this->options[$key]) ? $this->options[$key] : null;
     }
     
     /**
      * Get argument
      * @param string $key 
      * @return mixed
     */
     protected function argument($key)
     {
         $argument = $this->option('arguments');
         return isset($argument[$key]) ? $argument[$key] : null;
     }
} 