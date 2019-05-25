<?php 
namespace JK\Database;


use JK\ORM\QQ;


/**
 * @package JK\Database\Model
*/ 
abstract class Model
{

  /**
   * Constructor
   * @return void
  */
  public function __construct()
  {
      $db = DB::instance();
      QQ::setup($db);
  }

}