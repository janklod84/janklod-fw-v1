<?php 
namespace JK\ORM;


use \PDO;
use \PDOException;
use JK\Database\Exceptions\{
	ConnectionException,
	DriverException
};

use JK\ORM\Drivers\{
 MySQLDriver,
 SQLiteDriver
};


/**
 * @package JK\ORM\Connection
*/ 
class Connection 
{

/**
 * @const array [ allowed keys ]
*/
const ALLOWED_CONFIG_KEYS = [
 'driver',
 'dbname',
 'host',
 'port',
 'charset', 
 'username',
 'password',
 'options', 
 'prefix',
 'collation',
 'engine',
 'autocreate',
];



/**
 * Make connection
 * 
 * @param string $driver
 * @param array $config 
 * @return \PDO 
*/
public static function make($driver='mysql', $config = [])
{
  try 
  {
    $driver = mb_strtolower($driver);
    self::ensureConfig($config);
    extract($config);

    if(self::isValidDriver($driver))
    {
       return self::call($driver, $config);
    }

  }catch(\PDOException $e){

    throw new ConnectionException($e->getMessage(), 404);
  }

}



/**
 * Call MySQL connection
 * 
 * [
 * 'dbname'   => '',
 * 'host'     => '',
 * 'port'     => '',
 * 'charset'  => '',
 * 'username' => '',
 * 'password' => '',
 * 'options'  => ''
 * ];
 *
 * @param array $config 
 * @return \PDO
*/
public static function mysql($config=[])
{
    return call_user_func([new MySQLDriver($config), 'connect']);
}


/**
 * Call SQLite connection
 * 
 * [
 * 'dbname'   => '',
 * 'options'  => ''
 * ];
 * 
 * @param array $config 
 * @return \PDO
*/
public static function sqlite($config=[])
{
   return call_user_func([new SQLiteDriver($config), 'connect']);
}


/**
 * Call
 * @param string $driver 
 * @param string $config 
 * @return mixed
*/
private static function call($driver, $config)
{
     $method = strtolower($driver);
     $callback = [new static, $method];
     if(!is_callable($callback))
     {
          throw new ConnectionException(
            sprintf('Sorry, Connection to [%s] does not implemented yet!', $driver), 
            404
          );
          
     }
     return call_user_func($callback, $config);
}

/**
 * Make sure has available driver
 * @param string $driver 
 * @return 
*/
private static function isValidDriver($driver=null)
{
     if(!in_array($driver, PDO::getAvailableDrivers(), true))
     {
     	  throw new DriverException("Current driver is not available!", 404); 
     }
     return true;
}


/**
 * Make sure config params matches
 * @param array $config 
 * @return void
*/
private static function ensureConfig($config)
{
   foreach(array_keys($config) as $key)
   {
      if(!in_array($key, self::ALLOWED_CONFIG_KEYS))
      {
          throw new ConnectionException(
            sprintf('Sorry, key [%s] is not valid!', $key)
          );
      }
   }
}


}