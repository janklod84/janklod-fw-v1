<?php 
namespace JK\Security\Encryption;


/**
 * @package JK\Security\Encryption\Hash 
*/ 
class Hash 
{
		 

/**
 * Make Hash
 * 
 * @param  string  $algo 
 * @param  string  $string 
 * @param  string  $salt 
 * @return string
 */
public static function make($algo = 'sha256', $string, $salt ='')
{
     return hash($algo, $string . $salt);
}

 
/**
* Random Salt
* @var $length
* @return string
**/
public static function salt($length)
{   
    return random_bytes($length);
}
 

/**
  * Check Unique ID
  * @return mixed
**/
public static function unique()
{
   return self::make(uniqid());
}
 
 
/**
 * Hash password
 * @param string $char 
 * @param string $type 
 * @return string
*/
public static function pwd($char='', $type=PASSWORD_DEFAULT)
{
   return password_hash($char, $type); 
}

/**
 * Determine if password matches
 * @param string $handle 
 * @param $verify 
 * @return bool
*/
public static function pwdverify($handle='', $verify)
{
   return password_verify($handle, $verify); 
}
     
}