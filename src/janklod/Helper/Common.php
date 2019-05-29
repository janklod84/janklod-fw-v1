<?php 
namespace JK\Helper;


/**
 * @package JK\Helper\Common
*/
class Common
{
       
/**
* Sanitize input data 
* @param string $input
* @return 
*/
public static function sanitize($input)
{
    return htmlentities($parsed, ENT_QUOTES, 'UTF-8');
}

/**
 * Transform name to CamelCase
 * @param string $name string for transform
 * @return string
*/
public static function upperCamelCase($name) 
{
    return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
}

  
/**
 * Transform name to lowerCase 
 * Ex: name => Name
 * @param string $name string for transform
 * @return string
*/
public static function lowerCamelCase($name) 
{
   return lcfirst(self::upperCamelCase($name));
}



/**
 * Return string without GET parameters
 * @param string $url request URL
 * @return string
*/
public static function removeQueryString($url='') 
{
    if($url)
    {
        $params = explode('&', $url, 2);
        if(false === strpos($params[0], '='))
        {
            return rtrim($params[0], '/');
        }else{
            return '';
        }
    }
}

}