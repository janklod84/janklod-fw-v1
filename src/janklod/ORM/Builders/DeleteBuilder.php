<?php 
namespace JK\ORM\Builders;


/**
 * @package 
*/ 
class DeleteBuilder extends CustomBuilder
{
     
     /**
      * Build from
      * @return string
     */
     public function build()
     {
     	 $table = $this->table();
         return sprintf('DELETE FROM %s', $table);
     }
}