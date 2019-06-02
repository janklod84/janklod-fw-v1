<?php 
namespace JK\Routing\Route;

use JK\Routing\Route\Controls\{
	RegexControl,
	NamedRouteControl
};


/**
 * Route Params
 * @package JK\Routing\Route\RouteParameter
*/ 
class RouteParameter
{

     
/**
 * @var array $params  [ Route Params   ]
 * @var array $namedRoutes
*/ 
private $params = [];
private static $namedRoutes = [];
private static $regex  = [];


/**
 * Constructor
 * @param array $params
 * @return void
*/
public function __construct($params = [])
{
      $this->addParams($params);
}


/**
 * Add Params
 * @param array $params 
 * @return void
*/
public function addParams($params = [])
{
    $this->params = array_merge($this->params, $params);
}


/**
 * Set route params
 * @param string $key 
 * @param string $value 
 * @return void
 */
public function setParam($key, $value)
{
     $this->params[$key] = $value;
}


/**
 * Set route params
 * @param string $key 
 * @return void
*/
public function getParam($key)
{
     return $this->params[$key];
}


/**
 * Get route parameters
 * @return array
*/
public function parameters()
{
    return $this->params ?? [];
}


/**
 * Add named routes
 * @param string $name 
 * @return void
*/
public function namedRoutes($name)
{
   self::$namedRoutes[$name] = $this;
}



/**
 * Get Url
 * RouteParameter::url('named.route', 
 * ['param1' => value1, 'param2' => value2 ...]
 * )
 * @param string $name 
 * @param array $params 
 * @return mixed
*/
public static function url($name, $params = [])
{
     if(!isset(self::$namedRoutes[$name]))
     {
           return false;
     }
     return self::$namedRoutes[$name]->getUrl($params);
}



/**
  * Get Url
  * @param array $params 
  * @return string
*/
private function getUrl($params)
{
    $path = $this->getParam('path');

    foreach($params as $k => $v)
    {
        $path = str_replace(":$k", $v, $path);
    } 
    return $path;
}


/**
* Add regex
* @param mixed $parameter 
* @param mixed $regex 
*/
public function with($parameter, $regex = null)
{
   if(is_array($parameter) && is_null($regex))
   {
      foreach($parameter as $index => $exp)
      {
           # recursive
          $this->with($index, $exp);
      }

   }else{
       self::$regex[$parameter] = str_replace('(', '(?:', $regex);
   }

   return $this;
}


/**
 * Determine if has item Regex
 * @param string $key 
 * @return bool
*/
public static function has($key)
{
    return isset(self::$regex[$key]);
}



/**
  * Return match param
  * @param string $match 
  * @return string 
*/
public function paramMatch($match)
{
     if(isset($this->regex[$match[1]]))
     {
          return '('. $this->regex[$match[1]] . ')';
     }
     return '([^/]+)';
}


/**
  * Replace param in path
  * 
  * Ex: $path = ([0-9]+)-([a-z\-0-9]+)
  * 
  * @param string $pattern
  * @return string
*/
 public static function replacePattern()
 {
      return preg_replace_callback('#:([\w]+)#', 
        [$this, 'paramMatch'], 
        $this->getParam('pattern')
     );
 }



}